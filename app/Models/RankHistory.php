<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankHistory extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'history_rank', 'history_promotion_date', 'history_rank_reference'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
