<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
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
            'company_name' => 'required',
            'email'        => 'required|email|unique:companies,email',
            'location'     => 'required',
            'website'      => 'nullable|url',
            'description'  => 'required',
        ]);

        $validated['owner_id'] = Auth::id();

        companies::create($validated);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = companies::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required',
            'email'        => 'required|email|unique:companies,email,' . $id,
            'location'     => 'required',
            'website'      => 'nullable|url',
            'description'  => 'required',
        ]);

        $company->update($validated);

        return redirect()->back()->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(companies $companies)
    {
        //
    }
}
