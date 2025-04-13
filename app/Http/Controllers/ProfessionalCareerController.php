<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfessionalCareer;
use App\Helpers\LogHelper;
use App\Models\Domain;

class ProfessionalCareerController extends Controller
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
            'company_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $profile->professionalCareers()->create($validated);

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'professional_careers',
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
        $professionalCareers = $profile->professionalCareers()->findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);
         // Vérification des champs modifiés
         $changes = [];
         foreach ($validated as $key => $newValue) {
             $oldValue = $professionalCareers->$key;

             // Normalisation des dates pour éviter les fausses modifications
             if (in_array($key, ['start_date', 'end_date']) && $oldValue) {
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
            $professionalCareers->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

            // Récupérer l'ID du domaine "rh"
            $domainId = Domain::where('name', 'rh')->value('id');

            // Construire un message détaillé pour le log
            $changeDetails = collect($changes)->map(function ($change, $field) {
                return "{$field}: '{$change['old']}' → '{$change['new']}'";
            })->implode(', ');

            if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_professional_career',
                    "Mise à jour du parcours professionnel du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_professional_career',
                    "Mise à jour du parcours professionnel de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

            return back()->with(['success' => 'Parcours mis à jour avec succès.', 'tab' => 'professional_careers']);
        }
        return back()->with(['info' => 'Aucune modification détectée.', 'tab' => 'professional_careers']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile, $id)
    {
        $professionalCareer = $profile->professionalCareers()->findOrFail($id);
        $professionalCareer->delete();

        return back()->with([
            'success' => 'Parcours supprimé avec succès.',
            'tab' => 'professional_careers',
        ]);
    }

    public function destroyAll(Profile $profile)
    {
        $profile->professionalCareers()->delete();

        return back()->with([
            'success' => 'Tous les parcours ont été supprimés avec succès.',
            'tab' => 'professional_careers',
        ]);
    }
}
