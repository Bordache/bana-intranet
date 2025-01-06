<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targets = ['com', 'doc', 'rh', 'stg', 'user', 'log'];
        $actions = ['view', 'create', 'edit', 'destroy'];
        $entity = ['communication', 'documentation et archives', 'ressources humaines', 'stage et formation'];

        // Créer les permissions
        foreach ($targets as $target) {
            foreach ($actions as $action) {
                Permission::findOrCreate("{$action} {$target}");
            }
        }

        // Créer les rôles et des permissions
        $adminRole = Role::Create([
            'name' => 'Administrateur',
            'description' => 'Superviseur général et responsable de la gestion complète de la plateforme',
            'guard_name' => 'web',
        ]);
        $adminRole->givePermissionTo(Permission::all());

        Role::Create([
            'name' => 'Auditeur',
            'description' => 'Évalue et analyse la performance ou la conformité du site',
            'guard_name' => 'web',
        ]);

        // Créer les rôles Managers et Collaborateurs pour chaque entité
        foreach ($entity as $entityName) {
            Role::Create([
                'name' => "Manager {$entityName}",
                'description' => "Gestion des contenus et des utilisateurs au sein du service {$entityName}",
                'guard_name' => 'web',
            ]);
            Role::Create([
                'name' => "Collaborateur {$entityName}",
                'description' => "Gestion des contenus et des utilisateurs au sein du service {$entityName}",
                'guard_name' => 'web',
            ]);
        }

        // Créer le rôle Utilisateur
        Role::Create([
            'name' => 'Utilisateur',
            'description' => 'Consommateur de contenu et participant aux fonctionnalités offertes',
            'guard_name' => 'web',
        ]);
    }

}
