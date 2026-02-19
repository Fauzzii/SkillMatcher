<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
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
        $validated = $request->validate([
            'new_skills'   => 'required|array|min:1',
            'new_skills.*' => 'required|string|max:255',
            'category'     => 'required|boolean',
        ]);

        $user = Auth::user();

        foreach ($validated['new_skills'] as $skillName) {
            $skill = Skills::firstOrCreate(['name' => trim($skillName)]);
            $user->skills()->syncWithoutDetaching([
                $skill->id => ['category' => $validated['category']],
            ]);
        }

        return redirect()->route('profile')->with('success', 'Skills berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(skills $skills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(skills $skills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, skills $skills)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $skill = skills::findOrFail($id);

        $skill->delete();

        return back()->with('success', 'Skill berhasil dihapus.');
    }
}
