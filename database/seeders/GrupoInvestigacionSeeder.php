<?php

namespace Database\Seeders;

use App\Models\Centro;
use App\Models\GrupoInvestigacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $centros = Centro::all();

        foreach ($centros as $centro) {
            GrupoInvestigacion::create([
                'nombre_grupo' => 'Grupo de Investigación ' . $centro->nombre_centro,
                'centro_id' => $centro->id,
            ]);
        }
    }
}