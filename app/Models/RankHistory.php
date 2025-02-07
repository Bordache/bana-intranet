<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankHistory extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'rank_histories';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'history_rank',
        'history_promotion_date',
        'history_rank_reference',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */

    protected $casts = [
        'history_promotion_date' => 'date',
    ];

    // Déclenche l'update du profile lors d'une mise à jour
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($rankHistories) {
            $rankHistories->profile->touch();
        });
        static::created(function ($rankHistories) {
            $rankHistories->profile->touch();
        });
    }


    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
