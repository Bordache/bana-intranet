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
            ['name' => 'Unité Marine', 'abbreviate' => 'UM'],
            ['name' => 'Établissement de Réparation et d’Entretien Navals', 'abbreviate' => 'EREN'],
            ['name' => 'Service Technique', 'abbreviate' => 'ST'],
            ['name' => 'Service Adapté du Commissariat des Armées', 'abbreviate' => 'SACA'],
            ['name' => 'Service Système Informatique et Télécommunication', 'abbreviate' => 'SSIT'],
            ['name' => 'Service Assistance Portuaire et Plongée', 'abbreviate' => 'SAPP'],
            ['name' => 'Service Opération et Instruction', 'abbreviate' => 'SOI'],
            ['name' => 'Compagnie de Protection et des Services', 'abbreviate' => 'CPS'],
            ['name' => 'Ecole Militaire de la Marine Malagasy', 'abbreviate' => 'E3M'],
            ['name' => 'Détachement Naval de Nosy-Be', 'abbreviate' => 'DNNB'],
            ['name' => 'Détachement Naval de Sainte-Marie', 'abbreviate' => 'DNSM'],
            ['name' => 'Détachement Naval de Mahajanga', 'abbreviate' => 'DNMG'],
            ['name' => 'Détachement Naval de Tuléar', 'abbreviate' => 'DNTL'],
            ['name' => 'Détachement Naval de Fort-Dauphin', 'abbreviate' => 'DNFD'],
            ['name' => 'Remorqueur Côtier Trozona', 'abbreviate' => 'RC TZN'],
            ['name' => 'Patrouilleur Côtier Malaky', 'abbreviate' => 'PC MLK'],
            ['name' => 'Patrouilleur Côtier Tselatra', 'abbreviate' => 'PC TSL'],
        ];

        DB::table('units')->insert($units);
    }
}
