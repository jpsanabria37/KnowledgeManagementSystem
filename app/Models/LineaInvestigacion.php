<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaInvestigacion extends Model
{
    use HasFactory;
    protected $table = 'lineas_investigacion';
    protected $fillable = ['nombre_linea', 'id_centro'];

    // Relación con el centro
    public function centro()
    {
        return $this->belongsTo(Centro::class, 'id_centro');
    }


    // Relación con los semilleros de investigación
    public function semilleros()
    {
        return $this->hasMany(Semillero::class);
    }
}
