<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function permissions()
{
    return $this->belongsToMany(Permission::class, 'role_permissions')
                ->withPivot(['domain_id', 'object_id', 'created_at', 'updated_at']);
}

}
