<?php

namespace Database\Seeders;

use App\Models\GrupoInvestigacion;
use App\Models\GrupoLinea;
use App\Models\LineaInvestigacion;
use App\Models\Semillero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemilleroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $grupos = GrupoInvestigacion::all();
        $linea = LineaInvestigacion::first();

        foreach ($grupos as $grupo) {
            $grupoLinea = GrupoLinea::create([
                'grupo_id' => $grupo->id,
                'linea_id' => $linea->id,
            ]);

            Semillero::create([
                'nombre_semillero' => 'Semillero ' . $grupo->nombre_grupo,
                'grupo_linea_id' => $grupoLinea->id,
            ]);
        }
    }
}