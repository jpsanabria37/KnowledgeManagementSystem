<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anteproyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 
        'descripcion', 
        'objetivo_general', 
        'objetivos_especificos', 
        'justificacion', 
        'alcance', 
        'metodologia', 
        'cronograma', 
        'recursos_necesarios', 
        'archivo_pdf', 
        'archivo_poster', 
        'semillero_id', 
        'estado', 
        'fecha_inicio', 
        'fecha_fin', 
        'realizado_por', // Campo para quién realizó el anteproyecto
        'user_id', // Nuevo campo para el usuario creador
        'colaboradores', // Nuevo campo para colaboradores adicionales
    ];

    protected $casts = [
        'colaboradores' => 'array', // Para manejar el campo como JSON
    ];


      // Relación con el usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
  

    // Relación con el semillero
    public function semillero()
    {
        return $this->belongsTo(Semillero::class);
    }

    public function objetivosEspecificos()
{
    return $this->hasMany(ObjetivoEspecifico::class);
}

}
