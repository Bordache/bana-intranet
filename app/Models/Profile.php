<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Profile extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * Champs remplissables (Mass Assignment).
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'firstname',
        'birth_date',
        'birth_place',
        'gender',
        'national_id',
        'issue_date',
        'issue_place',
        'duplicate_date',
        'duplicate_place',
        'address',
        'phone',
        'email',
        'blood_group',
        'size',
        'father_name',
        'mother_name',
        'marital_status',
        'fallback_address',
    ];

    /**
     * Les attributs à caster dans d'autres types.
     *
     * @var array
     */


    /**
     * Relation : Un profil a un utilisateur associé.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'profile_id');
    }

    public function professionalCareers()
    {
        return $this->hasMany(ProfessionalCareer::class, 'profile_id');
    }

    public function academicPaths()
    {
        return $this->hasMany(AcademicPath::class, 'profile_id');
    }

    public function militaryDetail()
    {
        return $this->hasOne(MilitaryDetail::class, 'profile_id');
    }

    public function rankHistories()
    {
        return $this->hasMany(RankHistory::class, 'profile_id');
    }

    public function militaryCampaigns()
    {
        return $this->hasMany(MilitaryCampaign::class, 'profile_id');
    }

    public function childrenDetails()
    {
        return $this->hasMany(ChildrenDetail::class, 'profile_id');
    }

    public function honoraryDistinctions()
    {
        return $this->hasMany(HonoraryDistinction::class, 'profile_id');
    }

    public function spouseDetail()
    {
        return $this->hasOne(SpouseDetail::class, 'profile_id');
    }
}
