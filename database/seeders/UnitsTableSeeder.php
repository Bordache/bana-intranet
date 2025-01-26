<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['unit_name' => 'Unité Marine', 'unit_abbreviate' => 'UM'],
            ['unit_name' => 'Établissement de Réparation et d’Entretien Navals', 'unit_abbreviate' => 'EREN'],
            ['unit_name' => 'Direction du port', 'unit_abbreviate' => 'DP'],
            ['unit_name' => 'Compagnie de Protection et des Services', 'unit_abbreviate' => 'CPS'],
            ['unit_name' => 'Ecole Militaire de la Marine Malagasy', 'unit_abbreviate' => 'E3M'],
            ['unit_name' => 'Détachement Naval de Nosy-Be', 'unit_abbreviate' => 'DNNB'],
            ['unit_name' => 'Détachement Naval de Sainte-Marie', 'unit_abbreviate' => 'DNSM'],
            ['unit_name' => 'Détachement Naval de Mahajanga', 'unit_abbreviate' => 'DNMG'],
            ['unit_name' => 'Détachement Naval de Tuléar', 'unit_abbreviate' => 'DNTL'],
            ['unit_name' => 'Détachement Naval de Fort-Dauphin', 'unit_abbreviate' => 'DNFD'],
            ['unit_name' => 'Remorqueur Côtier Trozona', 'unit_abbreviate' => 'RC TZN'],
            ['unit_name' => 'Patrouilleur Côtier Malaky', 'unit_abbreviate' => 'PC MLK'],
            ['unit_name' => 'Patrouilleur Côtier Tselatra', 'unit_abbreviate' => 'PC TSL'],
        ];

        DB::table('units')->insert($units);
    }
}
