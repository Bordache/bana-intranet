<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\AcademicPath;
use Illuminate\Http\Request;

class AcademicPathController extends Controller
{
    public function index(Profile $profile)
    {
        //
    }

    public function create(Profile $profile)
    {
        //
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'diploma' => 'nullable|string',
        ]);

        $profile->academicPaths()->create($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'academic_paths',
        ])->with('success', 'Parcours ajouté avec succès.');
    }

    public function show(Profile $profile, $id)
    {
        //
    }

    public function edit(Profile $profile, $id)
    {
        //
    }

    public function update(Request $request, Profile $profile, $id)
    {
        $academicPath = $profile->academicPaths()->findOrFail($id);

        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'diploma' => 'nullable|string',
        ]);

        $academicPath->update($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'academic_paths',
        ])->with('success', 'Parcours mis à jour avec succès.');
    }

    public function destroy(Profile $profile, $id)
    {
        $academicPath = $profile->academicPaths()->findOrFail($id);
        $academicPath->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'academic_paths',
        ])->with('success', 'Parcours supprimé avec succès.');
    }
}
