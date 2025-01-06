<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonoraryDistinction extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'title', 'promotion', 'reference'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

