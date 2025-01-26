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
            ['unit_name' => 'Unité Marine', 'unit_abbreviate' => 'UM', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Établissement de Réparation et d’Entretien Navals', 'unit_abbreviate' => 'EREN', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Direction du port', 'unit_abbreviate' => 'DP', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Compagnie de Protection et des Services', 'unit_abbreviate' => 'CPS', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Ecole Militaire de la Marine Malagasy', 'unit_abbreviate' => 'E3M', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Détachement Naval de Nosy-Be', 'unit_abbreviate' => 'DNNB', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Détachement Naval de Sainte-Marie', 'unit_abbreviate' => 'DNSM', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Détachement Naval de Mahajanga', 'unit_abbreviate' => 'DNMG', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Détachement Naval de Tuléar', 'unit_abbreviate' => 'DNTL', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Détachement Naval de Fort-Dauphin', 'unit_abbreviate' => 'DNFD', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Remorqueur Côtier Trozona', 'unit_abbreviate' => 'RC TZN', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Patrouilleur Côtier Malaky', 'unit_abbreviate' => 'PC MLK', 'created_at' => now(),'updated_at' => now()],
            ['unit_name' => 'Patrouilleur Côtier Tselatra', 'unit_abbreviate' => 'PC TSL', 'created_at' => now(),'updated_at' => now()],
        ];

        DB::table('units')->insert($units);
    }
}
