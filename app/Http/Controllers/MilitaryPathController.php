<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\MilitaryPath;

class MilitaryPathController extends Controller
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
            'academy_name' => 'required|string|max:255',
            'academy_duration' => 'required|string|max:255',
            'academy_diploma' => 'nullable|string',
        ]);

        $profile->militaryPaths()->create($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'military_paths',
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
        $militaryPaths = $profile->militaryPaths()->findOrFail($id);

        $validated = $request->validate([
            'academy_name' => 'required|string|max:255',
            'academy_duration' => 'required|string|max:255',
            'academy_diploma' => 'nullable|string',
        ]);

        $militaryPaths->update($validated);

        return back()->with([
            'success' => 'Parcours mis à jour avec succès.',
            'tab' => 'military_paths',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile, $id)
    {
        $militaryPath = $profile->militaryPaths()->findOrFail($id);
        $militaryPath->delete();

        return back()->with([
            'success' => 'Parcours supprimé avec succès.',
            'tab' => 'military_paths',
        ]);
    }

    /**
     * Remove all resources from storage.
     */
    public function destroyAll(Profile $profile)
    {
        $profile->militaryPaths()->delete();

        return back()->with([
            'success' => 'Tous les parcours ont été supprimés avec succès.',
            'tab' => 'military_paths',
        ]);
    }
}
