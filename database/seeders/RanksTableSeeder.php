<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ranks = [
            ['rank_name' => 'Amiral', 'rank_abbreviate' => 'AMR', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Vice-amiral d\'escadre', 'rank_abbreviate' => 'VAE', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Vice-amiral', 'rank_abbreviate' => 'VAM', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Contre-amiral', 'rank_abbreviate' => 'CAM', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Capitaine de vaisseau', 'rank_abbreviate' => 'CVA', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Capitaine de frégate', 'rank_abbreviate' => 'CFR', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Capitaine de corvette', 'rank_abbreviate' => 'CCO', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Lieutenant de vaisseau', 'rank_abbreviate' => 'LTV', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Enseigne de vaisseau de première classe', 'rank_abbreviate' => 'EV1', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Enseigne de vaisseau de deuxième classe', 'rank_abbreviate' => 'EV2', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Maître principal', 'rank_abbreviate' => 'MAP', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Premier-maître', 'rank_abbreviate' => 'PMA', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Maître', 'rank_abbreviate' => 'MAI', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Second-maître hors classe', 'rank_abbreviate' => 'SMHC', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Second-maître de première classe', 'rank_abbreviate' => 'SM1', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Second-maître de deuxième classe', 'rank_abbreviate' => 'SM2', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Quartier-maître de première classe', 'rank_abbreviate' => 'QM1', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Quartier-maître de deuxième classe', 'rank_abbreviate' => 'QM2', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Matelot de première classe', 'rank_abbreviate' => 'MO1', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Matelot de deuxième classe', 'rank_abbreviate' => 'MO2', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Matelot de première classe PDL', 'rank_abbreviate' => 'MO1 PDL', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Matelot de deuxième classe PDL', 'rank_abbreviate' => 'MO2 PDL', 'created_at' => now(),'updated_at' => now()],
            ['rank_name' => 'Personnel civil', 'rank_abbreviate' => 'PC', 'created_at' => now(),'updated_at' => now()],
        ];

        DB::table('ranks')->insert($ranks);
    }
}
