<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_miembro', 'rol', 'semillero_id'];

    // Relación con el semillero
    public function semillero()
    {
        return $this->belongsTo(Semillero::class);
    }
}
