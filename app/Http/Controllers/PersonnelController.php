<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
use App\Helpers\LogHelper;
use App\Models\Domain;

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
    use ValidatesRequests;

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
        $profiles = MilitaryDetail::with(['profile', 'rank'])
        ->join('profiles', 'military_details.profile_id', '=', 'profiles.id')
        ->join('ranks', 'military_details.rank_id', '=', 'ranks.id')
        ->orderBy('profiles.updated_at', 'desc')
        ->limit(5)
        ->get();
        return view('personnel.index', compact('profiles'));
    }

     /**
     * Vérifie l'unicité de `national_id`.
     *
     * @param string $national_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkNationalId($national_id)
    {
        // Validation pour s'assurer que le paramètre est bien numérique et de longueur correcte
        if (!is_numeric($national_id) || strlen($national_id) !== 12) {
            return response()->json(['error' => 'Identifiant national invalide.'], 400);
        }

        $exists = Profile::where('national_id', $national_id)->exists();

        return response()->json(['isUnique' => !$exists]);
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $expand = false;
        $perPage = 20;
        $militaryDetails = Profile::with([
            'militaryDetail',
            'academicPaths',
            'militaryPaths',
            'honoraryDistinctions',
            'militaryCampaigns',
        ])
        ->leftJoin('military_details', 'profiles.id', '=', 'military_details.profile_id')
        ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
        ->leftJoin('units', 'military_details.unit_id', '=', 'units.id')
        ->select([
            'profiles.*',
            'military_details.unit_id',
            'military_details.rank_id',
            'military_details.rank_date',
            'military_details.service_entry_date',
            'military_details.military_registration_number',
            'military_details.current_function',
            'ranks.rank_abbreviate',
            'units.unit_abbreviate',
            'profiles.updated_at as profile_updated_at'
        ])
        ->orderBy('rank_id', 'asc')
        ->orderBy('rank_date', 'desc')
        ->orderBy('service_entry_date', 'desc')
        ->paginate($perPage);

        return view("personnel.profile.list", compact('militaryDetails', 'expand', 'perPage'));
    }

    /**
     * Display a listing by unit of the resource.
     */
    public function listByUnit()
    {
        $expand = true;

        // Récupération des unités
        $units = Unit::orderBy('unit_abbreviate')->get();

        // Récupération des profils avec regroupement par unité
        $profilesByUnit = Profile::with([
            'militaryDetail',
            'academicPaths',
            'militaryPaths',
            'honoraryDistinctions',
            'militaryCampaigns',
        ])
        ->leftJoin('military_details', 'profiles.id', '=', 'military_details.profile_id')
        ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
        ->leftJoin('units', 'military_details.unit_id', '=', 'units.id')
        ->select([
            'profiles.*',
            'military_details.unit_id',
            'military_details.rank_id',
            'military_details.rank_date',
            'military_details.service_entry_date',
            'military_details.military_registration_number',
            'military_details.current_function',
            'ranks.rank_abbreviate',
            'units.unit_abbreviate',
            'profiles.updated_at as profile_updated_at'
        ])
        ->orderBy('military_details.rank_id', 'asc')
        ->orderBy('military_details.rank_date', 'desc')
        ->orderBy('military_details.service_entry_date', 'desc')
        ->get()
        ->groupBy('unit_id'); // Regroupement par unité

        return view("personnel.profile.listByUnit", compact('profilesByUnit', 'units', 'expand'));
    }


    /**
     * Display a listing of the resource by rank.
     */
    public function listByRank()
    {
        $expand = true;

        $ranks = Rank::orderBy('id')->get();

        $profilesByRank = Profile::with([
            'militaryDetail',
            'academicPaths',
            'militaryPaths',
            'honoraryDistinctions',
            'militaryCampaigns',
        ])
        ->leftJoin('military_details', 'profiles.id', '=', 'military_details.profile_id')
        ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
        ->leftJoin('units', 'military_details.unit_id', '=', 'units.id')
        ->select([
            'profiles.*',
            'military_details.unit_id',
            'military_details.rank_id',
            'military_details.rank_date',
            'military_details.service_entry_date',
            'military_details.military_registration_number',
            'military_details.current_function',
            'ranks.rank_abbreviate',
            'units.unit_abbreviate',
            'profiles.updated_at as profile_updated_at'
        ])
        ->orderBy('military_details.rank_id', 'asc')
        ->orderBy('military_details.rank_date', 'desc')
        ->orderBy('military_details.service_entry_date', 'desc')
        ->get()
        ->groupBy('rank_id');

        return view("personnel.profile.listByRank", compact('profilesByRank', 'ranks', 'expand'));
    }

    /**
     * search
     */

     public function search(Request $request)
     {
        $expand = false;
        $perPage = 20;
         $search = trim(strip_tags($request->input('search')));

         $query = Profile::with([
             'militaryDetail',
             'academicPaths',
             'militaryPaths',
             'honoraryDistinctions',
             'militaryCampaigns',
         ])
         ->leftJoin('military_details', 'profiles.id', '=', 'military_details.profile_id')
         ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
         ->leftJoin('units', 'military_details.unit_id', '=', 'units.id')
         ->select([
             'profiles.*',
             'military_details.unit_id',
             'military_details.rank_id',
             'military_details.rank_date',
             'military_details.service_entry_date',
             'military_details.military_registration_number',
             'military_details.current_function',
             'ranks.rank_abbreviate',
             'units.unit_abbreviate',
             'profiles.updated_at as profile_updated_at'
         ])
         ->when($search, function ($query) use ($search) {
             $query->where(function ($q) use ($search) {
                 $q->where('profiles.name', 'like', "%{$search}%")
                   ->orWhere('profiles.firstname', 'like', "%{$search}%")
                   ->orWhere('ranks.rank_abbreviate', 'like', "%{$search}%")
                   ->orWhere('units.unit_abbreviate', 'like', "%{$search}%")
                   ->orWhere('military_details.military_registration_number', 'like', "%{$search}%")
                   ->orWhere('military_details.current_function', 'like', "%{$search}%");

                 // Vérifier si l'entrée correspond à une date sous forme "jour/mois"
                 if (preg_match('/^(\d{1,2})\/(\d{1,2})$/', $search, $matches)) {
                     [$full, $day, $month] = $matches;
                     $q->orWhereRaw("DAY(profiles.updated_at) = ? AND MONTH(profiles.updated_at) = ?", [$day, $month]);
                 }
                 // Vérifier si l'entrée est un chiffre et rechercher dans profile_updated_at
                 elseif (is_numeric($search)) {
                     $q->orWhereRaw("DAY(profiles.updated_at) = ?", [$search])
                       ->orWhereRaw("MONTH(profiles.updated_at) = ?", [$search])
                       ->orWhereRaw("YEAR(profiles.updated_at) = ?", [$search])
                       ->orWhereRaw("HOUR(profiles.updated_at) = ?", [$search])
                       ->orWhereRaw("MINUTE(profiles.updated_at) = ?", [$search])
                       ->orWhereRaw("SECOND(profiles.updated_at) = ?", [$search]);
                 }
             });
         })
         // Appliquer le tri après le filtrage
         ->orderBy('military_details.rank_id')
         ->orderBy('military_details.rank_date')
         ->orderBy('military_details.service_entry_date')
         ->orderBy('profiles.birth_date');

         // Exécuter la requête
         $results = $query->paginate($perPage)->appends($request->query());

         return view("personnel.profile.result", compact('results', 'search', 'expand', 'perPage'));
     }

    /**
     * Custom search
     */
    public function customSearch(Request $request)
    {
        $expand = false;
        $perPage = 20;

        $query = Profile::with([
            'militaryDetail',
            'academicPaths',
            'militaryPaths',
            'honoraryDistinctions',
            'militaryCampaigns',
        ])
        ->leftJoin('military_details', 'profiles.id', '=', 'military_details.profile_id')
        ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
        ->leftJoin('units', 'military_details.unit_id', '=', 'units.id')
        ->select([
            'profiles.*',
            'military_details.unit_id',
            'military_details.rank_id',
            'military_details.rank_date',
            'military_details.service_entry_date',
            'military_details.military_registration_number',
            'military_details.current_function',
            'ranks.rank_abbreviate',
            'units.unit_abbreviate',
            'profiles.updated_at as profile_updated_at'
        ]);

        // Filtrage par grade
        if ($request->filled('rank_abbreviate')) {
            $rank = trim(strip_tags($request->rank_abbreviate));
            $query->where('ranks.rank_abbreviate', 'like', "%{$rank}%");
        }

        // Filtrage par unité
        if ($request->filled('unit_abbreviate')) {
            $unit = trim(strip_tags($request->unit_abbreviate));
            $query->where('units.unit_abbreviate', 'like', "%{$unit}%");
        }

        // Filtrage par date d'entrée en service (Vérification correcte)
        if ($request->filled('service_entry_date_before') && $request->filled('service_entry_date_after')) {
            $before = trim(strip_tags($request->service_entry_date_before));
            $after = trim(strip_tags($request->service_entry_date_after));

            if (strtotime($before) && strtotime($after)) { // Vérification des dates valides
                $query->whereBetween('military_details.service_entry_date', [$before, $after]);
            }
        }

        // Filtrage par diplôme académique
        if ($request->filled('academic_diploma')) {
            $diploma = trim(strip_tags($request->academic_diploma));
            $query->whereHas('academicPaths', function ($q) use ($diploma) {
                $q->where('diploma', 'like', "%{$diploma}%");
            });
        }

        // Filtrage par diplôme militaire
        if ($request->filled('military_diploma')) {
            $militaryDiploma = trim(strip_tags($request->military_diploma));
            $query->whereHas('militaryPaths', function ($q) use ($militaryDiploma) {
                $q->where('academy_diploma', 'like', "%{$militaryDiploma}%");
            });
        }

        // Filtrage par distinctions honorifiques
        if ($request->filled('honorary_title')) {
            $honoraryTitle = trim(strip_tags($request->honorary_title));
            $query->whereHas('honoraryDistinctions', function ($q) use ($honoraryTitle) {
                $q->where('honorary_title', 'like', "%{$honoraryTitle}%");
            });
        }

        // Filtrage par campagnes militaires (Correction de l'erreur dans ta version)
        if ($request->filled('campaign_title')) {
            $campaignTitle = trim(strip_tags($request->campaign_title));
            $query->whereHas('militaryCampaigns', function ($q) use ($campaignTitle) {
                $q->where('campaign_title', 'like', "%{$campaignTitle}%");
            });
        }

        // Appliquer le tri après le filtrage
        $query->orderBy('military_details.rank_id')
            ->orderBy('military_details.rank_date', 'desc')
            ->orderBy('military_details.service_entry_date', 'desc')
            ->orderBy('profiles.birth_date', 'asc');

        $results = $query->paginate($perPage)->appends($request->query());

        return view("personnel.profile.result", compact('results', 'expand', 'perPage'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $ranks = Rank::all();
        $units = Unit::all();
        return view("personnel.profile.create", compact('ranks', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request){

        $domainId = Domain::where('name', 'rh')->value('id');

        $validated = $request->validate(
             // Fusionner les règles des deux classes
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
                ),

                // Fusionner les messages personnalisés des deux classes
                array_merge(
                    ProfileFields::getMessages(),
                    MilitaryFields::getMessages(),
                    $request->has('spouse_name') ? SpouseFields::getMessages() : [],
                    $request->has('child_full_name') ? ChildrenFields::getMessages() : [],
                    $request->has('school_name') ? SchoolFields::getMessages() : [],
                    $request->has('academy_name') ? AcademyFields::getMessages() : [],
                    $request->has('company_name') ? CareerFields::getMessages() : [],
                    $request->has('history_rank') ? RankFields::getMessages() : [],
                    $request->has('honorary_title') ? HonoraryFields::getMessages() : [],
                    $request->has('campaign_title') ? CampaignFields::getMessages() : []
                )
        );

        // **Étape 1 : Création du profil**
        $Profile = Profile::create($validated(only(ProfileFields::getFieldNames())));


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
                    'spouse_title' => $request->spouse_title[$key],
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

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Create_profile',
            "Ajout de nouveau profil {$profile->name} {$profile->firstname}",
            $domainId
        );

        return redirect()->route('personnel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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

        // Gestion des sections
        $tab = request('tab', 'personnal_information');

        return view('personnel.profile.show', compact('profile', 'profileRank', 'profileUnit', 'selectRanks', 'selectUnits', 'referenceDate', 'age', 'serviceSeniority', 'rankSeniority', 'careerEndDate', 'tab'));
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
    public function update(Request $request, string $id, bool $auth = false)
    {
        $auth = $request->query('auth', false);
        $profile = Profile::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'national_id' => 'required|numeric|digits:12',
            'issue_date' => 'nullable|date',
            'issue_place' => 'nullable|string|max:255',
            'duplicate_date' => 'nullable|date',
            'duplicate_place' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:255',
            'size' => 'nullable|integer|min:150',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'fallback_address' => 'nullable|string|max:255',
            'driver_license' => 'nullable|string|max:255',
            'practiced_sport' => 'nullable|string|max:255',
            'hobbies' => 'nullable|string|max:255',
        ]);

        $changes = [];

        foreach ($validated as $key => $newValue) {
            $oldValue = $profile->$key;

            // Normalisation des dates pour éviter les fausses différences
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
            // Correction : Conserver les clés et les valeurs correctement
            $profile->update(collect($changes)->mapWithKeys(fn($change, $key) => [$key => $change['new']])->toArray());

            $domainId = Domain::where('name', 'rh')->value('id');

            $changeDetails = collect($changes)->map(fn($change, $field) => "{$field}: '{$change['old']}' → '{$change['new']}'")->implode(', ');

            if ($auth) {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_account_civil_details',
                    "Mise à jour des informations d'état civil du compte de " . auth()->user()->name . " " . auth()->user()->firstname . ". Modifications : {$changeDetails}",
                    null
                );
            } else {
                LogHelper::logAction(
                    auth()->id(),
                    'Update_civil_details',
                    "Mise à jour des informations d'état civil de {$profile->name} {$profile->firstname}. Modifications : {$changeDetails}",
                    $domainId
                );
            }

            return back()->with([
                'success' => 'Etat civil mis à jour avec succès.',
                'tab' => 'personal_information',
            ]);
        }

        return back()->with([
            'info' => 'Aucune modification détectée.',
            'tab' => 'personal_information',
        ]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // Trouver le profil avec l'ID donné
        $profile = Profile::findOrFail($id);

        try {
            // Supprimer le profil
            $profile->delete();

            $domainId = Domain::where('name', 'rh')->value('id');

            // Log de l'action
            LogHelper::logAction(
                auth()->id(),
                'Delete_profile',
                "Suppression de {$profile->name} {$profile->firstname}",
                $domainId
            );

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
