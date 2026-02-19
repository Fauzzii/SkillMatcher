<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Jobs;
use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = jobs::with(['company', 'skills']);

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($c) use ($search) {
                        $c->where('company_name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'salary_high':
                    $query->orderBy('salary', 'desc');
                    break;
                default: // latest
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $jobs = $query->paginate(10);

        // 3. Logic Rekomendasi (Sederhana: berdasarkan match skill user)
        $recommendedJobs = collect([]);
        if (auth()->check() && auth()->user()->hasRole('job_seeker')) {
            $userSkillIds = auth()->user()->skills->pluck('skill_id')->toArray();

            if (!empty($userSkillIds)) {
                $recommendedJobs = jobs::whereHas('skills', function ($q) use ($userSkillIds) {
                    $q->whereIn('skills.id', $userSkillIds);
                })
                    ->with(['company', 'skills'])
                    ->latest()
                    ->take(4) // Ambil 4 rekomendasi saja
                    ->get();
            }
        }

        return view('main.jobs', compact('jobs', 'recommendedJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:150',
            'category'    => 'required|string|max:100',
            'salary'      => 'required|numeric',
            'description' => 'required|string',
            'hard_skills'   => 'nullable|array',
            'hard_skills.*' => 'nullable|string|max:100',
            'soft_skills'   => 'nullable|array',
            'soft_skills.*' => 'nullable|string|max:100',
        ]);

        DB::transaction(function () use ($request) {

            $company = companies::where('owner_id', Auth::id())->firstOrFail();

            $job = jobs::create([
                'company_id'  => $company->id,
                'title'       => $request->title,
                'category'    => $request->category,
                'salary'      => $request->salary,
                'description' => $request->description,
                'is_active'   => true,
            ]);

            $skillsToAttach = [];

            if ($request->filled('hard_skills')) {
                foreach ($request->hard_skills as $skillName) {
                    if (!empty($skillName)) {
                        $skill = skills::firstOrCreate(['name' => trim($skillName)]);

                        $skillsToAttach[$skill->id] = ['category' => false];
                    }
                }
            }

            if ($request->filled('soft_skills')) {
                foreach ($request->soft_skills as $skillName) {
                    if (!empty($skillName)) {
                        $skill = skills::firstOrCreate(['name' => trim($skillName)]);

                        if (!isset($skillsToAttach[$skill->id])) {
                            $skillsToAttach[$skill->id] = ['category' => true];
                        }
                    }
                }
            }

            if (!empty($skillsToAttach)) {
                $job->skills()->sync($skillsToAttach);
            }
        });

        return back()->with('success', 'Lowongan pekerjaan berhasil ditayangkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = jobs::with(['company', 'skills'])->findOrFail($id);
        return view('main.jobsdetail', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:150',
            'category'    => 'required|string|max:100',
            'salary'      => 'required|numeric',
            'description' => 'required|string',
            'hard_skills'   => 'nullable|array',
            'hard_skills.*' => 'nullable|string|max:100',
            'soft_skills'   => 'nullable|array',
            'soft_skills.*' => 'nullable|string|max:100',
        ]);

        $job = jobs::findOrFail($id);
        $company = companies::where('owner_id', auth()->id())->first();

        if (!$company || $job->company_id !== $company->id) {
            return back()->with('error', 'Akses ditolak. Anda bukan pemilik lowongan ini.');
        }

        DB::transaction(function () use ($request, $job, $validated) {

            $job->update([
                'title'       => $validated['title'],
                'category'    => $validated['category'],
                'salary'      => $validated['salary'],
                'description' => $validated['description'],
            ]);

            $skillsToSync = [];

            if ($request->filled('hard_skills')) {
                foreach ($request->hard_skills as $skillName) {
                    if (!empty($skillName)) {
                        $skill = skills::firstOrCreate(['name' => trim($skillName)]);

                        $skillsToSync[$skill->id] = ['category' => false];
                    }
                }
            }

            if ($request->filled('soft_skills')) {
                foreach ($request->soft_skills as $skillName) {
                    if (!empty($skillName)) {
                        $skill = skills::firstOrCreate(['name' => trim($skillName)]);

                        if (!isset($skillsToSync[$skill->id])) {
                            $skillsToSync[$skill->id] = ['category' => true];
                        }
                    }
                }
            }

            $job->skills()->sync($skillsToSync);
        });

        return back()->with('success', 'Lowongan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $job = jobs::findOrFail($id);

        $company = companies::where('owner_id', auth()->id())->first();

        if (!$company || $job->company_id !== $company->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas untuk menghapus lowongan ini.');
        }

        try {
            $job->delete();

            return redirect()->back()->with('success', 'Lowongan kerja berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus lowongan.');
        }
    }

    public function viewApplicants($id)
    {
        $job = Jobs::with([
            'applications' => function ($query) {
                $query->where('status', 'pending');
            },
            'applications.user.skills',

            'applications.user.educations'
        ])->findOrFail($id);

        return view('main.applicants', compact('job'));
    }
}
