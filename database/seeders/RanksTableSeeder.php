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
            ['name' => 'Amiral', 'abbreviate' => 'AMR'],
            ['name' => 'Vice-amiral d\'escadre', 'abbreviate' => 'VAE'],
            ['name' => 'Vice-amiral', 'abbreviate' => 'VAM'],
            ['name' => 'Contre-amiral', 'abbreviate' => 'CAM'],
            ['name' => 'Capitaine de vaisseau', 'abbreviate' => 'CVA'],
            ['name' => 'Capitaine de frégate', 'abbreviate' => 'CFR'],
            ['name' => 'Capitaine de corvette', 'abbreviate' => 'CCO'],
            ['name' => 'Lieutenant de vaisseau', 'abbreviate' => 'LTV'],
            ['name' => 'Enseigne de vaisseau de première classe', 'abbreviate' => 'EV1'],
            ['name' => 'Enseigne de vaisseau de deuxième classe', 'abbreviate' => 'EV2'],
            ['name' => 'Maître principal', 'abbreviate' => 'MAP'],
            ['name' => 'Premier-maître', 'abbreviate' => 'PMA'],
            ['name' => 'Maître', 'abbreviate' => 'MAI'],
            ['name' => 'Second-maître hors classe', 'abbreviate' => 'SMHC'],
            ['name' => 'Second-maître de première classe', 'abbreviate' => 'SM1'],
            ['name' => 'Second-maître de deuxième classe', 'abbreviate' => 'SM2'],
            ['name' => 'Quartier-maître de première classe', 'abbreviate' => 'QM1'],
            ['name' => 'Quartier-maître de deuxième classe', 'abbreviate' => 'QM2'],
            ['name' => 'Matelot de première classe', 'abbreviate' => 'MO1'],
            ['name' => 'Matelot de deuxième classe', 'abbreviate' => 'MO2'],
            ['name' => 'Matelot de première classe PDL', 'abbreviate' => 'MO1 PDL'],
            ['name' => 'Matelot de deuxième classe PDL', 'abbreviate' => 'MO2 PDL'],
        ];

        DB::table('ranks')->insert($ranks);
    }
}
