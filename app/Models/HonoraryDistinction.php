<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonoraryDistinction extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'honorary_distinctions';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'honorary_title',
        'honorary_promotion',
        'honorary_reference',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

