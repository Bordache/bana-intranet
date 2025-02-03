<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Domain;
use App\Models\Objet;
use App\Models\MilitaryDetail;
use App\Helpers\LogHelper;


class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs et leurs rôles
     */
    public function manageUsers()
    {
        $search = null;
        $allUsers = User::all();
        $roles = Role::where('name', '!=', 'Super administrateur')->get();
        $domains = Domain::with('objets')->get();

        // Récupérer les utilisateurs paginés avec leurs rôles et domaines
        $users = User::with([
            'militaryDetail.rank',
            'userRoles.role',
            'userRoles.domain'
        ])->paginate(10); // Ajout de la pagination

        // Transformer les utilisateurs paginés
        $users->getCollection()->transform(function ($user) {
            $validRoles = $user->userRoles->filter(fn($r) => $r->role->name !== 'Super administrateur' || $r->domain_id !== null);

            // Si l'utilisateur n'a que "Super administrateur", on l'exclut
            if ($validRoles->isEmpty()) {
                return null;
            }

            // Remplacer les rôles de l'utilisateur par ceux filtrés
            $user->userRoles = $validRoles;
            return $user;
        });

        return view('admin.users.manage', compact('allUsers', 'users', 'roles', 'domains', 'search'));
    }

    /**
     * Afficher la liste des utilisateurs et leurs rôles pour rh
     */
    public function personnelManageUsers()
    {
        $domainName = 'rh';

        $superAdminRole = Role::where('name', 'Super administrateur')->first();
        if (!$superAdminRole) {
            return redirect()->back()->with('error', 'Rôle Super Administrateur introuvable.');
        }

        $users = User::whereDoesntHave('roles', function ($query) use ($superAdminRole) {
                $query->where('role_id', $superAdminRole->id);
            })
            ->with(['roles', 'militaryDetail.rank'])
            ->latest()
            ->paginate(20);

        $roles = Role::where('name', '!=', 'Super administrateur')->get();

        $domains = Domain::where('name', '=', $domainName)->with('objets')->get();

        return view('personnel.users.manage', compact('users', 'roles', 'domains'));
    }

    /**
     *  Afficher le resultat de recherche utilisateurs pour admin
     */
    public function manageUsersSearch(Request $request)
    {
        $search = trim(strip_tags($request->input('search')));
        $allUsers = User::all();
        $roles = Role::where('name', '!=', 'Super administrateur' )->get();
        $domains = Domain::with('objets')->get();

        $users = User::with([
            'militaryDetail.rank',
            'userRoles.role',
            'userRoles.domain'
        ])
        ->whereHas('userRoles.role', function ($query) {
            $query->where('name', '!=', 'Super administrateur'); // Exclure les super administrateurs
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                ->orWhere('users.firstname', 'like', "%{$search}%")
                ->orWhere('users.username', 'like', "%{$search}%")
                ->orWhereHas('militaryDetail.rank', fn($q) =>
                    $q->where('rank_abbreviate', 'like', "%{$search}%"))
                ->orWhereHas('userRoles.role', fn($q) =>
                    $q->where('name', 'like', "%{$search}%"))
                ->orWhereHas('userRoles.domain', fn($q) =>
                    $q->where('domain_description', 'like', "%{$search}%"));
            });
        })->paginate(10);

        $users->getCollection()->transform(function ($user) {
            $validRoles = $user->userRoles->filter(fn($r) => $r->role->name !== 'Super administrateur' || $r->domain_id !== null);

            if ($validRoles->isEmpty()) {
                return null;
            }

            $user->userRoles = $validRoles;
            return $user;
        })->filter();

        return view('admin.users.manage', compact('allUsers', 'users', 'roles', 'domains', 'search'));
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

        // Log de l'action
        $user = User::find($request->user_id);
        $domainId = Domain::where('name', 'admin')->value('id');
        LogHelper::logAction(
            auth()->id(),
            'Assign_role',
            "Attribution de rôle " . Role::where('id', $request->role_id)->value('name') . " à {$user->username}.",
            $domainId
        );

        return redirect()->back()->with('success', 'Rôle assigné avec succès.');
    }

    /**
     * Assigner un rôle à un utilisateur rh pour un domaine et un objet
     */
    public function personnelAssignRole(Request $request)
    {
        $domainName = 'rh';
        $domainId = Domain::where('name', $domainName)->value('id');

        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'role_id'   => 'required|exists:roles,id',
        ]);

        UserRole::updateOrCreate(
            [
                'user_id'   => $request->user_id,
                'domain_id' => $domainId,
            ],
            [
                'role_id' => $request->role_id,
            ]
        );

        // Log de l'action
        $user = User::find($request->user_id);

        LogHelper::logAction(
            auth()->id(),
            'Assign_role',
            "Attribution de rôle " . Role::where('id', $request->role_id)->value('name') . " à {$user->username}.",
            $domainId
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

        $userRole = UserRole::where('user_id', $request->user_id)
            ->where('domain_id', $request->domain_id)
            ->first();

        if ($userRole) {
            $userRole->delete();

            // Log de l'action
            $user = User::find($request->user_id);
            $domainId = Domain::where('name', 'admin')->value('id');
            LogHelper::logAction(
                auth()->id(),
                'Destroy_role',
                "Suppression du rôle " . Role::where('id', $userRole->role_id)->value('name') . " assigné à {$user->username}.",
                $domainId
            );

            return redirect()->back()->with('success', 'Rôle supprimé avec succès.');
        }

        return redirect()->back()->with('error', 'Rôle non supprimé.');
    }

     /**
     * Supprimer un rôle d'un utilisateur rh pour un domaine et un objet
     */
    public function personnelRemoveRole(Request $request)
    {
        $domainName ='rh';

        $request->validate([
            'user_id'   => 'required|exists:user_roles,user_id',
            'domain_id' => 'required|exists:domains,id',
        ]);

        $userRole = UserRole::where('user_id', $request->user_id)
            ->where('domain_id', $request->domain_id)
            ->first();

        if ($userRole) {
            $userRole->delete();

            // Log de l'action
            $user = User::find($request->user_id);
            $domainId = Domain::where('name', $domainName)->value('id');
            LogHelper::logAction(
                auth()->id(),
                'Destroy_role',
                "Suppression du rôle " . Role::where('id', $userRole->role_id)->value('name') . " assigné à {$user->username}.",
                $domainId
            );

            return redirect()->back()->with('success', 'Rôle supprimé avec succès.');
        }

        return redirect()->back()->with('error', 'Rôle non supprimé.');
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
