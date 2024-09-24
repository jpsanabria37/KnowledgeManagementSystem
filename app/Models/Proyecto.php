<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_proyecto', 'semillero_id', 'linea_id', 'tipo_contrato'];

    // Relación con el semillero
    public function semillero()
    {
        return $this->belongsTo(Semillero::class);
    }

    // Relación con las tareas del proyecto
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
