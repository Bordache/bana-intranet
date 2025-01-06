<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\AcademicPath;
use Illuminate\Http\Request;

class AcademicPathController extends Controller
{
    public function index(Profile $profile)
    {
        $academicPaths = $profile->academicPaths;
        return view('academic_paths.index', compact('profile', 'academicPaths'));
    }

    public function create(Profile $profile)
    {
        return view('academic_paths.create', compact('profile'));
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'diploma' => 'nullable|text',
        ]);

        $profile->academicPaths()->create($validated);
        return redirect()->route('academic_paths.index', $profile->id)->with('success', 'Parcours ajouté avec succès.');
    }

    public function show(Profile $profile, $id)
    {
        $academicPath = $profile->academicPaths()->findOrFail($id);
        return view('academic_paths.show', compact('profile', 'academicPath'));
    }

    public function edit(Profile $profile, $id)
    {
        $academicPath = $profile->academicPaths()->findOrFail($id);
        return view('academic_paths.edit', compact('profile', 'academicPath'));
    }

    public function update(Request $request, Profile $profile, $id)
    {
        $academicPath = $profile->academicPaths()->findOrFail($id);

        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'graduation_date' => 'nullable|date',
        ]);

        $academicPath->update($validated);
        return redirect()->route('academic_paths.index', $profile->id)->with('success', 'Parcours mis à jour avec succès.');
    }

    public function destroy(Profile $profile, $id)
    {
        $academicPath = $profile->academicPaths()->findOrFail($id);
        $academicPath->delete();
        return redirect()->route('academic_paths.index', $profile->id)->with('success', 'Parcours supprimé avec succès.');
    }
}
