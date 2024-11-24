<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['objetivo_especifico_id', 'nombre', 'descripcion'];

    public function objetivoEspecifico()
    {
        return $this->belongsTo(ObjetivoEspecifico::class);
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}
