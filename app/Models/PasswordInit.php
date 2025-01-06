<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordInit extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'password_init';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'password',
    ];
}
