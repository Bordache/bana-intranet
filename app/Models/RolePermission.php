<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'role_permissions';
    protected $fillable = ['role_id', 'permission_id', 'domain_id', 'object_id', 'created_at', 'updated_at'];


    public function objet()
    {
        return $this->belongsTo(Objet::class, 'object_id');
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }


}
