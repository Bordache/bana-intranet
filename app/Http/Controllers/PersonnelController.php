<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordInit;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\UsernameGeneratorService;
use App\Services\PasswordGeneratorService;
use App\Models\Profile;
use App\Models\Rank;
use App\Models\Unit;


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
/*     public function store(Request $request)
    {
        $this->authorize("create {$this->entity}");

        $validated = $request->validate([
            'name' => 'required|string|max:255',
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
            'phone' => 'nullable|string|max:15|regex:/^\+?\d{9,15}$/', // Validation pour téléphone international
            'email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:10',
            'size' => 'nullable|integer|min:1', // Taille doit être un entier positif
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

    } */

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-ZÀ-ÖØ-öø-ÿa-z\s\'\-]+$/u',
        ]);
        return redirect()->back()->with('success', 'Validation réussie');
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
