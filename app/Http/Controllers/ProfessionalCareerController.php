<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfessionalCareer;

class ProfessionalCareerController extends Controller
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
    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $profile->professionalCareers()->create($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'professional_careers',
        ])->with('success', 'Parcours ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile, $id)
    {
        $professionalCareers = $profile->professionalCareers()->findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $professionalCareers->update($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'professional_careers',
        ])->with('success', 'Parcours mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile, $id)
    {
        $professionalCareer = $profile->professionalCareers()->findOrFail($id);
        $professionalCareer->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'professional_careers',
        ])->with('success', 'Parcours supprimé avec succès.');
    }
}
