<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryPath extends Model
{
    /** @use HasFactory<\Database\Factories\MilitaryPathFactory> */
    use HasFactory;


    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'military_paths';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'academy_name',
        'academy_duration',
        'academy_diploma',
    ];

    /**
     * Relation avec Profile.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
