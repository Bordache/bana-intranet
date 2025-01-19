<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class MilitaryDetail extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'military_details';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'army',
        'position',
        'position_date',
        'position_reference',
        'military_registration_number',
        'military_id_card_number',
        'finance_registration_number',
        'recruitment_origin',
        'recruitment_promotion',
        'service_entry_date',
        'corps_assignment',
        'unit_id',
        'rank_id',
        'rank_date',
        'current_function',
        'specialty',
        'exact_assignment',
        'interruption_start_date',
        'interruption_end_date',
        'military_status',
        'military_status_reference',
        'military_driver_license',
        'other_information',
    ];

    /**
     * Les attributs à caster dans d'autres types.
     *
     * @var array
     */

     protected $casts = [
        'position_date' => 'date',
        'service_entry_date' => 'date',
        'rank_date' => 'date',
        'interruption_start_date' => 'date',
        'interruption_end_date' => 'date',
    ];

    /**
     * Relation : Un profil a un utilisateur associé.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id', 'id'); // 'rank_id' est la clé étrangère dans military_details
    }

}

