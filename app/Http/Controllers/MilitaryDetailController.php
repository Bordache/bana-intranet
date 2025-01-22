<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class MilitaryDetailController extends Controller
{
    public function index(Profile $profile)
    {
        $militaryDetail = $profile->militaryDetail;
        return view('military_details.index', compact('profile', 'militaryDetail'));
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
        // Validation des données
        $validated = $request->validate([
            'army' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'position_date' => 'nullable|date',
            'position_reference' => 'nullable|string|max:255',
            'military_registration_number' => 'required|string|size:6',
            'military_id_card_number' => 'nullable|string|size:6',
            'finance_registration_number' => 'nullable|string|max:255',
            'recruitment_origin' => 'nullable|string|max:255',
            'recruitment_promotion' => 'nullable|string|max:255',
            'service_entry_date' => 'required|date',
            'corps_assignment' => 'required|string|max:255',
            'unit_id' => 'required|integer|exists:units,id',
            'rank_id' => 'required|integer|exists:ranks,id',
            'rank_date' => 'nullable|date',
            'current_function' => 'nullable|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'exact_assignment' => 'nullable|string|max:255',
            'interruption_start_date'=> 'nullable|date',
            'interruption_end_date'=> 'nullable|date',
            'military_status'=> 'nullable|string|max:255',
            'military_status_reference'=> 'nullable|string|max:255',
            'military_driver_license'=> 'nullable|string|max:255',
            'other_information'=> 'nullable|text',
        ]);

        $validated['profile_id'] = $profile->id;

        MilitaryDetail::create($validated);

        // Redirection ou réponse
        return redirect()->route('military_details.index', $profile->id)
                         ->with('success', 'Les détails militaires ont été ajoutés avec succès.');
    }

    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'army' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'position_date' => 'nullable|date',
            'position_reference' => 'nullable|string|max:255',
            'military_registration_number' => 'required|string|size:6',
            'military_id_card_number' => 'nullable|string|size:6',
            'finance_registration_number' => 'nullable|string|max:255',
            'recruitment_origin' => 'nullable|string|max:255',
            'recruitment_promotion' => 'nullable|string|max:255',
            'service_entry_date' => 'required|date',
            'corps_assignment' => 'required|string|max:255',
            'unit_id' => 'required|integer|exists:units,id',
            'rank_id' => 'required|integer|exists:ranks,id',
            'rank_date' => 'nullable|date',
            'current_function' => 'nullable|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'exact_assignment' => 'nullable|string|max:255',
            'interruption_start_date'=> 'nullable|date',
            'interruption_end_date'=> 'nullable|date',
            'military_status'=> 'nullable|string|max:255',
            'military_status_reference'=> 'nullable|string|max:255',
            'military_driver_license'=> 'nullable|string|max:255',
            'other_information'=> 'nullable|text',
        ]);

        $profile->militaryDetail()->updateOrCreate([], $validated);
        return redirect()->route('military_details.index', $profile->id)->with('success', 'Renseignement militaire mis à jour avec succès.');
    }
}
