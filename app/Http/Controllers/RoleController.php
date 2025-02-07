<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Domain;
use App\Models\Objet;
use App\Models\UserRole;

use App\Helpers\LogHelper;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('name', '!=', 'Super administrateur')->with('permissions')->get();
        $permissions = Permission::all();
        $domains = Domain::with('objets')->get();

        return view('admin.roles.index', compact('roles', 'permissions', 'domains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Rôle ajouté avec succès.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|unique:roles,name|max:255',
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->update(['name' => $request->name]);

        return redirect()->back()->with('success', 'Rôle mis à jour.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        if ($role->name === 'Super administrateur') {
            return redirect()->back()->with('error', 'Impossible de supprimer le Super Administrateur.');
        }

        // Vérifier si des utilisateurs ont ce rôle
        if (UserRole::where('role_id', $role->id)->exists()) {
            return redirect()->back()->with('error', 'Ce rôle est attribué à des utilisateurs et ne peut pas être supprimé.');
        }

        $role->delete();

        return redirect()->back()->with('success', 'Rôle supprimé avec succès.');
    }

    public function updatePermissions(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'domain_id' => 'required|exists:domains,id',
            'object_id' => 'nullable|exists:objects,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        if ($role->name === 'Super administrateur') {
            return redirect()->back()->with('error', 'Le Super Administrateur possède déjà toutes les permissions.');
        }

        // Supprimer les anciennes permissions pour ce domaine et cet objet
        $role->permissions()->wherePivot('domain_id', $request->domain_id)
                            ->wherePivot('object_id', $request->object_id)
                            ->detach();

        // Ajouter les nouvelles permissions pour ce domaine et cet objet
        foreach ($request->permissions as $permissionId) {
            $role->permissions()->attach($permissionId, [
                'domain_id' => $request->domain_id,
                'object_id' => $request->object_id,
            ]);
        }

        return redirect()->back()->with('success', 'Permissions mises à jour.');
    }
}
