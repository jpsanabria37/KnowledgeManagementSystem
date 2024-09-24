<?php

namespace Database\Seeders;

use App\Models\Centro;
use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CentroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Obtener regionales existentes
        $regionalNorte = Regional::where('nombre', 'Regional Norte')->first();
        $regionalCentro = Regional::where('nombre', 'Regional Centro')->first();
        $regionalSur = Regional::where('nombre', 'Regional Sur')->first();

        // Crear centros y asociarlos a regionales
        Centro::create([
            'nombre' => 'Centro Industrial y de Aviación',
            'regional_id' => $regionalNorte->id,
        ]);

        Centro::create([
            'nombre' => 'Centro de Tecnología y Manufactura',
            'regional_id' => $regionalCentro->id,
        ]);

        Centro::create([
            'nombre' => 'Centro de Desarrollo Amazónico',
            'regional_id' => $regionalSur->id,
        ]);
    }
}
