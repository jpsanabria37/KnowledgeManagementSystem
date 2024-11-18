<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $table = 'actividades';

    protected $fillable = [
        'nombre',
        'responsable',
        'fecha_inicio',
        'fecha_fin',
        'objetivo_especifico_id',
    ];
    public function objetivoEspecifico()
    {
        return $this->belongsTo(ObjetivoEspecifico::class);
    }

}
