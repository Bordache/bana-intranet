<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use App\Models\Domain;

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

    public function store(Request $request, Profile $profile, $id)
    {
        //
    }

    public function update(Request $request, Profile $profile, $id, bool $auth = false)
    {
        $auth = $request->query('auth', false);
        $militaryDetail = $profile->militaryDetail()->findOrFail($id);

        // Validation des données
        $validated = $request->validate([
            'army' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'position_date' => 'nullable|date',
            'position_reference' => 'nullable|string|max:255',
            'military_registration_number' => 'required|string|max:255',
            'military_id_card_number' => 'nullable|string|max:6',
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
            'other_information'=> 'nullable|string|max:255',
        ]);

        // Vérification des champs modifiés
        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $militaryDetail->$key;

            // Normalisation des dates pour éviter les fausses modifications
            if (in_array($key, ['position_date', 'service_entry_date', 'rank_date', 'interruption_start_date', 'interruption_end_date']) && $oldValue) {
                $oldValue = \Carbon\Carbon::parse($oldValue)->format('Y-m-d');
                $newValue = \Carbon\Carbon::parse($newValue)->format('Y-m-d');
            }

            if ($newValue != $oldValue) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue
                ];
            }
        }

        // Vérifier s'il y a des modifications
        if (!empty($changes)) {
            $militaryDetail->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

            // Récupérer l'ID du domaine "rh"
            $domainId = Domain::where('name', 'rh')->value('id');

            // Construire un message détaillé pour le log
            $changeDetails = collect($changes)->map(function ($change, $field) {
                return "{$field}: '{$change['old']}' → '{$change['new']}'";
            })->implode(', ');

            if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_military_details',
                    "Mise à jour des renseignements militaires du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_military_details',
                    "Mise à jour des renseignements militaires de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

            return back()->with([
                'success' => 'Renseignements militaires mis à jour avec succès.',
                'tab' => 'military_detail',
            ]);
        }

        return back()->with([
            'info' => 'Aucune modification détectée.',
            'tab' => 'military_detail',
        ]);
    }
}

