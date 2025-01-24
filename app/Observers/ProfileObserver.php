<?php

namespace App\Observers;

use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\User;
use App\Models\PasswordInit;
use App\Services\UsernameGeneratorService;
use App\Services\PasswordGeneratorService;

class ProfileObserver
{
    protected $usernameGenerator;
    protected $passwordGenerator;

    /**
     * Injecte le service de génération de username.
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
         $username = $this->usernameGenerator->generateUniqueUsername($profile->name, $profile->firstname);
         $passwordRandom = $this->passwordGenerator->passwordGenerator(8);

         $domain = '@emmn.mg';

         $user = User::create([
            'profile_id' => $profile->id,
            'name' => $profile->name,
            'firstname' => $profile->firstname,
            'username' => $username,
            'email' => $username . $domain,
            'user_unit' => $profile->militaryDetail->unit_id,
            'password' => Hash::make($passwordRandom),

        ]);

        PasswordInit::create([
            'user_id' => $user->id,
            'password' => $passwordRandom,
        ]);
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updated(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $profile): void
    {
        $profile->user()->delete();
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $profile): void
    {
        //
    }
}
