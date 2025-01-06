<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryCampaign extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'title', 'campaign_period', 'campaign_locations'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

