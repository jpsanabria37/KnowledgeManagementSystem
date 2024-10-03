<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    use HasFactory;
    protected $table = 'semilleros';
    protected $fillable = ['nombre_semillero', 'lider_semillero', 'grupo_linea_id'];


    // Relación con grupos a través de la tabla intermedia
    public function grupos()
    {
        return $this->hasManyThrough(Grupo::class, 'grupo_linea', 'semillero_id', 'id', 'id', 'grupo_id');
    }


    public function grupoLinea()
    {
        return $this->belongsTo(GrupoLinea::class, 'grupo_linea_id'); // Usando grupo_linea_id como la FK
    }


    public function anteproyectos()
    {
        return $this->hasMany(Anteproyecto::class);
    }
}
