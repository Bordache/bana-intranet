<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Domain;
use App\Models\Objet;
use App\Models\RolePermission;
use App\Models\RoleDomain;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    /**
     * Affiche la liste des rôles et permissions
     */
    public function index($domainName = null)
{
    // Récupération de l'ID du domaine s'il existe
    $domain_id = $domainName ? Domain::where('name', $domainName)->value('id') : null;

    // Récupération des domaines avec leurs rôles et relations
    $domains = Domain::with([
            'roles',
            'roleDomains'
        ])
        ->when($domain_id, fn ($query) => $query->where('id', $domain_id))
        ->where('domain_description', '!=', 'Administration du site')
        ->get();

    // Récupération des permissions associées aux rôles
    $rolePermissions = RolePermission::all();

    return compact('domains', 'rolePermissions');
}


    /**
     * Affiche la liste des roles et permissions pour admin
     */
    public function indexAdmin(){
        $data = $this->index();
        return view('admin.roles.index', $data);
    }

    /**
     * Affiche la liste des roles et permissions pour rh
     */
    public function indexRh(){
        $data = $this->index('rh');
        return view('personnel.roles.index', $data);
    }

    /**
     * Editer les permissions d'un rôle
     */
    public function editPermission($role_id, $domain_id,)
    {
        $role = Role::findOrFail($role_id);
        $domain = Domain::findOrFail($domain_id);
        $roleDomain = RoleDomain::where('role_id', $role_id)
            ->where('domain_id', $domain_id)
            ->first();

        $objects = Objet::where('domain_id', $domain_id)->orderBy('object_description')->get();
        $permissions = Permission::all();

        $existingPermissions = RolePermission::where('role_id', $role_id)
            ->where('domain_id', $domain_id)
            ->get()
            ->groupBy('object_id')
            ->map(fn ($items) => $items->pluck('permission_id')->toArray())
            ->toArray();

        return compact('role', 'domain', 'roleDomain', 'objects', 'permissions', 'existingPermissions');
    }

    public function getObjectsAndPermissions(Request $request)
    {
        $domain = Domain::findOrFail($request->domain_id);
        $objects = Objet::where('domain_id', $domain->id)->get();
        $permissions = Permission::all();

        return response()->json(['objects' => $objects, 'permissions' => $permissions]);
    }

    /**
     * Editer les permissions d'un rôle pour admin
     */
    public function editPermissionAdmin($role_id, $domain_id)
    {
        $data = $this->editPermission($role_id, $domain_id);
        return view('admin.roles.role-permission', $data);
    }

    /**
     * Editer les permissions d'un rôle pour rh
     */
    public function editPermissionRh($role_id, $domain_id)
    {
        $data = $this->editPermission($role_id, $domain_id);
        return view('personnel.roles.role-permission', $data);
    }

    /**
     * Mettre à jour les permissions d'un rôle
     */
    public function storePermission(Request $request, $domainName = null)
    {
        DB::beginTransaction();

        try {
            // Déterminer l'ID du domaine en fonction du nom
            $userDomainId = $domainName
                ? Domain::where('name', $domainName)->value('id')
                : Domain::where('name', 'admin')->value('id');

            // Validation des données d'entrée
            $validatedData = $request->validate([
                'role_id' => 'required|exists:roles,id',
                'domain_id' => 'required|exists:domains,id',
                'permissions' => 'nullable|array',
                'permissions.*' => 'array', // Correction : Chaque entrée doit être un tableau
                'permissions.*.*' => 'exists:permissions,id',
                'domain_description' => 'nullable|string|max:255'
            ]);

            $roleId = $validatedData['role_id'];
            $domainId = $validatedData['domain_id'];
            $permissions = $validatedData['permissions'] ?? [];
            $domainDescription = $validatedData['domain_description'] ?? 'Aucune';

            // Récupération des données actuelles pour éviter les modifications inutiles
            $existingRoleDomain = RoleDomain::firstOrCreate(
                ['role_id' => $roleId, 'domain_id' => $domainId],
                ['domain_description' => $domainDescription]
            );

            $existingPermissions = RolePermission::where('role_id', $roleId)
                ->where('domain_id', $domainId)
                ->pluck('permission_id', 'object_id')
                ->toArray();

            $hasChanges = false;
            $changes = [];

            // Mise à jour de la description si nécessaire
            if ($existingRoleDomain->domain_description !== $domainDescription) {
                $existingRoleDomain->update(['domain_description' => $domainDescription]);
                $hasChanges = true;
                $changes[] = "domain_description: '{$existingRoleDomain->domain_description}' → '{$domainDescription}'";
            }

            // Gestion des permissions
            $newPermissions = [];
            foreach ($permissions as $objectId => $permissionIds) {
                foreach ($permissionIds as $permissionId) {
                    $newPermissions[$objectId][] = $permissionId;
                }
            }

            if ($newPermissions !== $existingPermissions) {
                $hasChanges = true;
                $changes[] = "permissions: '" . json_encode($existingPermissions) . "' → '" . json_encode($newPermissions) . "'";

                // Suppression uniquement des permissions modifiées
                RolePermission::where('role_id', $roleId)->where('domain_id', $domainId)->delete();

                // Ajout des nouvelles permissions
                $data = [];
                $timestamp = now();
                foreach ($newPermissions as $objectId => $permissionIds) {
                    foreach ($permissionIds as $permissionId) {
                        $data[] = [
                            'role_id' => $roleId,
                            'domain_id' => $domainId,
                            'object_id' => $objectId,
                            'permission_id' => $permissionId,
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    }
                }

                if (!empty($data)) {
                    RolePermission::insert($data);
                }
            }

            // Log des modifications si des changements ont eu lieu
            if ($hasChanges && auth()->check()) {
                $roleLog = Role::find($roleId);
                $domainLog = Domain::find($domainId);

                LogHelper::logAction(
                    auth()->id(),
                    'Update_role',
                    "Mise à jour du rôle {$roleLog->name} dans domaine {$domainLog->name}. Modifications : " . implode(", ", $changes),
                    $userDomainId
                );
            }

            DB::commit();

            return redirect()->back()->with(
                $hasChanges ? 'success' : 'info',
                $hasChanges ? 'Permissions et description mises à jour avec succès.' : 'Aucune modification n\'a été faite.'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Mettre à jour les permissions d'un rôle pour admin
     */
    public function storePermissionAdmin(Request $request)
    {
        return $this->storePermission($request);
    }

    /**
     * Mettre à jour les permissions d'un rôle pour rh
     */
    public function storePermissionRh(Request $request)
    {
        return $this->storePermission($request, 'rh');
    }


}
