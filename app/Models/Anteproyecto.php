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
        'tags',
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
        'paso_actual',
        'estado_creacion'
    ];

    protected $casts = [
        'colaboradores' => 'array', // Para manejar el campo como JSON
    ];


    public function scopeBuscar($query, $term)
    {
        // Si el término es corto, priorizamos búsquedas simples (por LIKE)
        if (strlen($term) < 3) {
            return $query->where('titulo', 'LIKE', "%$term%")
                ->orWhere('tags', 'LIKE', "%$term%")
                ->orWhere('descripcion', 'LIKE', "%$term%");
        }

        // Si es más largo, usamos búsquedas más potentes (por FULLTEXT, si aplica)
        return $query->whereRaw("MATCH(titulo, descripcion, tags, objetivo_general) AGAINST(? IN BOOLEAN MODE)", [$term]);
    }

    public function scopeBuscar2($query, $term)
    {
        $query->where('titulo', 'LIKE', "%$term%")
            ->orWhere('tags', 'LIKE', "%$term%")
            ->orWhere('descripcion', 'LIKE', "%$term%")
            ->orWhere('objetivo_general', 'LIKE', "%$term%")
            // Búsqueda en objetivos específicos
            ->orWhereHas('objetivosEspecificos', function ($q) use ($term) {
                $q->where('descripcion', 'LIKE', "%$term%");
            })
            // Búsqueda en productos
            ->orWhereHas('objetivosEspecificos.productos', function ($q) use ($term) {
                $q->where('nombre', 'LIKE', "%$term%")
                    ->orWhere('descripcion', 'LIKE', "%$term%");
            })
            // Búsqueda en actividades
            ->orWhereHas('objetivosEspecificos.productos.actividades', function ($q) use ($term) {
                $q->where('nombre', 'LIKE', "%$term%")
                    ->orWhere('responsable', 'LIKE', "%$term%");
            });

        return $query;
    }


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
