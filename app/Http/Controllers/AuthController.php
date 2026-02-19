<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\Companies;
use App\Models\Jobs;
use App\Models\User;
use App\Models\UserEducations;
use App\Models\UserSkills;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect('/');
            // ->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:job_seeker,employer',
        ]);

        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $request->role,
            'is_verified' => 'false',
        ]);

        $user->assignRole($request->role);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showProfile()
    {
        $user = Auth::user();
        $mySkills = UserSkills::with('skill')
            ->where('user_id', $user->id)
            ->get();

        $educations = UserEducations::where('user_id', $user->id)
            ->orderBy('graduation_year', 'desc')
            ->get();

        $company = companies::where('owner_id', $user->id)->first();

        $myJobs = $company
            ? jobs::with('skills')->where('company_id', $company->id)->latest()->get()
            : collect();

        $totalPelamar = $myJobs->sum(function ($job) {
            return $job->applications->count();
        });

        $perluReview = $myJobs->sum(function ($job) {
            return $job->applications->where('status', 'pending')->count();
        });

        $myApplications = Applications::with('job.company')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $totalMelamar = $myApplications->count();

        $totalDitolak = $myApplications->where('status', 'denied')->count();

        $acceptedApplications = $myApplications->where('status', 'accepted');

        return view('profile', compact('user', 'mySkills', 'educations', 'company', 'myJobs', 'totalPelamar', 'perluReview', 'totalMelamar', 'totalDitolak', 'acceptedApplications'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
        ]);

        $user->update($validated + ['is_verified' => true]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function storeResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('resumes', $filename, 'public');

            auth()->user()->update(['resume' => $path]);
        }

        return back()->with('success', 'Resume berhasil diunggah!');
    }
}
