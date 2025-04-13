<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleDomain extends Model
{
    use HasFactory;

    protected $table = 'role_domains';
    protected $fillable = ['role_id', 'domain_id', 'domain_description'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function rolePermissions(): HasMany
    {
        return $this->hasMany(RolePermission::class, 'domain_id', 'domain_id');
    }
}
