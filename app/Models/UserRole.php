<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'role_id', 'domain_id', 'object_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function object()
    {
        return $this->belongsTo(Object::class);
    }

    public static function hasRole($userId, $roleName, $domainId = null)
    {
        // Check if the user is a Super Administrator
        $isSuperAdmin = self::where('user_id', $userId)
            ->whereHas('role', fn($query) => $query->where('name', 'Super administrateur'))
            ->exists();

        if ($isSuperAdmin) {
            return true;
        }

        $hasRole = $domainId
            ? self::where('user_id', $userId)
                ->where('domain_id', $domainId)
                ->whereHas('role', fn($query) => $query->where('name', $roleName))
                ->exists()
            : self::where('user_id', $userId)
                ->whereHas('role', fn($query) => $query->where('name', $roleName))
                ->exists();

        return $hasRole;
    }

    public static function isSuperAdmin($userId)
    {
        return self::where('user_id', $userId)
            ->whereHas('role', fn($query) => $query->where('name', 'Super administrateur'))
            ->exists();
    }
}
