<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_centro', 'regional_id'];

    // Relación con la regional
    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    // Relación con los grupos de investigación
    public function grupos()
    {
        return $this->hasMany(GrupoInvestigacion::class);
    }

    // Relación con las líneas de investigación
    public function lineas()
    {
        return $this->hasMany(LineaInvestigacion::class);
    }
}
