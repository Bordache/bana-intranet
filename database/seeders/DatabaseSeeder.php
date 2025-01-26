<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\MilitaryDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {

            DB::beginTransaction();

            $profile = Profile::create([
                'name' => 'Admin',
                'national_id' => '111111111111',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

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

            DB::commit();

            $this->command->info('Database seeded successfully!');
        } catch (Exception $e) {
            DB::rollBack();

            logger()->error('Database seeding failed: ' . $e->getMessage());

            $this->command->error('An error occurred while seeding the database. Check the logs for more details.');
        }
    }
}

