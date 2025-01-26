<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\MilitaryDetail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Observers\ProfileObserver;
use Exception;

class DatabaseSeeder extends Seeder
{
     /*
     * Seed the application's database.
     */

    public function run(): void
    {
        try {
            DB::beginTransaction();
   
            ProfileObserver::$disable = true;

                // Création du profil Admin
                $profile = Profile::create([
                    'name' => 'Administrateur',
                    'national_id' => '111111111111',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Création des détails militaires
                $profile->militaryDetail()->create([
                    'army' => 'Autre',
                    'position' => 'En activité',
                    'military_registration_number' => 'S/MLE',
                    'service_entry_date' => now(),
                    'corps_assignment' => 'BANA',
                    'unit_id' => '1',
                    'rank_id' => '23',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
            ProfileObserver::$disable = false;

            // Création de l'utilisateur lié au profil

            $passAdmin = 'admin';
            $user = User::create([
                'name' => $profile->name,
                'email' => 'admin@emmn.mg',
                'email_verified_at' => now(),
                'username' => 'admin',
                'password' => Hash::make($passAdmin),
                'password_changed' => true,
                'profile_id' => $profile->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Attribution du rôle "Administrateur" à l'utilisateur
            $adminRole = Role::where('name', 'Administrateur')->first();
            if ($adminRole) {
                $user->assignRole($adminRole);
            } else {
                throw new Exception('Role Administrateur introuvable. Assurez-vous que RolesAndPermissionsSeeder a été exécuté.');
            }

            DB::commit();

            $this->command->info('Database seeded successfully!');
        } catch (Exception $e) {
            DB::rollBack();

            logger()->error('Database seeding failed: ' . $e->getMessage());
            $this->command->error('An error occurred while seeding the database. Check the logs for more details.');
        }
    }
}