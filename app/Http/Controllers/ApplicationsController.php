<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\Jobs;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user->hasRole('job_seeker')) {
            return back()->with('error', 'Hanya pencari kerja yang dapat melamar.');
        }

        $application = Applications::firstOrCreate(
            [
                'user_id' => $user->id,
                'job_id'  => $id,
            ],
            [
                'status'  => 'pending',
            ]
        );

        if (!$application->wasRecentlyCreated) {
            return back()->with('error', 'Kamu sudah melamar di posisi ini sebelumnya.');
        }

        return back()->with('success', 'Berhasil melamar! Pantau terus status lamaranmu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(applications $applications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(applications $applications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, applications $applications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(applications $applications)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        $application = applications::findOrFail($id);

        $request->validate([
            'status' => 'required|in:accepted,denied',
        ]);

        $application->status = $request->status;
        $application->save();

        if ($request->status === 'accepted') {
            $message = 'Selamat! Pelamar berhasil diterima.';
        } else {
            $message = 'Pelamar telah ditolak.';
        }

        return back()->with('success', $message);
    }
}
