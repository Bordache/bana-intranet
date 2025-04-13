<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Rank;
use App\Models\Unit;

use App\Models\AcademicPath;
use App\Models\MilitaryCampaign;
use App\Models\ProfessionalCareer;
use App\Models\ChildrenDetail;
use App\Models\HonoraryDistinction;
use App\Models\MilitaryDetail;
use App\Models\MilitaryPath;
use App\Models\Profile;
use App\Models\RankHistory;
use App\Models\SpouseDetail;

use App\Support\ProfileFields;

use App\Helpers\LogHelper;
use App\Models\Domain;

class ProfileController extends Controller
{
     /**
     * Display the user's information form.
     */
    public function show(Request $request): View
    {
        $id = $request->user()->profile_id;
        $auth = true;

        // Chargement du profil avec toutes les relations nécessaires, y compris 'rank'
        $profile = Profile::with([
            'militaryDetail',
            'academicPaths',
            'militaryPaths',
            'professionalCareers',
            'childrenDetails',
            'spouseDetails',
            'rankHistories',
            'honoraryDistinctions',
            'militaryCampaigns',
        ])->findOrFail($id);

        $profileRank = Rank::findOrFail($profile->militaryDetail->rank_id);
        $profileUnit = Unit::findOrFail($profile->militaryDetail->unit_id);
        $selectRanks = Rank::all();
        $selectUnits = Unit::all();

        // Calculs pour l'état des services
        $referenceDate = now();

        // Calcul de l'âge
        $age = $profile->birth_date ? $profile->birth_date->diffInYears($referenceDate) : null;

        // Calcul de l'ancienneté
        $serviceStartDate = $profile->militaryDetail->service_entry_date;
        $interruptionDuration = 0;

        if ($profile->militaryDetail->interruption_start_date && $profile->militaryDetail->interruption_end_date) {
            $interruptionDuration = $profile->militaryDetail->interruption_start_date->diffInDays($profile->militaryDetail->interruption_end_date);
        }

        $serviceSeniority = $serviceStartDate ? $serviceStartDate->diffInDays($referenceDate) - $interruptionDuration : null;

         // Calcul de l'ancienneté de port de grade
        $rankSeniority = $profile->militaryDetail->rank_date ? $profile->militaryDetail->rank_date->diffInDays($referenceDate) : null;

        // Calcul de la date de fin de carrière
        $careerEndDate = null;
        if ($profile->birth_date && $profile->militaryDetail->rank_id && $profileRank->rank_age_limit) {
            $careerEndDate = $profile->birth_date->addYears($profileRank->rank_age_limit);
        }

        return view('profile.show', compact('profile', 'profileRank', 'profileUnit', 'selectRanks', 'selectUnits', 'referenceDate', 'age', 'serviceSeniority', 'rankSeniority', 'careerEndDate', 'auth'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('myprofile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update civil status onformation
     */
    public function updateCivilStatus(Request $request)
    {
        $id = Auth::user()->profile_id;
        $profile = Profile::findOrFail($id);
        $validated = $request->only(array_keys(ProfileFields::getFields()));

        // Vérification des champs modifiés
        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $profile->$key;

            if (in_array($key, ['birth_date', 'issue_date', 'duplicate_date']) && $oldValue) {
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
           $profile->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());


           // Construire un message détaillé pour le log
           $changeDetails = collect($changes)->map(function ($change, $field) {
               return "{$field}: '{$change['old']}' → '{$change['new']}'";
           })->implode(', ');

           LogHelper::logAction(
               auth()->id(),
               'Update_account_civil_details',
               "Mise à jour du profile de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
               null
           );

           return redirect()->route('myprofile.show')->with('success', 'Parcours mis à jour avec succès.');
       }
       return redirect()->route('myprofile.show')->with('info', 'Aucune modification détectée.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
