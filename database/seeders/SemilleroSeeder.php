<?php

namespace Database\Seeders;

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
        $lineas = LineaInvestigacion::all();

        foreach ($lineas as $linea) {
            Semillero::create([
                'nombre' => 'Semillero ' . $linea->nombre,
                'linea_investigacion_id' => $linea->id,
            ]);
        }
    }
}
