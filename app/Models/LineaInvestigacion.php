<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaInvestigacion extends Model
{
    use HasFactory;
    protected $table = 'lineas_investigacion';
    protected $fillable = ['nombre_linea'];

   // Relación muchos a muchos con grupos a través de grupo_linea
   public function grupos()
   {
       return $this->belongsToMany(GrupoInvestigacion::class, 'grupo_linea', 'linea_id', 'grupo_id')
           ->withPivot('id')
           ->withTimestamps();
   }
   


    // Relación con los semilleros de investigación
    public function semilleros()
    {
        return $this->hasMany(Semillero::class, 'linea_id');
    }
}
