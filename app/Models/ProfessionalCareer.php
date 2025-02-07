<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalCareer extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'professional_careers';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */

    protected $fillable = [
        'profile_id',
        'company_name',
        'job_title',
        'start_date',
        'end_date',
        'description',
    ];

    // Déclenche l'update du profile lors d'une mise à jour
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($professionalCareers) {
            $professionalCareers->profile->touch();
        });
        static::created(function ($professionalCareers) {
            $professionalCareers->profile->touch();
        });
    }

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
