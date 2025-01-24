<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class SpouseDetailController extends Controller
{
    public function index(Profile $profile)
    {
        $spouseDetail = $profile->spouseDetail;
        return view('spouse_details.index', compact('profile', 'spouseDetail'));
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
        $spouseDetails = $profile->spouseDetails()->findOrFail($id);

        $validated = $request->validate([
            'spouse_title' => 'required|string|max:255',
            'spouse_name' => 'required|string|max:255',
            'spouse_maiden_name' => 'nullable|string|max:255',
            'spouse_firstname' => 'nullable|string|max:255',
            'spouse_birth_date' => 'nullable|date',
            'spouse_birth_place' => 'nullable|string|max:255',
            'spouse_profession' => 'nullable|string|max:255',
            'marriage_authorization' => 'nullable|string|max:255',
        ]);

        $successMessage = $request->spouse_title == 'Monsieur' ? 'Conjoint mis à jour avec succès.' : 'Conjointe mise à jour avec succès.';

        $spouseDetails->update($validated);
        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'spouse_details',
        ])->with('success', $successMessage);
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'spouse_title' => 'required|string|max:255',
            'spouse_name' => 'required|string|max:255',
            'spouse_maiden_name' => 'nullable|string|max:255',
            'spouse_firstname' => 'nullable|string|max:255',
            'spouse_birth_date' => 'nullable|date',
            'spouse_birth_place' => 'nullable|string|max:255',
            'spouse_profession' => 'nullable|string|max:255',
            'marriage_authorization' => 'nullable|string|max:255',
        ]);

        $successMessage = $request->spouse_title == 'Monsieur' ? 'Conjoint ajouté avec succès.' : 'Conjointe ajouté avec succès.';

        $profile->spouseDetails()->create($validated);
        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'spouse_details',
        ])->with('success', $successMessage);
    }

    public function destroy(Profile $profile, $id)
    {
        $spouseDetails = $profile->spouseDetails()->findOrFail($id);
        $successMessage = $spouseDetails->spouse_title == 'Monsieur' ? 'Conjoint supprimé avec succès.' : 'Conjointe supprimée avec succès.';
        $spouseDetails->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'spouse_details',
        ])->with('success', $successMessage);
    }
}
