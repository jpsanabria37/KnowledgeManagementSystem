<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoEspecifico extends Model
{
    use HasFactory;

      // Nombre de la tabla en la base de datos
      protected $table = 'objetivos_especificos';
    protected $fillable = [
        'anteproyecto_id',
        'nombre',
        'recursos_necesarios', // Añadir este campo
    ];

    public function anteproyecto()
{
    return $this->belongsTo(Anteproyecto::class);
}

public function actividades()
{
    return $this->hasMany(Actividad::class);
}

public function productos()
{
    return $this->hasMany(Producto::class);
}

}
