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

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
