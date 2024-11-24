<?php

namespace Database\Seeders;

use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Datos de prueba para la tabla 'regionales'
        $regionales = [
            ['nombre_regional' => 'San Andrés', 'descripcion_regional' => null, 'ubicacion_regional' => 'San Andrés'],
            ['nombre_regional' => 'Atlántico', 'descripcion_regional' => null, 'ubicacion_regional' => 'Atlántico'],
            ['nombre_regional' => 'Bolívar', 'descripcion_regional' => null, 'ubicacion_regional' => 'Bolívar'],
            ['nombre_regional' => 'Sucre', 'descripcion_regional' => null, 'ubicacion_regional' => 'Sucre'],
            ['nombre_regional' => 'Córdoba', 'descripcion_regional' => null, 'ubicacion_regional' => 'Córdoba'],
            ['nombre_regional' => 'Antioquia', 'descripcion_regional' => null, 'ubicacion_regional' => 'Antioquia'],
            ['nombre_regional' => 'Chocó', 'descripcion_regional' => null, 'ubicacion_regional' => 'Chocó'],
            ['nombre_regional' => 'Caldas', 'descripcion_regional' => null, 'ubicacion_regional' => 'Caldas'],
            ['nombre_regional' => 'Risaralda', 'descripcion_regional' => null, 'ubicacion_regional' => 'Risaralda'],
            ['nombre_regional' => 'Quindío', 'descripcion_regional' => null, 'ubicacion_regional' => 'Quindío'],
            ['nombre_regional' => 'Valle del Cauca', 'descripcion_regional' => null, 'ubicacion_regional' => 'Valle del Cauca'],
            ['nombre_regional' => 'Nariño', 'descripcion_regional' => null, 'ubicacion_regional' => 'Nariño'],
            ['nombre_regional' => 'Tolima', 'descripcion_regional' => null, 'ubicacion_regional' => 'Tolima'],
            ['nombre_regional' => 'Boyacá', 'descripcion_regional' => null, 'ubicacion_regional' => 'Boyacá'],
            ['nombre_regional' => 'Cundinamarca', 'descripcion_regional' => null, 'ubicacion_regional' => 'Cundinamarca'],
            ['nombre_regional' => 'Meta', 'descripcion_regional' => null, 'ubicacion_regional' => 'Meta'],
            ['nombre_regional' => 'Santander', 'descripcion_regional' => null, 'ubicacion_regional' => 'Santander'],
            ['nombre_regional' => 'Norte de Santander', 'descripcion_regional' => null, 'ubicacion_regional' => 'Norte de Santander'],
            ['nombre_regional' => 'Arauca', 'descripcion_regional' => null, 'ubicacion_regional' => 'Arauca'],
            ['nombre_regional' => 'Casanare', 'descripcion_regional' => null, 'ubicacion_regional' => 'Casanare'],
            ['nombre_regional' => 'Vaupés', 'descripcion_regional' => null, 'ubicacion_regional' => 'Vaupés'],
            ['nombre_regional' => 'Guaviare', 'descripcion_regional' => null, 'ubicacion_regional' => 'Guaviare'],
            ['nombre_regional' => 'Guainía', 'descripcion_regional' => null, 'ubicacion_regional' => 'Guainía'],
            ['nombre_regional' => 'Amazonas', 'descripcion_regional' => null, 'ubicacion_regional' => 'Amazonas'],
            ['nombre_regional' => 'Putumayo', 'descripcion_regional' => null, 'ubicacion_regional' => 'Putumayo'],
            ['nombre_regional' => 'Cauca', 'descripcion_regional' => null, 'ubicacion_regional' => 'Cauca'],
            ['nombre_regional' => 'Huila', 'descripcion_regional' => null, 'ubicacion_regional' => 'Huila'],
            ['nombre_regional' => 'Caquetá', 'descripcion_regional' => null, 'ubicacion_regional' => 'Caquetá'],
            ['nombre_regional' => 'Distrito Capital', 'descripcion_regional' => null, 'ubicacion_regional' => 'Bogotá D.C.'],
        ];

        DB::table('regionales')->insert($regionales);
    }
}
