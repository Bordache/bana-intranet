<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleDomainSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Domaine Communication (id=1)
            ['role_id' => 2, 'domain_id' => 1, 'domain_description' => 'Superviseur général et responsable de la gestion complète de la plateforme de communication'],
            ['role_id' => 3, 'domain_id' => 1, 'domain_description' => 'Gestionnaire des contenus et des utilisateurs au sein du service communication'],
            ['role_id' => 4, 'domain_id' => 1, 'domain_description' => 'Participant aux fonctionnalités offertes par le service communication'],
            ['role_id' => 5, 'domain_id' => 1, 'domain_description' => 'Évaluateur de la performance ou la conformité du service communication'],

            // Domaine Documentation (id=2)
            ['role_id' => 2, 'domain_id' => 2, 'domain_description' => 'Superviseur général et responsable de la gestion complète de la plateforme de documentation'],
            ['role_id' => 3, 'domain_id' => 2, 'domain_description' => 'Gestionnaire des documents et des utilisateurs au sein du service documentation'],
            ['role_id' => 4, 'domain_id' => 2, 'domain_description' => 'Consultant et contributeur aux documents du service documentation'],
            ['role_id' => 5, 'domain_id' => 2, 'domain_description' => 'Évaluateur et auditeur des processus et de la conformité documentaire'],

            // Domaine Ressources humaines (id=3)
            ['role_id' => 2, 'domain_id' => 3, 'domain_description' => 'Superviseur général et responsable de la gestion des ressources humaines'],
            ['role_id' => 3, 'domain_id' => 3, 'domain_description' => 'Gestionnaire du personnel et des opérations RH'],
            ['role_id' => 4, 'domain_id' => 3, 'domain_description' => 'Utilisateur accédant aux services et informations RH'],
            ['role_id' => 5, 'domain_id' => 3, 'domain_description' => 'Auditeur des pratiques et performances des ressources humaines'],

            // Domaine Stage et formation (id=4)
            ['role_id' => 2, 'domain_id' => 4, 'domain_description' => 'Superviseur des programmes de stage et formation'],
            ['role_id' => 3, 'domain_id' => 4, 'domain_description' => 'Responsable de l’organisation des formations et stages'],
            ['role_id' => 4, 'domain_id' => 4, 'domain_description' => 'Stagiaire ou participant aux formations proposées'],
            ['role_id' => 5, 'domain_id' => 4, 'domain_description' => 'Évaluateur des sessions de formation et des performances des stagiaires'],
        ];

        DB::table('role_domains')->insert($data);
    }
}

