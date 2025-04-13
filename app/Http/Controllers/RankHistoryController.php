<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\RankHistory;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use App\Models\Domain;

class RankHistoryController extends Controller
{
    public function index(Profile $profile)
    {
        //
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
            'history_rank' => 'required|string|max:255',
            'history_promotion_date' => 'required|date',
            'history_rank_reference' => 'string|max:255',
        ]);

        $profile->rankHistories()->create($validated);
        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'rank_histories',
        ])->with('success', 'Grade ajouté avec succès.');
    }

    public function update(Request $request, Profile $profile, $id, bool $auth = false)
    {
        $auth = $request->query('auth', false);
        $rankHistory = $profile->rankHistories()->findOrFail($id);
        $validated = $request->validate([
            'history_rank' => 'required|string|max:255',
            'history_promotion_date' => 'required|date',
            'history_rank_reference' => 'nullable|string|max:255',
        ]);

         // Vérification des champs modifiés
         $changes = [];
         foreach ($validated as $key => $newValue) {
             $oldValue = $rankHistory->$key;

            // Normalisation des dates pour éviter les fausses différences
            if (in_array($key, ['history_promotion_date']) && $oldValue) {
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
         if (!empty($changes)) {
            $rankHistory->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

            // Récupérer l'ID du domaine "rh"
            $domainId = Domain::where('name', 'rh')->value('id');

            // Construire un message détaillé pour le log
            $changeDetails = collect($changes)->map(function ($change, $field) {
                return "{$field}: '{$change['old']}' → '{$change['new']}'";
            })->implode(', ');

            if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_rank_history',
                    "Mise à jour de grade du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_rank_history',
                    "Mise à jour de grade de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

            return back()->with(['success' => 'Grade mis à jour avec succès.', 'tab' => 'rank_histories']);
        }
        return back()->with(['info' => 'Aucune modification détectée.', 'tab' => 'rank_histories']);
    }

    public function destroy(Profile $profile, $id)
    {
        $rankHistory = $profile->rankHistories()->findOrFail($id);
        $rankHistory->delete();

        return back()->with([
            'success' => 'Grade supprimé avec succès.',
            'tab' => 'rank_histories',
        ]);
    }

    public function destroyAll(Profile $profile)
    {
        $profile->rankHistories()->delete();

        return back()->with([
            'success' => 'Tous les grades ont été supprimés avec succès.',
            'tab' => 'rank_histories',
        ]);
    }
}
