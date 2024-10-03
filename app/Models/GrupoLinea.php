<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoLinea extends Model
{
       // Definir la tabla asociada si el nombre de la tabla no sigue la convención de Laravel
       protected $table = 'grupo_linea';

       // Permitir la asignación masiva de estos campos
       protected $fillable = [
           'grupo_id',
           'linea_id'
       ];
   
       // Definir las relaciones con los modelos GrupoInvestigacion, LineaInvestigacion y Semillero
   
       // Relación con GrupoInvestigacion (un GrupoLinea pertenece a un Grupo)
       public function grupo()
       {
           return $this->belongsTo(GrupoInvestigacion::class, 'grupo_id');
       }
   
       // Relación con LineaInvestigacion (un GrupoLinea pertenece a una Línea de Investigación)
       public function linea()
       {
           return $this->belongsTo(LineaInvestigacion::class, 'linea_id');
       }
   
       // Relación con Semillero (opcional, si hay semillero asignado)
       public function semillero()
       {
           return $this->hasOne(Semillero::class, 'grupo_linea_id', 'id'); // Relación entre GrupoLinea y Semillero
       }
}
