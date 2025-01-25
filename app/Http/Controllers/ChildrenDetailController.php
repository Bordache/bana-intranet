<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ChildrenDetail;
use Illuminate\Http\Request;

class ChildrenDetailController extends Controller
{
    public function index(Profile $profile)
    {
        $childrenDetails = $profile->childrenDetails;
        return view('children_details.index', compact('profile', 'childrenDetails'));
    }

    public function show(Profile $profile, $id)
    {
        //
    }

    public function edit(Profile $profile, $id)
    {
        //
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'child_full_name' => 'required|string|max:255',
            'child_birth_date' => 'required|date',
            'child_birth_place' => 'nullable|string|max:255',
            'child_gender' => 'required|string|max:50',
            'child_status' => 'nullable|string|max:255',
        ]);

        $profile->childrenDetails()->create($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'children_details',
        ])->with('success', 'Enfant ajouté avec succès.');
    }

    public function update(Request $request, Profile $profile, $id)
    {
        $child = $profile->childrenDetails()->findOrFail($id);
        $validated = $request->validate([
            'child_full_name' => 'required|string|max:255',
            'child_birth_date' => 'required|date',
            'child_birth_place' => 'nullable|string|max:255',
            'child_gender' => 'required|string|max:50',
            'child_status' => 'nullable|string|max:255',
        ]);

        $child->update($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'children_details',
        ])->with('success', 'Enfant mis à jour avec succès');
    }


    public function destroy(Profile $profile, $id)
    {
        $child = $profile->childrenDetails()->findOrFail($id);
        $child->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'children_details',
        ])->with('success', 'Enfant supprimé avec succès');
    }

    public function destroyAll(Profile $profile)
    {
        $profile->childrenDetails()->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'children_details',
        ])->with('success', 'Tous les enfants ont été supprimés avec succès');
    }

}
