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

class ProfileController extends Controller
{
     /**
     * Display the user's information form.
     */
    public function show(Request $request): View
    {
        $id = $request->user()->profile_id;

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

        return view('profile.show', compact('profile', 'profileRank', 'profileUnit', 'selectRanks', 'selectUnits'));
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
