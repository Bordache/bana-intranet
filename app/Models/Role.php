<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions')
                    ->withPivot(['domain_id', 'object_id', 'created_at', 'updated_at']);
    }

    public function domains(): BelongsToMany
    {
        return $this->belongsToMany(Domain::class, 'role_domains')
                    ->withPivot('domain_description')
                    ->withTimestamps();
    }

    public function rolePermissions(): HasMany
    {
        return $this->hasMany(RolePermission::class, 'role_id');
    }

    /**
     * Vérifie si le rôle a une permission donnée sur un objet spécifique (optionnel).
     */
    /* public function hasPermissionTo(string $permissionName, ?int $objectId = null): bool
    {
        return $this->permissions()
            ->where('name', $permissionName)
            ->when($objectId, function ($query) use ($objectId) {
                $query->where('object_id', $objectId);
            })
            ->exists();
    } */

    public function hasPermissionTo($permissionId, $objectId)
    {
        return $this->permissions()
            ->where('permission_id', $permissionId)
            ->where('object_id', $objectId)
            ->exists();
    }

}
