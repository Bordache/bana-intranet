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
            ['rank_name' => 'Amiral', 'rank_abbreviate' => 'AMR'],
            ['rank_name' => 'Vice-amiral d\'escadre', 'rank_abbreviate' => 'VAE'],
            ['rank_name' => 'Vice-amiral', 'rank_abbreviate' => 'VAM'],
            ['rank_name' => 'Contre-amiral', 'rank_abbreviate' => 'CAM'],
            ['rank_name' => 'Capitaine de vaisseau', 'rank_abbreviate' => 'CVA'],
            ['rank_name' => 'Capitaine de frégate', 'rank_abbreviate' => 'CFR'],
            ['rank_name' => 'Capitaine de corvette', 'rank_abbreviate' => 'CCO'],
            ['rank_name' => 'Lieutenant de vaisseau', 'rank_abbreviate' => 'LTV'],
            ['rank_name' => 'Enseigne de vaisseau de première classe', 'rank_abbreviate' => 'EV1'],
            ['rank_name' => 'Enseigne de vaisseau de deuxième classe', 'rank_abbreviate' => 'EV2'],
            ['rank_name' => 'Maître principal', 'rank_abbreviate' => 'MAP'],
            ['rank_name' => 'Premier-maître', 'rank_abbreviate' => 'PMA'],
            ['rank_name' => 'Maître', 'rank_abbreviate' => 'MAI'],
            ['rank_name' => 'Second-maître hors classe', 'rank_abbreviate' => 'SMHC'],
            ['rank_name' => 'Second-maître de première classe', 'rank_abbreviate' => 'SM1'],
            ['rank_name' => 'Second-maître de deuxième classe', 'rank_abbreviate' => 'SM2'],
            ['rank_name' => 'Quartier-maître de première classe', 'rank_abbreviate' => 'QM1'],
            ['rank_name' => 'Quartier-maître de deuxième classe', 'rank_abbreviate' => 'QM2'],
            ['rank_name' => 'Matelot de première classe', 'rank_abbreviate' => 'MO1'],
            ['rank_name' => 'Matelot de deuxième classe', 'rank_abbreviate' => 'MO2'],
            ['rank_name' => 'Matelot de première classe PDL', 'rank_abbreviate' => 'MO1 PDL'],
            ['rank_name' => 'Matelot de deuxième classe PDL', 'rank_abbreviate' => 'MO2 PDL'],
        ];

        DB::table('ranks')->insert($ranks);
    }
}
