<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Domain;
use App\Models\Profile;
use App\Models\PasswordInit;
use App\Models\Objet;
use App\Models\MilitaryDetail;
use App\Helpers\LogHelper;


class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs et leurs rôles
     */
    public function manageUsers($domainName = null)
    {
        if ($domainName) {
            $domain = Domain::where('name', $domainName)->first();
            if (!$domain) {
                return redirect()->back()->with('error', "Le domaine '$domainName' n'existe pas.");
            }
        }

        // Liste de tous les utilisateurs
        $allUsers = User::with(['profile', 'militaryDetail.rank'])
            ->leftJoin('military_details', 'users.profile_id', '=', 'military_details.profile_id')
            ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
            ->select([
                'users.*',
                'military_details.rank_id',
                'military_details.rank_date',
                'military_details.service_entry_date',
                'ranks.rank_abbreviate as grade'
            ])
            ->orderBy('military_details.rank_id')
            ->orderBy('military_details.rank_date')
            ->orderBy('military_details.service_entry_date')
            ->distinct()
            ->get();

        // Liste rôles et domaines
        $roles = Role::where('name', '!=', 'Super administrateur')->get();
        $domains = $domainName
        ? Domain::where('name', $domainName)
            ->where('name', '!=', 'admin')
            ->with('objets')
            ->get()
        : Domain::where('name', '!=', 'admin')
            ->with('objets')
            ->get();


        // Liste des utilisateurs avec rôles et domaines
        $usersQuery = User::with([
            'profile',
            'militaryDetail.rank',
            'userRoles.role',
            'userRoles.domain'
        ])
        ->whereHas('userRoles.role', function ($q) {
            $q->where('name', '!=', 'Super administrateur');
        });

        if ($domainName) {
            $usersQuery->whereHas('userRoles', function ($query) use ($domain) {
                $query->where('domain_id', $domain->id);
            });
        }

        if (auth()->user() && !auth()->user()->hasRole(['Administrateur', 'Super administrateur'])) {
            $unitId = auth()->user()->militaryDetail->unit_id ?? null;
            if ($unitId) {
                $usersQuery->where('military_details.unit_id', '=', $unitId);
            }
        }

        $users = $usersQuery
            ->leftJoin('military_details', 'users.profile_id', '=', 'military_details.profile_id')
            ->select([
                'users.*',
                'military_details.rank_id',
                'military_details.rank_date',
                'military_details.service_entry_date'
            ])
            ->distinct()
            ->orderBy('military_details.rank_id')
            ->orderBy('military_details.rank_date')
            ->orderBy('military_details.service_entry_date')
            ->paginate(20);

        return compact('allUsers', 'users', 'roles', 'domains');
    }

    /**
     * Afficher la liste des utilisateurs et leurs rôles pour admin
     */
    public function adminManageUsers()
    {
        $data = $this->manageUsers();
        $search = null;
        $isAdmin = true;
        return view('admin.users.manage', array_merge($data, compact('search' ,'isAdmin')));
    }

    /**
     * Afficher la liste des utilisateurs et leurs rôles pour RH
     */
    public function personnelManageUsers()
    {
        $data = $this->manageUsers('rh');
        $search = null;
        $isAdmin = false;
        return view('personnel.users.manage', array_merge($data, compact('search', 'isAdmin')));
    }



    /**
     *  Afficher le resultat de recherche utilisateurs
     */
    public function manageUsersSearch(Request $request)
    {
        $search = trim(strip_tags($request->input('search')));
        $allUsers = User::with(['profile', 'militaryDetail.rank'])
        ->leftJoin('military_details', 'users.profile_id', '=', 'military_details.profile_id')
        ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
        ->select([
            'users.*',
            'military_details.rank_id',
            'military_details.rank_date',
            'military_details.service_entry_date',
            'ranks.rank_abbreviate as grade'
        ])
        ->orderBy('military_details.rank_id')
        ->orderBy('military_details.rank_date')
        ->orderBy('military_details.service_entry_date')
        ->distinct()
        ->get();
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
        })->leftJoin('military_details', 'users.profile_id', '=', 'military_details.profile_id')
        ->select([
            'users.*',
            'military_details.rank_id',
            'military_details.rank_date',
            'military_details.service_entry_date'
        ])
        ->distinct()
        ->orderBy('military_details.rank_id')
        ->orderBy('military_details.rank_date')
        ->orderBy('military_details.service_entry_date')
        ->paginate(20);

        $users->getCollection()->transform(function ($user) {
            $validRoles = $user->userRoles->filter(fn($r) => $r->role->name !== 'Super administrateur' || $r->domain_id !== null);

            if ($validRoles->isEmpty()) {
                return null;
            }

            $user->userRoles = $validRoles;
            return $user;
        })->filter();

        return compact('allUsers', 'users', 'roles', 'domains', 'search');
    }

    /**
     * Afficher le resultat de recherche utilisateurs pour admin
     */
    public function adminManageUsersSearch(Request $request)
    {
        $data = $this->manageUsersSearch($request);
        return view('admin.users.manage', $data);
    }

    /**
     * Afficher le resultat de recherche utilisateurs pour rh
     */
    public function personnelManageUsersSearch(Request $request)
    {
        $data = $this->manageUsersSearch($request);
        return view('personnel.users.manage', $data);
    }

    /**
     * Assigner un rôle à un utilisateur pour un domaine et un objet
     */
    public function assignRole(Request $request, $domainName = null)
    {
        $user = User::find($request->user_id);

        if($domainName){
            $domainId = Domain::where('name', $domainName)->value('id');
            if (!$domainId) {
                return redirect()->back()->with('error', "Le domaine '$domainName' n'existe pas.");
            }
        }

        if($domainName){
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

            LogHelper::logAction(
                auth()->id(),
                'Assign_role',
                "Attribution de rôle " . Role::where('id', $request->role_id)->value('name') . " à {$user->username}.",
                $domainId
            );

        } else {
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

            $domainId = Domain::where('name', 'admin')->value('id');
            LogHelper::logAction(
                auth()->id(),
                'Assign_role',
                "Attribution de rôle " . Role::where('id', $request->role_id)->value('name') . " à {$user->username}.",
                $domainId
            );
        }
    }

    /**
     * Assigner un rôle utilisateur pour admin
     */
    public function adminAssignRole(Request $request)
    {
        $this->assignRole($request);
        return redirect()->back()->with('success', 'Rôle assigné avec succès.');
    }

    /**
     * Assigner un rôle utilisateur pour rh
     */
    public function personnelAssignRole(Request $request)
    {
        $this->assignRole($request, 'rh');
        return redirect()->back()->with('success', 'Rôle assigné avec succès.');
    }

    /**
     * Supprimer un rôle d'un utilisateur pour un domaine et un objet
     */
    public function removeRole(Request $request, $domainName = null)
{
    $user = User::find($request->user_id);
    if (!$user) {
        return redirect()->back()->with('error', "L'utilisateur n'existe pas.");
    }

    $domainId = $domainName
        ? Domain::where('name', $domainName)->value('id')
        : Domain::where('name', 'admin')->value('id');

    if ($domainName && !$domainId) {
        return redirect()->back()->with('error', "Le domaine '$domainName' n'existe pas.");
    }

    $request->validate([
        'user_id'   => 'required|exists:user_roles,user_id',
        'domain_id' => 'required|exists:domains,id',
    ]);

    $userRole = UserRole::where('user_id', $user->id)
        ->where('domain_id', $domainId)
        ->first();

    if (!$userRole) {
        return redirect()->back()->with('error', 'Rôle non supprimé.');
    }

    $roleName = optional(Role::find($userRole->role_id))->name;
    $userRole->delete();

    LogHelper::logAction(
        auth()->id(),
        'Destroy_role',
        "Suppression du rôle {$roleName} assigné à {$user->username}.",
        $domainId
    );

    return redirect()->back()->with('success', 'Rôle supprimé avec succès.');
}

    /**
     * Supprimer un rôle utilisateur pour admin
     */
    public function adminRemoveRole(Request $request)
    {
        $this->removeRole($request);
    }

    /**
     * Supprimer un rôle utilisateur pour rh
     */
    public function personnelRemoveRole(Request $request)
    {
        $this->removeRole($request, 'rh');
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

    /**
     * Afficher la liste des mots de passe initialisés des utilisateurs
     */
    public function userPasswordInitView()
    {
        $perPage = 20;

        $usersPassword = PasswordInit::with([
            'user.profile',
            'user.militaryDetail',
            'user.roles'
        ])
        ->leftJoin('users', 'password_init.user_id', '=', 'users.id')
        ->leftJoin('profiles', 'users.profile_id', '=', 'profiles.id')
        ->leftJoin('military_details', 'military_details.profile_id', '=', 'profiles.id')
        ->leftJoin('ranks', 'military_details.rank_id', '=', 'ranks.id')
        ->leftJoin('units', 'military_details.unit_id', '=', 'units.id')
        ->select([
            'password_init.*',
            'users.name as user_name',
            'users.firstname as user_firstname',
            'users.username as user_username',
            'profiles.birth_date as birth_date',
            'military_details.rank_id as rank_id',
            'military_details.rank_date as rank_date',
            'military_details.service_entry_date as service_entry_date',
            'ranks.rank_abbreviate as grade',
            'units.unit_abbreviate as unit_name'
        ]);
        /* ->distinct(); */ // pour éviter les doublons.

        if (auth()->check() && auth()->user()->hasRole('Collaborateur') && !auth()->user()->hasRole('Super administrateur')) {
            $unitId = auth()->user()->militaryDetail->unit_id ?? null;
            if ($unitId) {
                $usersPassword->where('military_details.unit_id', '=', $unitId);
            }
        }

        return $usersPassword->orderBy('rank_id')
            ->orderBy('rank_date')
            ->orderBy('service_entry_date')
            ->orderBy('birth_date')
            ->paginate($perPage);
    }

    /**
     * Afficher la liste des mots de passe initialisés des utilisateurs pour admin
     */
    public function adminUserPasswordInitView()
    {
        $usersPassword = $this->userPasswordInitView();
        return view('admin.users.password-init', compact('usersPassword'));
    }

    /**
     * Afficher la liste des mots de passe initialisés des utilisateurs pour rh
     */
    public function personnelUserPasswordInitView()
    {
        $usersPassword = $this->userPasswordInitView();
        return view('personnel.users.password-init', compact('usersPassword'));
    }

}
