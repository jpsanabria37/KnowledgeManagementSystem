<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoInvestigacion extends Model
{
    use HasFactory;
    protected $table = 'grupos_investigacion';

    protected $fillable = ['nombre_grupo', 'lider_investigacion', 'centro_id', 'linea_id'];

    // Relación con el centro
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    // Relación con la línea de investigación
    public function linea()
    {
        return $this->belongsTo(LineaInvestigacion::class);
    }
}
