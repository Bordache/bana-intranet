<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;
    protected $table = 'domains';
    protected $fillable = ['name'];

    public function objets()
    {
        return $this->hasMany(Objet::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_domains')
                    ->withPivot('domain_description')
                    ->withTimestamps();
    }

    public function roleDomains()
    {
        return $this->hasMany(RoleDomain::class, 'domain_id', 'id');
    }

}
