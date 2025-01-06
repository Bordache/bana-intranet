<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenDetail extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'children_details';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'child_full_name',
        'child_birth_date',
        'child_birth_place',
        'child_gender',
        'child_status'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

