<?php
namespace App\Observers;

use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\User;
use App\Models\PasswordInit;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Domain;
use App\Services\UsernameGeneratorService;
use App\Services\PasswordGeneratorService;

class ProfileObserver
{
    public static $disable = false;

    protected $usernameGenerator;
    protected $passwordGenerator;

    /**
     * Injecte les services de génération de username et password.
     */
    public function __construct()
    {
        $this->usernameGenerator = new UsernameGeneratorService();
        $this->passwordGenerator = new PasswordGeneratorService();
    }

    /**
     * Handle the Profile "created" event.
     */
    public function created(Profile $profile): void
    {
        if (self::$disable) {
            return;
        }

        // Génération du username et du mot de passe aléatoire
        $username = $this->usernameGenerator->generateUniqueUsername($profile->name, $profile->firstname);
        $passwordRandom = $this->passwordGenerator->passwordGenerator(8);
        $domainEmail = '@emmn.mg';

        // Création de l'utilisateur
        $user = User::create([
            'profile_id' => $profile->id,
            'name' => $profile->name,
            'firstname' => $profile->firstname,
            'username' => $username,
            'password' => Hash::make($passwordRandom),
            'email' => $username . $domainEmail,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Stockage du mot de passe initial
        PasswordInit::create([
            'user_id' => $user->id,
            'password' => $passwordRandom,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 🔹 Assignation automatique du rôle "Utilisateur standard" au domaine "Comm"
        $role = Role::where('name', 'Utilisateur standard')->first();
        $domain = Domain::where('name', 'comm')->first();

        if ($role && $domain) {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $role->id,
                'domain_id' => $domain->id,
            ]);
        }
    }
}
