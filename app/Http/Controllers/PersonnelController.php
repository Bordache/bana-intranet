<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\UsernameGeneratorService;
use App\Services\PasswordGeneratorService;

use App\Models\User;
use App\Models\PasswordInit;
use App\Models\Profile;
use App\Models\Rank;
use App\Models\Unit;
use App\Models\AcademicPath;
use App\Models\ChildrenDetail;
use App\Models\HonoraryDistinction;
use App\Models\MilitaryCampaign;
use App\Models\MilitaryDetail;
use App\Models\MilitaryPath;
use App\Models\ProfessionalCareer;
use App\Models\RankHistory;
use App\Models\SpouseDetail;


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
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("view {$this->entity}");
        $profiles = Profile::all();
        return view('personnel.index', compact('profiles'));
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'unit_assignment'  => 'required|string|max:255',
            'national_id' => 'required|numeric|digits:12',
            'name' => 'required|string|max:255',
            'firstname' => 'nullable|string|max:255',
            'national_id' => 'required|numeric|digits:12|unique:profiles,national_id',
        ]);

        $exists = Profile::where('national_id', $validated['national_id'])->exists();
        return response()->json(['exists' => $exists]);
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

    // Définition des règles de validation
     $ProfileFillable = [
            'name' => [
                'required',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'firstname' => [
                'nullable',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'gender' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'national_id' => 'required|numeric|digits:12|unique:profiles,national_id',
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
            'practiced_sport' => 'nullable|string',
            'hobbies' => 'nullable|string',
        ];

        $MilitaryFillable = [
            'army' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'position_date' => 'nullable|date',
            'position_reference' => 'nullable|string|max:255',
            'military_registration_number' => 'required|string|size:6',
            'military_id_card_number' => 'nullable|string|size:6',
            'finance_registration_number' => 'nullable|string|max:255',
            'recruitment_origin' => 'nullable|string|max:255',
            'recruitment_promotion' => 'nullable|string|max:255',
            'service_entry_date' => 'required|date',
            'corps_assignment' => 'required|string|max:255',
            'unit_assignment' => 'required|string|max:255',
            'rank' => 'required|string|max:255',
            'rank_date' => 'nullable|date',
            'current_function' => 'nullable|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'exact_assignment' => 'nullable|string|max:255',
            'interruption_start_date' => 'nullable|date',
            'interruption_end_date' => 'nullable|date',
            'military_status' => 'nullable|string|max:255',
            'military_status_reference' => 'nullable|string|max:255',
            'military_driver_license' => 'nullable|string|max:255',
            'other_information' => 'nullable|string',
        ];

        $SpouseFillable = [
            'spouse_name' => 'required|array',
            'spouse_maiden_name' => 'nullable|array',
            'spouse_firstname' => 'nullable|array',
            'spouse_birth_date' => 'nullable|array',
            'spouse_birth_place' => 'nullable|array',
            'spouse_profession' => 'nullable|array',
            'marriage_authorization' => 'nullable|array',
            'spouse_name.*' => [
                'required',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'spouse_maiden_name.*' => [
                'nullable',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'spouse_firstname.*' => [
                'nullable',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'spouse_birth_date.*' => 'nullable|date',
            'spouse_birth_place.*' => 'nullable|string|max:255',
            'spouse_profession.*' => 'nullable|string|max:255',
            'marriage_authorization.*' => 'nullable|string|max:255',
        ];

        $ChildFillable = [
            'child_full_name' => 'required|array',
            'child_full_name.*' => [
                'required',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'child_birth_date' => 'required|array',
            'child_birth_date.*' => 'required|date',
            'child_birth_place' => 'nullable|array',
            'child_birth_place.*' => 'nullable|string|max:255',
            'child_gender' => 'required|array',
            'child_gender.*' => 'required|in:M,F',
            'child_status' => 'nullable|array',
            'child_status.*' => 'nullable|in:LG,RE,AD,NL',
        ];


        $SchoolFillable = [
            'school_name' => 'required|array',
            'school_name.*' => 'required|string|max:255',
            'duration' => 'required|array',
            'duration.*' => 'required|string|max:255',
            'diploma' => 'nullable|array',
            'diploma.*' => 'nullable|string',
        ];

        $AcademyFillable = [
            'academy_name' => 'required|array',
            'academy_name.*' => 'required|string|max:255',
            'academy_duration' => 'required|array',
            'academy_duration.*' => 'required|string|max:255',
            'academy_diploma' => 'nullable|array',
            'academy_diploma.*' => 'nullable|string',
        ];

        $CareerFillable = [
            'company_name' => 'required|array',
            'job_title' => 'required|array',
            'start_date' => 'required|array',
            'end_date' => 'nullable|array',
            'description' => 'nullable|array',
            'company_name.*' => 'required|string|max:255',
            'job_title.*' => 'required|string|max:255',
            'start_date.*' => 'required|date',
            'end_date.*' => 'nullable|date',
            'description.*' => 'nullable|string',
        ];

        $RankFillable = [
            'history_rank' => 'required|array',
            'history_promotion_date' => 'required|array',
            'history_rank_reference' => 'nullable|array',
            'history_rank.*' => 'required|string|max:255',
            'history_promotion_date.*' => 'required|date',
            'history_rank_reference.*' => 'nullable|string|max:255',
        ];

        $DistinctionFillable = [
            'honorary_title' => 'required|array',
            'honorary_promotion' => 'required|array',
            'honorary_reference' => 'nullable|array',
            'honorary_title.*' => 'required|string|max:255',
            'honorary_promotion.*' => 'required|string|max:255',
            'honorary_reference.*' => 'nullable|string|max:255',
        ];

        $CampaignFillable = [
            'campaign_title' => 'required|array',
            'campaign_period' => 'required|array',
            'campaign_locations' => 'required|array',
            'campaign_title.*' => 'required|string|max:255',
            'campaign_period.*' => 'required|string|max:255',
            'campaign_locations.*' => 'required|string|max:255',
        ];

       /*      // Valider les règles de validation de base
            $ValidateFields = $request->validate(
                array_merge($ProfileFillable, $MilitaryFillable)
            ); */

        // Valider les règles de validation de base
       $request->validate(
                array_merge(
                    $ProfileFillable,
                    $MilitaryFillable,
                    $request->has('spouse_name') ? $SpouseFillable : [],
                    $request->has('child_full_name') ? $ChildFillable : [],
                    $request->has('school_name') ? $SchoolFillable : [],
                    $request->has('academy_name') ? $AcademyFillable : [],
                    $request->has('company_name') ? $CareerFillable : [],
                    $request->has('history_rank') ? $RankFillable : [],
                    $request->has('honorary_title') ? $DistinctionFillable : [],
                    $request->has('campaign_title') ? $CampaignFillable : []
                )
            );
            return redirect()->route('personnel.index')->with('success', 'Profil créé avec succès.');

        // Traitez les données validées
        // $ValidateFields contient maintenant toutes les données validées

                /* $militaryDetail = MilitaryDetail::create($validatedMilitaryDetail); */

            /* // **Étape 3 : Validation et création du conjoint**
            if ($request->has('spouse_detail')) {
                $validatedSpouseDetail = $request->validate([
                    'spouse_name' => 'required|string|max:255',
                    'spouse_maiden_name' => 'nullable|string|max:255',
                    'spouse_firstname' => 'nullable|string|max:255',
                    'spouse_birth_date' => 'nullable|date',
                    'spouse_birth_place' => 'nullable|string|max:255',
                    'spouse_profession' => 'nullable|string|max:255',
                    'marriage_authorization' => 'nullable|string|max:255',
                ]);

               /* $spouseDetail = SpouseDetail::create($validatedSpouseDetail); */
           /*  } */

            // **Étape 4 : Validation et création des enfants**
           /*  if ($request->has('children_details')) {
                foreach ($request->children_details as $child) {
                    $validatedChild = $request->validate([
                        'child_full_name' => 'required|string|max:255',
                        'child_birth_date' => 'required|date',
                        'child_birth_place' => 'nullable|string|max:255',
                        'child_gender' => 'required|string|max:255',
                        'child_status' => 'nullable|string|max:255',
                    ]);

                    /* $profile->childrenDetails()->create($validatedChild); */
            /*     }
            } */

            // **Étape 5 : Validation et création des parcours académiques**
            /* if ($request->has('academic_paths')) {
                foreach ($request->academic_paths as $path) {
                    $validatedPath = $request->validate([
                        'school_name' => 'required|string|max:255',
                        'duration' => 'required|string|max:255',
                        'diploma' => 'nullable|string',
                    ]);

                    /* $profile->academicPaths()->create($validatedPath); */
            /*     }
            } */

             // **Étape 5 : Validation et création des parcours militaire**
            /*  if ($request->has('military_paths')) {
                foreach ($request->military_paths as $path) {
                    $validatedPath = $request->validate([
                        'academy_school_name' => 'required|string|max:255',
                        'academy_duration' => 'required|string|max:255',
                        'academy_diploma' => 'nullable|string',
                    ]);

                   /*  $profile->militaryPaths()->create($validatedPath); */
              /*   }
            } */

            // **Étape 6 : Parcours professionnels**
           /*  if ($request->has('professional_careers')) {
                foreach ($request->professional_careers as $career) {
                    $validatedCareer = $request->validate([
                        'company_name' => 'required|string|max:255',
                        'job_title' => 'required|string|max:255',
                        'start_date' => 'required|date',
                        'end_date' => 'nullable|date',
                        'description' => 'nullable|string',
                    ]);

                    /* $profile->professionalCareers()->create($validatedCareer); */
               /*  }
            } */

            // **Étape 7 : Grades**
            /* if ($request->has('rank_histories')) {
                foreach ($request->rank_histories as $rank) {
                    $validatedRank = $request->validate([
                        'history_rank' => 'required|string|max:255',
                        'history_promotion_date' => 'required|date',
                        'history_rank_reference' => 'nullable|string|max:255',
                    ]);

                    /* $profile->rankHistories()->create($validatedRank); */
                /* }
            } */

            // **Étape 8 : Distinctions honorifiques**
            /* if ($request->has('honorary_distinctions')) {
                foreach ($request->honorary_distinctions as $distinction) {
                    $validatedDistinction = $request->validate([
                        'honorary_title' => 'required|string|max:255',
                        'honorary_promotion' => 'required|string|max:255',
                        'honorary_reference' => 'nullable|string|max:255',
                    ]);

                    /* $profile->honoraryDistinctions()->create($validatedDistinction); */
               /*  }
            } */

            // **Étape 9 : Campagnes militaires**
            /* if ($request->has('military_campaigns')) {
                foreach ($request->military_campaigns as $campaign) {
                    $validatedCampaign = $request->validate([
                        'campaign_title' => 'required|string|max:255',
                        'campaign_period' => 'required|string|max:255',
                        'campaign_locations' => 'required|string|max:255',
                    ]);

                    /* $profile->militaryCampaigns()->create($validatedCampaign); */
                /* }
            } */

        /*     return redirect()->route('personnel.index')->with('success', 'Profil créé avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
        /* /* } */
     /* }   */
    }



    public function storeOld(Request $request)
    {
        $this->authorize("create {$this->entity}");

        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-ZÀ-ÖØ-öø-ÿa-z\s\'\-]+$/u',
            'firstname' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'national_id' => 'required|numeric|digits:12|unique:profiles,national_id',
            'issue_date' => 'nullable|date',
            'issue_place' => 'nullable|string|max:255',
            'duplicate_date' => 'nullable|date',
            'duplicate_place' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15|regex:/^\+?\d{9,15}$/',
            'email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:10',
            'size' => 'nullable|integer|min:1',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'fallback_address' => 'nullable|string|max:255',
        ]);

        // Génération d'un username unique
        $username = $this->usernameGenerator->generateUniqueUsername($validated['name'], $validated['firstname']);

        // Génération d'un mot de passe aléatoire
        $passwordRandom = $this->passwordGenerator->passwordGenerator(8);

        // Domain email
        $domain = '@emmn.mg';

        // Ajout du profil
        Profile::create($validated);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'firstname' => $validated['firstname'],
            'email' => $username . $domain,
            'username' => $username,
            'password' => Hash::make($passwordRandom),
        ]);

        // Stockage du mot de passe généré dans PasswordInit
        PasswordInit::create([
            'user_id' => $user->id,
            'password' => $passwordRandom,
        ]);

        // Création de l'événement Registered pour envoyer un email de bienvenue, etc.
        event(new Registered($user));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = Profile::findOrFail($id);
        return view('personnel.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize("edit {$this->entity}");
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
    }
}
