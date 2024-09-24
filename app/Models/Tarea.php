<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_tarea', 'proyecto_id', 'estado'];

    // Relación con el proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
