<?php

namespace Database\Seeders;

use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Datos de prueba para la tabla 'regionales'
        Regional::create([
            'nombre' => 'Regional Norte',
            'ubicacion' => 'Barranquilla'
        ]);

        Regional::create([
            'nombre' => 'Regional Centro',
            'ubicacion' => 'Bogotá'
        ]);

        Regional::create([
            'nombre' => 'Regional Sur',
            'ubicacion' => 'Leticia'
        ]);
    }
}
