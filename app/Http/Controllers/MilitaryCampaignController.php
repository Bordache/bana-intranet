<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\MilitaryCampaign;
use Illuminate\Http\Request;

class MilitaryCampaignController extends Controller
{
    public function index(Profile $profile)
    {
        $militaryCampaigns = $profile->militaryCampaigns;
        return view('military_campaigns.index', compact('profile', 'militaryCampaigns'));
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
            'campaign_title' => 'required|string|max:255',
            'campaign_period' => 'nullable|string|max:255',
            'campaign_locations' => 'nullable|string|max:255',
        ]);

        $profile->militaryCampaigns()->create($validated);
        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'campaign_histories',
        ])->with('success', 'Campagne ajoutée avec succès.');
    }

    public function update(Request $request, Profile $profile, $id)
    {
        $campaign = $profile->militaryCampaigns()->findOrFail($id);
        $validated = $request->validate([
            'campaign_title' => 'required|string|max:255',
            'campaign_period' => 'nullable|string|max:255',
            'campaign_locations' => 'nullable|string|max:255',
        ]);

        $campaign->update($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'campaign_histories',
        ])->with('success', 'Campagne mise à jour avec succès');
    }

    public function destroy(Profile $profile, $id)
    {
        $campaign = $profile->militaryCampaigns()->findOrFail($id);
        $campaign->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'campaign_histories',
        ])->with('success', 'Campagne supprimée avec succès');
    }
}
