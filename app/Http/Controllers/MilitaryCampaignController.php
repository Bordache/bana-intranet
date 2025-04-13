<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\MilitaryCampaign;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use App\Models\Domain;

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

    public function update(Request $request, Profile $profile, $id, bool $auth = false)
    {
        $auth = $request->query('auth', false);
        $campaign = $profile->militaryCampaigns()->findOrFail($id);
        $validated = $request->validate([
            'campaign_title' => 'required|string|max:255',
            'campaign_period' => 'nullable|string|max:255',
            'campaign_locations' => 'nullable|string|max:255',
        ]);

        // Vérification des champs modifiés
        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $campaign->$key;

            if ($newValue != $oldValue) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue
                ];
            }
        }
        if (!empty($changes)) {
           $campaign->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

           // Récupérer l'ID du domaine "rh"
           $domainId = Domain::where('name', 'rh')->value('id');

           // Construire un message détaillé pour le log
           $changeDetails = collect($changes)->map(function ($change, $field) {
               return "{$field}: '{$change['old']}' → '{$change['new']}'";
           })->implode(', ');

           if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_military_campaign',
                    "Mise à jour de la campagne militaire du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_military_campaign',
                    "Mise à jour de la campagne militaire de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

           return back()->with(['success' => 'Campagne mis à jour avec succès.', 'tab' => 'campaign_histories']);
       }
       return back()->with(['info' => 'Aucune modification détectée.', 'tab' => 'campaign_histories']);
    }

    public function destroy(Profile $profile, $id)
    {
        $campaign = $profile->militaryCampaigns()->findOrFail($id);
        $campaign->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'campaign_histories',
        ])->with('success', 'Campagne mise à jour avec succès');
    }

    public function destroyAll(Profile $profile)
    {
        $profile->militaryCampaigns()->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'campaign_histories',
        ])->with('success', 'Toutes les campagnes ont été supprimées avec succès.');
    }
}
