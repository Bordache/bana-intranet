<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ChildrenDetail;
use App\Helpers\LogHelper;
use App\Models\Domain;
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

        $domainId = Domain::where('name', 'rh')->value('id');

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Create_enfant',
            "Ajout d'enfant {$request->child_full_name} de {$profile->name} {$profile->firstname}",
            $domainId
        );

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'children_details',
        ])->with('success', 'Enfant ajouté avec succès.');
    }

    public function update(Request $request, Profile $profile, $id, bool $auth = false)
    {
        $auth = $request->query('auth', false);
        $child = $profile->childrenDetails()->findOrFail($id);

        $validated = $request->validate([
            'child_full_name' => 'required|string|max:255',
            'child_birth_date' => 'required|date',
            'child_birth_place' => 'nullable|string|max:255',
            'child_gender' => 'required|string|max:50',
            'child_status' => 'nullable|string|max:255',
        ]);

        // Vérification des champs modifiés
        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $child->$key;

            // Normalisation des dates pour éviter les fausses modifications
            if (in_array($key, ['child_birth_date']) && $oldValue) {
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
           $child->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

           // Récupérer l'ID du domaine "rh"
           $domainId = Domain::where('name', 'rh')->value('id');

           // Construire un message détaillé pour le log
           $changeDetails = collect($changes)->map(function ($change, $field) {
               return "{$field}: '{$change['old']}' → '{$change['new']}'";
           })->implode(', ');

           if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_child_details',
                    "Mise à jour de l'enfant du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_child_details',
                    "Mise à jour de l'enfant de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

          return back()->with(['success' => 'Enfant mis à jour avec succès.', 'tab' => 'children_details']);
       }
       return back()->with(['info' => 'Aucune modification détectée.', 'tab' => 'children_details']);
    }


    public function destroy(Profile $profile, $id)
    {
        $child = $profile->childrenDetails()->findOrFail($id);
        $child->delete();

        $domainId = Domain::where('name', 'rh')->value('id');

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Delete_enfant',
            "Suppression d'enfant {$child->child_full_name} de {$profile->name} {$profile->firstname}",
            $domainId
        );

        return back()->with([
            'success' => 'Enfant supprimé avec succès.',
            'tab' => 'children_details',
        ]);
    }

    public function destroyAll(Profile $profile)
    {
        $profile->childrenDetails()->delete();

        $domainId = Domain::where('name', 'rh')->value('id');

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Delete_enfant',
            "Suppression de tous les enfants de {$profile->name} {$profile->firstname}",
            $domainId
        );

        return back()->with([
            'success' => 'Tous les enfants ont été supprimés avec succès.',
            'tab' => 'children_details',
        ]);
    }

}
