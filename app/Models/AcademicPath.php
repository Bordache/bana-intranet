<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'school_name',
        'duration',
        'diploma',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
