<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryCampaign extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'military_campaigns';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'campaign_title',
        'campaign_period',
        'campaign_locations',
    ];

    // Déclenche l'update du profile lors d'une mise à jour
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($militaryCampaigns) {
            $militaryCampaigns->profile->touch();
        });
        static::created(function ($militaryCampaigns) {
            $militaryCampaigns->profile->touch();
        });
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}

