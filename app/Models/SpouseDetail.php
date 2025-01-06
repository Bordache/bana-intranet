<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'spouse_name',
        'spouse_maiden_name',
        'spouse_firstname',
        'spouse_birth_date',
        'spouse_birth_place',
        'spouse_profession',
        'marriage_authorization',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
