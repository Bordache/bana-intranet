<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\AcademicPath;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use App\Models\Domain;

class AcademicPathController extends Controller
{
    public function index(Profile $profile)
    {
        //
    }

    public function create(Profile $profile)
    {
        //
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'diploma' => 'nullable|string',
        ]);



        $profile->academicPaths()->create($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'academic_paths',
        ])->with('success', 'Parcours ajouté avec succès.');
    }

    public function show(Profile $profile, $id)
    {
        //
    }

    public function edit(Profile $profile, $id)
    {
        //
    }

    public function update(Request $request, Profile $profile, $id, bool $auth = false)
    {
        $auth = $request->query('auth', false);
        $academicPath = $profile->academicPaths()->findOrFail($id);

        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'diploma' => 'nullable|string',
        ]);

        // Vérification des champs modifiés
        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $academicPath->$key;

            if ($newValue != $oldValue) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue
                ];
            }
        }
        if (!empty($changes)) {
           $academicPath->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

           // Récupérer l'ID du domaine "rh"
           $domainId = Domain::where('name', 'rh')->value('id');

           // Construire un message détaillé pour le log
           $changeDetails = collect($changes)->map(function ($change, $field) {
               return "{$field}: '{$change['old']}' → '{$change['new']}'";
           })->implode(', ');

           if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_academic_path',
                    "Mise à jour du parcours académique du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_academic_path',
                    "Mise à jour du parcours académique de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

            return back()->with(['success' => 'Parcours mis à jour avec succès.', 'tab' => 'academic_paths']);
       }
       return back()->with(['info' => 'Aucune modification détectée.', 'tab' => 'academic_paths']);
    }

    public function destroy(Profile $profile, $id)
    {
        $academicPath = $profile->academicPaths()->findOrFail($id);
        $academicPath->delete();

        return back()->with([
            'success' => 'Parcours supprimé avec succès.',
            'tab' => 'academic_paths',
        ]);
    }

    public function destroyAll(Profile $profile)
    {
        $profile->academicPaths()->delete();

        return back()->with([
            'success' => 'Tous les parcours ont été supprimés avec succès.',
            'tab' => 'academic_paths',
        ]);
    }
}
