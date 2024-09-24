<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    use HasFactory;
    protected $table = 'semilleros';
    protected $fillable = ['nombre_semillero', 'lider_semillero', 'linea_id'];

    // Relación con la línea de investigación
    public function linea()
    {
        return $this->belongsTo(LineaInvestigacion::class);
    }

    // Relación con los proyectos
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    // Relación con los miembros (Instructores y Aprendices)
    public function miembros()
    {
        return $this->hasMany(Miembro::class);
    }
}
