<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use App\Models\Domain;

class SpouseDetailController extends Controller
{
    public function index(Profile $profile)
    {
        $spouseDetail = $profile->spouseDetail;
        return view('spouse_details.index', compact('profile', 'spouseDetail'));
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
        $spouseDetails = $profile->spouseDetails()->findOrFail($id);

        $validated = $request->validate([
            'spouse_title' => 'required|string|max:255',
            'spouse_name' => 'required|string|max:255',
            'spouse_maiden_name' => 'nullable|string|max:255',
            'spouse_firstname' => 'nullable|string|max:255',
            'spouse_birth_date' => 'nullable|date',
            'spouse_birth_place' => 'nullable|string|max:255',
            'spouse_profession' => 'nullable|string|max:255',
            'marriage_authorization' => 'nullable|string|max:255',
        ]);

        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $spouseDetails->$key;

            // Normalisation des dates pour éviter les fausses différences
            if (in_array($key, ['spouse_birth_date']) && $oldValue) {
                $oldValue = \Carbon\Carbon::parse($oldValue)->format('Y-m-d');
                $newValue = \Carbon\Carbon::parse($newValue)->format('Y-m-d');
            }

            if ($newValue != $oldValue) {
                $changes[$key] = ['old' => $oldValue, 'new' => $newValue];
            }
        }

        if (!empty($changes)) {
            $spouseDetails->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

            $changeDetails = collect($changes)->map(fn($change, $field) => "{$field}: '{$change['old']}' → '{$change['new']}'")->implode(', ');

            // Récupérer l'ID du domaine "rh"
            $domainId = Domain::where('name', 'rh')->value('id');

            if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_spouse_details',
                    "Mise à jour conjoint(e) du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_spouse_details',
                    "Mise à jour conjoint(e) de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

            $successMessage = $request->spouse_title == 'Monsieur' ? 'Conjoint mis à jour avec succès.' : 'Conjointe mise à jour avec succès.';
            return back()->with(['success' => $successMessage, 'tab' => 'spouse_details']);
        }

        return back()->with(['info' => 'Aucune modification détectée.', 'tab' => 'spouse_details']);
    }


    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'spouse_title' => 'required|string|max:255',
            'spouse_name' => 'required|string|max:255',
            'spouse_maiden_name' => 'nullable|string|max:255',
            'spouse_firstname' => 'nullable|string|max:255',
            'spouse_birth_date' => 'nullable|date',
            'spouse_birth_place' => 'nullable|string|max:255',
            'spouse_profession' => 'nullable|string|max:255',
            'marriage_authorization' => 'nullable|string|max:255',
        ]);

        $successMessage = $request->spouse_title == 'Monsieur' ? 'Conjoint ajouté avec succès.' : 'Conjointe ajouté avec succès.';

        $profile->spouseDetails()->create($validated);

        return back()->with([
            'success' => $successMessage,
            'tab' => 'spouse_details',
        ]);
    }

    public function destroy(Profile $profile, $id)
    {
        $spouseDetails = $profile->spouseDetails()->findOrFail($id);
        $successMessage = $spouseDetails->spouse_title == 'Monsieur' ? 'Conjoint supprimé avec succès.' : 'Conjointe supprimée avec succès.';
        $spouseDetails->delete();

        return back()->with([
            'success' => $successMessage,
            'tab' => 'spouse_details',
        ]);
    }
}
