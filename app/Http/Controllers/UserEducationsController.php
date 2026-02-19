<?php

namespace App\Http\Controllers;

use App\Models\UserEducations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEducationsController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|string|max:50',
            'institution_name' => 'required|string|max:150',
            'graduation_year' => 'nullable|integer|digits:4',
        ]);

        UserEducations::create([
            'user_id' => Auth::id(),
            'level' => $request->level,
            'institution_name' => $request->institution_name,
            'graduation_year' => $request->graduation_year,
        ]);

        return back()->with('success', 'Riwayat pendidikan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserEducations $UserEducations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserEducations $UserEducations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserEducations $UserEducations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $education = UserEducations::findOrFail($id);

        $education->delete();

        return back()->with('success', 'Riwayat pendidikan dihapus.');
    }
}
