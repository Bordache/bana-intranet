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
        $domain = Domain::findOrFail($request->domain_id);
        $objets = Objet::where('domain_id', $domain->id)->get();
        $permissions = Permission::all();

        return response()->json(['objets' => $objets, 'permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'domain_id' => 'required|exists:domains,id',
            'permissions' => 'nullable|array',
            'domain_description' => 'nullable|string|max:255'
        ]);

        // Mettre à jour ou créer la description du rôle pour le domaine
        $updateRole = RoleDomain::updateOrCreate(
            [
                'role_id' => $request->role_id,
                'domain_id' => $request->domain_id
            ],
            [
                'domain_description' => $request->domain_description
            ]
        );
        // Log de l'action
        if($updateRole) {
            $roleLog = Role::find($request->role_id);
            $domainLog = Domain::find($request->domain_id);
            $domainId = Domain::where('name', 'admin')->value('id');
            $roleDescription = $request->domain_description;
            LogHelper::logAction(
                auth()->id(),
                'Update_role',
                "Mise à jour description du rôle " . $roleLog->name . " dans domaine "  . $domainLog->name . " : " .$roleDescription,
                $domainId
            );
        }

        // Supprimer les anciennes permissions pour éviter les doublons
        RolePermission::where('role_id', $request->role_id)
            ->where('domain_id', $request->domain_id)
            ->delete();

        // Enregistrer les nouvelles permissions
        if (!empty($request->permissions)) {
            foreach ($request->permissions as $object_id => $permissionsArray) {
                foreach ($permissionsArray as $permission_id) {
                    RolePermission::create([
                        'role_id' => (int) $request->role_id,
                        'domain_id' => (int) $request->domain_id,
                        'object_id' => (int) $object_id,
                        'permission_id' => (int) $permission_id,
                    ]);
                    // Log de l'action
                    $domainLog = Domain::find($request->domain_id);
                    $roleLog = Role::find($request->role_id);
                    $permissionLog = Permission::find($permission_id);
                    $objectLog = Objet::find($object_id);
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
