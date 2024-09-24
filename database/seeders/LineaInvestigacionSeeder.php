<?php

namespace Database\Seeders;

use App\Models\GrupoInvestigacion;
use App\Models\LineaInvestigacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineaInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $grupos = GrupoInvestigacion::all();

        foreach ($grupos as $grupo) {
            LineaInvestigacion::create([
                'nombre' => 'Línea de Investigación ' . $grupo->nombre,
                'grupo_investigacion_id' => $grupo->id,
            ]);
        }
    }
}
