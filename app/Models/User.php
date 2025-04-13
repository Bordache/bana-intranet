<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'profile_id',
        'name',
        'firstname',
        'email',
        'username',
        'password',
        'password_changed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Vérifie si l'utilisateur a une permission dans un domaine et un objet spécifique
     */

     public function hasPermission($permission, $domain, $objet = null): bool
     {
         // Si l'utilisateur est super admin, il a tous les droits
         if ($this->isSuperAdmin()) {
             return true;
         }

         return UserRole::where('user_id', $this->id)
             ->whereHas('role.rolePermissions', function ($query) use ($permission, $domain, $objet) {
                 $query->whereHas('permission', fn($q) => $q->where('name', $permission))
                       ->whereHas('domain', fn($q) => $q->where('name', $domain));

                 if ($objet) {
                     $query->whereHas('objet', fn($q) => $q->where('name', $objet));
                 }
             })
             ->exists();
     }


    /**
     * Vérifie si l'utilisateur a un rôle spécifique dans un domaine et un objet
     */
    public function hasRole($roleName, $domainId = null)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $userRole = $domainId
            ? UserRole::where('user_id', $this->id)
                ->where('domain_id', $domainId)
                ->whereHas('role', fn($query) => $query->where('name', $roleName))
                ->exists()
            : UserRole::where('user_id', $this->id)
                ->whereHas('role', fn($query) => $query->where('name', $roleName))
                ->exists();

        return $userRole;
    }

    /**
     * Vérifie si l'utilisateur appartient à un domaine spécifique
     */
    public function hasRoleInDomain($domainName)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        return $this->userRoles()->whereHas('domain', fn($q) => $q->where('name', $domainName))->exists();
    }


    /**
     * Vérifie si l'utilisateur est un Super Administrateur
     */
    public function isSuperAdmin()
    {
        return UserRole::where('user_id', $this->id)
            ->whereHas('role', fn($query) => $query->where('name', 'Super administrateur'))
            ->exists();
    }

    /**
     * Relation avec le profil utilisateur
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    /**
     * Relation avec les rôles via user_roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')
                    ->withPivot('domain_id', 'object_id')
                    ->withTimestamps();
    }

    public function militaryDetail()
    {
        return $this->hasOne(MilitaryDetail::class, 'profile_id', 'profile_id');
    }


    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function domains()
    {
        return $this->hasManyThrough(Domain::class, UserRole::class, 'user_id', 'id', 'id', 'domain_id');
    }

    public function passwordInit()
    {
        return $this->hasOne(PasswordInit::class, 'user_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }

}
