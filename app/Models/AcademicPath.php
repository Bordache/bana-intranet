<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicPath extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'academic_paths';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'school_name',
        'duration',
        'diploma',
    ];

    // Déclenche l'update du profile lorsque military_details est mis à jour
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($academicPaths) {
            $academicPaths->profile->touch();
        });
        static::created(function ($academicPaths) {
            $academicPaths->profile->touch();
        });
    }


    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
