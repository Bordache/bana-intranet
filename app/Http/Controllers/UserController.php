<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Domain;
use App\Models\Objet;
use App\Models\MilitaryDetail;


class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs et leurs rôles
     */
    /* public function manageUsers($domain=null)
    {
        $param = $domain;
        $superAdminRole = Role::where('name', 'Super administrateur')->first();
        if (!$superAdminRole) {
            return redirect()->back()->with('error', 'Role Super administrateur not found.');
        }

        $users = User::whereDoesntHave('roles', function ($query) use ($superAdminRole) {
            $query->where('role_id', $superAdminRole->id);
        })->with('roles')->get();
        $roles = Role::where('name', '!=', 'Super administrateur')->get();

        $domains = $domain ? Domain::where('name', '=', $domain)->with('objets')->get() : Domain::with('objets')->get();

        return view('admin.users.manage', compact('users', 'roles', 'domains', 'param'));
    } */

    public function manageUsers($domain = null)
{
    $param = $domain;

    // Vérifier si le rôle Super Administrateur existe
    $superAdminRole = Role::where('name', 'Super administrateur')->first();
    if (!$superAdminRole) {
        return redirect()->back()->with('error', 'Rôle Super Administrateur introuvable.');
    }

    // Récupérer les utilisateurs (hors Super Admins), avec leurs rôles et grade militaire
    $users = User::whereDoesntHave('roles', function ($query) use ($superAdminRole) {
            $query->where('role_id', $superAdminRole->id);
        })
        ->with(['roles', 'militaryDetail.rank'])
        ->get();

    // Récupérer les rôles (hors Super Admin)
    $roles = Role::where('name', '!=', 'Super administrateur')->get();

    $domains = $domain ? Domain::where('name', '=', $domain)->with('objets')->get() : Domain::with('objets')->get();

    return view('admin.users.manage', compact('users', 'roles', 'domains', 'param'));
}


    /**
     * Assigner un rôle à un utilisateur pour un domaine et un objet
     */
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'role_id'   => 'required|exists:roles,id',
            'domain_id' => 'required|exists:domains,id',
        ]);

        UserRole::updateOrCreate(
            [
                'user_id'   => $request->user_id,
                'domain_id' => $request->domain_id,
            ],
            [
                'role_id' => $request->role_id,
            ]
        );

        return redirect()->back()->with('success', 'Rôle assigné avec succès.');
    }

    /**
     * Supprimer un rôle d'un utilisateur pour un domaine et un objet
     */
    public function removeRole(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:user_roles,user_id',
            'domain_id' => 'required|exists:domains,id',
        ]);

        UserRole::where('user_id', $request->user_id)
            ->where('domain_id', $request->domain_id)
            ->delete();

        return redirect()->back()->with('success', 'Rôle supprimé avec succès.');
    }

    /**
     * Afficher la gestion des Super Administrateurs
     */
    public function manageAdmins()
    {
        $users = User::all();
        $superAdminRole = Role::where('name', 'Super administrateur')->first();
        $superAdmins = UserRole::where('role_id', $superAdminRole->id)->pluck('user_id')->toArray();

        return view('admin.users.admins', compact('users', 'superAdmins'));
    }

    /**
     * Assigner un utilisateur comme Super Administrateur
     */
    public function assignSuperAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $superAdminRole = Role::where('name', 'Super administrateur')->firstOrFail();

        // Vérifier si l'utilisateur est déjà Super Admin
        if (!UserRole::where('user_id', $request->user_id)->where('role_id', $superAdminRole->id)->exists()) {
            UserRole::create([
                'user_id'   => $request->user_id,
                'role_id'   => $superAdminRole->id,
                'domain_id' => null, // Super Admin = accès global
                'object_id' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Super administrateur ajouté.');
    }

    /**
     * Retirer le rôle de Super Administrateur
     */
    public function removeSuperAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $superAdminRole = Role::where('name', 'Super administrateur')->firstOrFail();

        UserRole::where('user_id', $request->user_id)
            ->where('role_id', $superAdminRole->id)
            ->delete();

        return redirect()->back()->with('success', 'Super administrateur supprimé.');
    }
}
