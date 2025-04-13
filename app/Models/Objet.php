<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;

     /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'objects';
    protected $fillable = ['name', 'domain_id'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
