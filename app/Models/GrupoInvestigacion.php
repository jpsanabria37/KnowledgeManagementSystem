<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoInvestigacion extends Model
{
    use HasFactory;
    protected $table = 'grupos_investigacion';

    protected $fillable = ['nombre_grupo', 'lider_investigacion', 'centro_id'];

    // Relación con el centro
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    // Relación con la línea de investigación
    public function lineas()
    {
        return $this->belongsToMany(LineaInvestigacion::class, 'grupo_linea', 'grupo_id', 'linea_id')
        ->withPivot('id')            
        ->withTimestamps();
    }
    
    public function semilleros()
    {
        return $this->hasManyThrough(Semillero::class, GrupoLinea::class, 'grupo_id', 'grupo_linea_id', 'id', 'id');
    }
    
}
