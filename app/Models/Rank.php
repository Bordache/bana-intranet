<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rank extends Model
{
    use HasFactory;

    protected $table = 'ranks';

    protected $fillable = [
        'rank_name',
        'rank_abbreviate'
    ];

   public function militaryDetails()
    {
        return $this->hasMany(MilitaryDetail::class, 'rank_id', 'id');
    }

}
