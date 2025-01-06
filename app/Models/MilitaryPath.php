<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryPath extends Model
{
    /** @use HasFactory<\Database\Factories\MilitaryPathFactory> */
    use HasFactory;

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
        return $this->belongsTo(Profile::class);
    }
}
