<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Services\UsernameGeneratorService;
use App\Services\PasswordGeneratorService;

use App\Models\User;
use App\Models\PasswordInit;

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

use App\Support\AcademyFields;
use App\Support\CampaignFields;
use App\Support\CareerFields;
use App\Support\ChildrenFields;
use App\Support\HonoraryFields;
use App\Support\MilitaryFields;
use App\Support\ProfileFields;
use App\Support\RankFields;
use App\Support\SchoolFields;
use App\Support\SpouseFields;


class PersonnelController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $entity = 'rh';
    protected $usernameGenerator;
    protected $passwordGenerator;

    public function __construct()
    {
        $this->usernameGenerator = new UsernameGeneratorService();
        $this->passwordGenerator = new PasswordGeneratorService();
    }

    /**
     * Home.
     */
    public function index()
    {
        $this->authorize("view {$this->entity}");
        $profiles = Profile::all();
        return view('personnel.index', compact('profiles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $militaryDetails = MilitaryDetail::with(['profile', 'rank'])
            ->join('profiles', 'military_details.profile_id', '=', 'profiles.id')
            ->join('ranks', 'military_details.rank_id', '=', 'ranks.id')
            ->join('units', 'military_details.unit_id', '=', 'units.id')
            ->orderBy('military_details.unit_id')
            ->orderBy('military_details.rank_id')
            ->orderBy('military_details.rank_date')
            ->orderBy('military_details.service_entry_date')
            ->orderBy('profiles.birth_date')
            ->get();

        $groupedMilitaryDetails = $militaryDetails->groupBy('unit_name');

        return view("personnel.profile.list", compact('groupedMilitaryDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create {$this->entity}");

        $ranks = Rank::all();
        $units = Unit::all();
        return view("personnel.profile.create", compact('ranks', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request){
        $this->authorize("create {$this->entity}");

        $request->validate(
                array_merge(
                    ProfileFields::getFields(),
                    MilitaryFields::getFields(),
                    $request->has('spouse_name') ? SpouseFields::getFields() : [],
                    $request->has('child_full_name') ? ChildrenFields::getFields() : [],
                    $request->has('school_name') ? SchoolFields::getFields() : [],
                    $request->has('academy_name') ? AcademyFields::getFields() : [],
                    $request->has('company_name') ? CareerFields::getFields() : [],
                    $request->has('history_rank') ? RankFields::getFields() : [],
                    $request->has('honorary_title') ? HonoraryFields::getFields() : [],
                    $request->has('campaign_title') ? CampaignFields::getFields() : []
                )
        );

        // **Étape 1 : Création du profil**
        $Profile = Profile::create($request->only(ProfileFields::getFieldNames()));

        // **Étape 2 : Création des détails militaires**
        $Profile->militaryDetail()->create(
            array_merge(
                $request->only(MilitaryFields::getFieldNames()),
                ['profile_id' => $Profile->id]
            )
        );

        // **Étape 3 : Création du conjoint**
        if ($request->has('spouse_name')) {
            foreach ($request->spouse_name as $key => $spouse) {
                $Profile->spouseDetails()->create([
                    'profile_id' => $Profile->id,
                    'spouse_name' => $spouse,
                    'spouse_maiden_name' => $request->spouse_maiden_name[$key],
                    'spouse_firstname' => $request->spouse_firstname[$key],
                    'spouse_birth_date' => $request->spouse_birth_date[$key],
                    'spouse_birth_place' => $request->spouse_birth_place[$key],
                    'spouse_profession' => $request->spouse_profession[$key],
                    'marriage_authorization' => $request->marriage_authorization[$key],
                ]);
            }
        }

        // **Étape 4 : Création des enfants**
        if ($request->has('child_full_name')) {
            foreach ($request->child_full_name as $key => $child) {
                $Profile->childrenDetails()->create([
                    'profile_id' => $Profile->id,
                    'child_full_name' => $child,
                    'child_birth_date' => $request->child_birth_date[$key],
                    'child_birth_place' => $request->child_birth_place[$key],
                    'child_gender' => $request->child_gender[$key],
                    'child_status' => $request->child_status[$key],
                ]);
            }
        }

        // **Étape 5 : Création des parcours académiques**
        if ($request->has('school_name')) {
            foreach ($request->school_name as $key => $school) {
                $Profile->academicPaths()->create([
                    'profile_id' => $Profile->id,
                    'school_name' => $school,
                    'duration' => $request->duration[$key],
                    'diploma' => $request->diploma[$key],
                ]);
            }
        }

        // **Étape 6 : Création des parcours militaire**
        if ($request->has('academy_name')) {
            foreach ($request->academy_name as $key => $academy) {
                $Profile->militaryPaths()->create([
                    'profile_id' => $Profile->id,
                    'academy_name' => $academy,
                    'academy_duration' => $request->academy_duration[$key],
                    'academy_diploma' => $request->academy_diploma[$key],
                ]);
            }
        }

        // **Étape 7 : Parcours professionnels**
        if ($request->has('company_name')) {
            foreach ($request->company_name as $key => $company) {
                $Profile->professionalCareers()->create([
                    'profile_id' => $Profile->id,
                    'company_name' => $company,
                    'job_title' => $request->job_title[$key],
                    'start_date' => $request->start_date[$key],
                    'end_date' => $request->end_date[$key],
                    'description' => $request->description[$key],
                ]);
            }
        }

        // **Étape 8 : Grades**
        if ($request->has('history_rank')) {
            foreach ($request->history_rank as $key => $rank) {
                $Profile->rankHistories()->create([
                    'profile_id' => $Profile->id,
                    'history_rank' => $rank,
                    'history_promotion_date' => $request->history_promotion_date[$key],
                    'history_rank_reference' => $request->history_rank_reference[$key],
                ]);
            }
        }

        // **Étape 9 : Distinctions honorifiques**
        if ($request->has('honorary_title')) {
            foreach ($request->honorary_title as $key => $title) {
                $Profile->honoraryDistinctions()->create([
                    'profile_id' => $Profile->id,
                    'honorary_title' => $title,
                    'honorary_promotion' => $request->honorary_promotion[$key],
                    'honorary_reference' => $request->honorary_reference[$key],
                ]);
            }
        }

        // **Étape 10 : Campagnes militaires**
        if ($request->has('campaign_title')) {
            foreach ($request->campaign_title as $key => $title) {
                $Profile->militaryCampaigns()->create([
                    'profile_id' => $Profile->id,
                    'campaign_title' => $title,
                    'campaign_period' => $request->campaign_period[$key],
                    'campaign_locations' => $request->campaign_locations[$key],
                ]);
            }
        }

        return redirect()->route('personnel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize("view {$this->entity}");

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

        return view('personnel.profile.show', compact('profile', 'profileRank', 'profileUnit', 'referenceDate', 'age', 'serviceSeniority', 'rankSeniority', 'careerEndDate'));
    }

    /**
     * Update calculation
     */
    public function updateCalculations(Request $request, string $id)
    {
        $profile = Profile::with('militaryDetail')->findOrFail($id);
        $profileRank = Rank::findOrFail($profile->militaryDetail->rank_id);

        $referenceDate = $request->input('reference_date', now());

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

        return response()->json([
            'age' => $age,
            'serviceSeniority' => $serviceSeniority,
            'rankSeniority' => $rankSeniority,
            'careerEndDate' => $careerEndDate ? $careerEndDate->format('d/m/Y') : null,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize("edit {$this->entity}");

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

        $ranks = Rank::all();
        $units = Unit::all();

        /* $section = $request->query('section', 'profile'); */

        return view('personnel.profile.edit', compact('profile', 'profileRank', 'profileUnit', 'ranks', 'units'/* , 'section' */));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize("edit {$this->entity}");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize("destroy {$this->entity}");

        // Trouver le profil avec l'ID donné
        $Profile = Profile::findOrFail($id);

        try {
            // Supprimer le profil
            $Profile->delete();

            // Retourne une réponse ou redirection avec un message de succès
            return redirect()
                ->route('personnel.index')
                ->with('success', __('Le profil a été supprimé avec succès.'));
        } catch (\Exception $e) {
            // Gérer les exceptions et retourner un message d'erreur
            return redirect()
                ->route('personnel.index')
                ->with('error', __('Une erreur s\'est produite lors de la suppression du profil.'));
        }
    }
}
