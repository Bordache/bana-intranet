<?php

// app/Http/Controllers/RolePermissionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Domain;
use App\Models\Objet;
use App\Models\RolePermission;
use App\Models\RoleDomain;

use App\Helpers\LogHelper;

class RolePermissionController extends Controller
{
    public function index()
    {
        $domains = Domain::with(['roles', 'roleDomains'])->Where('domain_description','!=', 'Administration du site')->get();
        $rolePermissions = RolePermission::all();
        return view('admin.roles.index', compact('domains', 'rolePermissions'));
    }

    public function edit($role_id, $domain_id)
    {
        $role = Role::findOrFail($role_id);
        $domain = Domain::findOrFail($domain_id);

        // Récupérer la description du rôle spécifique au domaine
        $roleDomain = RoleDomain::where('role_id', $role_id)
            ->where('domain_id', $domain_id)
            ->first();

        // Récupérer les objets et permissions du domaine
        $objects = Objet::where('domain_id', $domain_id)->get();
        $permissions = Permission::all();

        // Récupérer les permissions existantes pour ce rôle dans ce domaine
        $existingPermissions = RolePermission::where('role_id', $role_id)
            ->where('domain_id', $domain_id)
            ->get()
            ->pluck('permission_id', 'object_id');

        return view('admin.roles.role-permission', compact('role', 'domain', 'roleDomain', 'objects', 'permissions', 'existingPermissions'));
    }

    public function getObjectsAndPermissions(Request $request)
    {
        $domain = Domain::findOrFail($domainId);
        $objets = Objet::where('domain_id', $domain->id)->get();
        $permissions = Permission::all();

        return response()->json(['objets' => $objets, 'permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'domain_id' => 'required|exists:domains,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'domain_description' => 'nullable|string|max:255'
        ]);

        $roleId = $validatedData['role_id'];
        $domainId = $validatedData['domain_id'];
        $permissions = $validatedData['permissions'] ?? [];
        $domainDescription = $validatedData['domain_description'];

        // Mettre à jour ou créer la description du rôle pour le domaine
        $updateRole = RoleDomain::updateOrCreate(
            [
                'role_id' => $roleId,
                'domain_id' => $domainId
            ],
            [
                'domain_description' => $domainDescription
            ]
        );
        // Log de l'action
        if($updateRole) {
            $roleLog = Role::find($roleId);
            $domainLog = Domain::find($domainId);
            $userDomainId = Domain::where('name', 'admin')->value('id');
            $roleDescription = $domainDescription ? $domainDescription : 'Aucune description';
            LogHelper::logAction(
                auth()->id(),
                'Update_role',
                "Mise à jour description du rôle " . $roleLog->name . " dans domaine "  . $domainLog->name . " : " .$roleDescription,
                $userDomainId
            );
        }

        // Supprimer les anciennes permissions pour éviter les doublons
        RolePermission::where('role_id', $roleId)
            ->where('domain_id', $domainId)
            ->delete();


        // Enregistrer les nouvelles permissions
        if (!empty($request->permissions)) {
            foreach ($permissions as $objectId => $permissionIds) {
                foreach ($permissionIds as $permissionId) {
                    RolePermission::create([
                        'role_id' => $roleId,
                        'permission_id' => $permissionId,
                        'domain_id' => $domainId,
                        'object_id' => $objectId
                    ]);
                    // Log de l'action
                    $domainLog = Domain::find($domainId);
                    $roleLog = Role::find($roleId);
                    $permissionLog = Permission::find($permissionId);
                    $objectLog = Objet::find($objectId);
                    $domainId = Domain::where('name', 'admin')->value('id');
                    LogHelper::logAction(
                        auth()->id(),
                        'Update_permission',
                        $roleLog->name ." : mise à jour permission " . $permissionLog->name . " pour l'objet "  . $objectLog->name . " dans " .$domainLog->name,
                        $domainId
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Permissions et description mises à jour avec succès.');
    }
}
