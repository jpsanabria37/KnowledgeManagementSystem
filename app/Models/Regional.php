<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    use HasFactory;

    protected $table = 'regionales';
    protected $primaryKey = 'id'; // Asegúrate de que esta clave coincida con tu base de datos


    // Definir los campos que se pueden asignar masivamente
    protected $fillable = ['nombre_regional', 'descripcion_regional', 'ubicacion_regional'];

    // Relación con los centros
    public function centros()
    {
        return $this->hasMany(Centro::class);
    }
}
