<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\MilitaryPath;
use App\Helpers\LogHelper;
use App\Models\Domain;

class MilitaryPathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'academy_name' => 'required|string|max:255',
            'academy_duration' => 'required|string|max:255',
            'academy_diploma' => 'nullable|string',
        ]);

        $profile->militaryPaths()->create($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'military_paths',
        ])->with('success', 'Parcours ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile, $id, bool $auth = false)
    {
        $auth = $request->query('auth', false);
        $militaryPath = $profile->militaryPaths()->findOrFail($id);

        $validated = $request->validate([
            'academy_name' => 'required|string|max:255',
            'academy_duration' => 'required|string|max:255',
            'academy_diploma' => 'nullable|string',
        ]);

        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $militaryPath->$key;
            if ($newValue != $oldValue) {
                $changes[$key] = ['old' => $oldValue, 'new' => $newValue];
            }
        }

        if (!empty($changes)) {
            $militaryPath->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

            // Récupérer l'ID du domaine "rh"
            $domainId = Domain::where('name', 'rh')->value('id');

            // Construire un message détaillé pour le log
            $changeDetails = collect($changes)->map(function ($change, $field) {
                return "{$field}: '{$change['old']}' → '{$change['new']}'";
            })->implode(', ');

            if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_military_paths',
                    "Mise à jour du parcours militaire du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_military_paths',
                    "Mise à jour du parcours militaire de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

            return back()->with(['success' => 'Parcours mis à jour avec succès.', 'tab' => 'military_paths']);
        }

        return back()->with(['info' => 'Aucune modification détectée.', 'tab' => 'military_paths']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile, $id)
    {
        $militaryPath = $profile->militaryPaths()->findOrFail($id);
        $militaryPath->delete();

        return back()->with([
            'success' => 'Parcours supprimé avec succès.',
            'tab' => 'military_paths',
        ]);
    }

    /**
     * Remove all resources from storage.
     */
    public function destroyAll(Profile $profile)
    {
        $profile->militaryPaths()->delete();

        return back()->with([
            'success' => 'Tous les parcours ont été supprimés avec succès.',
            'tab' => 'military_paths',
        ]);
    }
}
