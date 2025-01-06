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

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'campaign_period' => 'required|string|max:255',
            'campaign_locations' => 'required|string|max:255',
        ]);

        $profile->militaryCampaigns()->create($validated);
        return redirect()->route('military_campaigns.index', $profile->id)->with('success', 'Campagne ajoutée avec succès.');
    }

    public function destroy(Profile $profile, $id)
    {
        $campaign = $profile->militaryCampaigns()->findOrFail($id);
        $campaign->delete();
        return redirect()->route('military_campaigns.index', $profile->id)->with('success', 'Campagne supprimée avec succès.');
    }
}
