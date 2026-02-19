<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk akses User
use App\Models\Jobs;

class ChatbotController extends Controller
{
    public function consult(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            if (!$userMessage) throw new \Exception("Pesan kosong.");

            $userContext = "User: Tamu (Belum Login)";

            if (Auth::check()) {
                $user = Auth::user();

                $userSkills = $user->skills->pluck('name')->toArray();
                $skillString = empty($userSkills) ? "Belum input skill" : implode(", ", $userSkills);

                $userContext = "Profil User:\n- Nama: {$user->name}\n- Skill Dikuasai: [{$skillString}]";
            }

            try {
                $jobs = Jobs::with(['company', 'skills'])
                    ->where('is_active', true)
                    ->latest()
                    ->limit(5)
                    ->get();

                $jobList = $jobs->map(function ($j) {
                    $companyName = $j->company->name ?? 'Perusahaan Rahasia';

                    $requiredSkills = $j->skills->map(function ($skill) {
                        return $skill->name;
                    })->implode(", ");

                    return "- ID: {$j->id} | Posisi: {$j->title} | Perusahaan: {$companyName} | Gaji: {$j->salary} | Skill Wajib: [{$requiredSkills}]";
                })->implode("\n");

                if (empty($jobList)) $jobList = "Belum ada lowongan aktif.";
            } catch (\Exception $dbError) {
                throw new \Exception("Gagal mengambil data Job/Skill: " . $dbError->getMessage());
            }

            $systemPrompt = "Kamu adalah Career Buddy, asisten karir cerdas.

            INFORMASI USER SAAT INI:
            $userContext

            DAFTAR LOWONGAN TERSEDIA:
            $jobList

            INSTRUKSI PENTING:
            1. Analisa 'Skill Dikuasai' user dan bandingkan dengan 'Skill Wajib' di setiap lowongan.
            2. Jika ada kecocokan (match), BERI TAHU user: 'Kamu cocok banget di posisi [Judul] karena kamu punya skill [Sebutkan Skillnya]'.
            3. Jika user bertanya rekomendasi, prioritaskan yang skill-nya paling banyak cocok (intersection).
            4. Jika skill user belum cocok, beri semangat dan sarankan skill yang perlu dipelajari dari lowongan tersebut.
            5. Jawab dengan gaya bahasa santai, ramah, dan memotivasi (Bahasa Indonesia).";

            $apiKey = config('services.gemini.key');

            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey, [
                    "contents" => [
                        ["parts" => [["text" => "$systemPrompt \n\nUser Bertanya: $userMessage"]]]
                    ]
                ]);

            if ($response->failed()) {
                throw new \Exception("Gemini API Error: " . $response->body());
            }

            $reply = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak bisa berpikir sekarang.';
            return response()->json(['reply' => $reply]);
        } catch (\Throwable $e) {
            Log::error("CHATBOT ERROR: " . $e->getMessage());
            return response()->json(['reply' => "❌ Error: " . $e->getMessage()], 200);
        }
    }
}
