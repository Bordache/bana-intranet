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

class RolePermissionController extends Controller
{
    public function index()
    {
        $domains = Domain::with(['roles', 'roleDomains'])
            ->where('domain_description', '!=', 'Administration du site')
            ->get();
        $rolePermissions = RolePermission::all();

        return view('admin.roles.index', compact('domains', 'rolePermissions'));
    }

    public function edit($role_id, $domain_id)
    {
        $role = Role::findOrFail($role_id);
        $domain = Domain::findOrFail($domain_id);
        $roleDomain = RoleDomain::where('role_id', $role_id)
            ->where('domain_id', $domain_id)
            ->first();

        $objects = Objet::where('domain_id', $domain_id)->get();
        $permissions = Permission::all();

        $existingPermissions = RolePermission::where('role_id', $role_id)
            ->where('domain_id', $domain_id)
            ->get()
            ->groupBy('object_id')
            ->map(fn ($items) => $items->pluck('permission_id')->toArray())
            ->toArray();

        return view('admin.roles.role-permission', compact('role', 'domain', 'roleDomain', 'objects', 'permissions', 'existingPermissions'));
    }

    public function getObjectsAndPermissions(Request $request)
    {
        $domain = Domain::findOrFail($request->domain_id);
        $objects = Objet::where('domain_id', $domain->id)->get();
        $permissions = Permission::all();

        return response()->json(['objects' => $objects, 'permissions' => $permissions]);
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

        RoleDomain::updateOrCreate(
            ['role_id' => $roleId, 'domain_id' => $domainId],
            ['domain_description' => $domainDescription]
        );

        // Suppression des anciennes permissions
        RolePermission::where('role_id', $roleId)
            ->where('domain_id', $domainId)
            ->delete();

        // Insertion des nouvelles permissions
        $data = [];
        $timestamp = now();
        foreach ($permissions as $objectId => $permissionIds) {
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

        // Log de l’action
        if (auth()->check()) {
            $roleLog = Role::find($roleId);
            $domainLog = Domain::find($domainId);
            $userDomainId = Domain::where('name', 'admin')->value('id');
            $roleDescription = $domainDescription ?: 'Aucune description';

            LogHelper::logAction(
                auth()->id(),
                'Update_role',
                "Mise à jour description du rôle {$roleLog->name} dans domaine {$domainLog->name} : $roleDescription",
                $userDomainId
            );
        }

        return redirect()->back()->with('success', 'Permissions et description mises à jour avec succès.');
    }
}
