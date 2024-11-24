<?php

namespace Database\Seeders;

use App\Models\GrupoInvestigacion;
use App\Models\LineaInvestigacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineaInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lineas = [
            ['nombre_linea' => 'Electrónica Automatización y Control'],
            ['nombre_linea' => 'Teleinformática'],
            ['nombre_linea' => 'Electricidad'],
            ['nombre_linea' => 'Telecomunicaciones'],
        ];

        DB::table('lineas_investigacion')->insert($lineas);

    }
}
