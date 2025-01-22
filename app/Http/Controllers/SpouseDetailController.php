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

    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'spouse_name' => 'required|string|max:255',
            'spouse_maiden_name' => 'nullable|string|max:255',
            'spouse_firstname' => 'nullable|string|max:255',
            'spouse_birth_date' => 'nullable|date',
            'spouse_birth_place' => 'nullable|string|max:255',
            'spouse_profession' => 'nullable|string|max:255',
            'marriage_authorization' => 'nullable|string|max:255',
        ]);

        $profile->spouseDetail()->updateOrCreate([], $validated);
        return redirect()->route('spouse_detail.index', $profile->id)->with('success', 'Informations du conjoint mises à jour avec succès.');
    }
}
