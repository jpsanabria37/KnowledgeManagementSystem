<?php

namespace Database\Seeders;

use App\Models\Centro;
use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centros = [
            // San Andrés
            ['nombre_centro' => 'Centro de Formación Turística, Gente de Mar y de Servicios', 'regional_id' => 1],

            // Atlántico
            ['nombre_centro' => 'Centro para el Desarrollo Agroecológico y Agroindustrial', 'regional_id' => 2],
            ['nombre_centro' => 'Centro Nacional Colombo Alemán', 'regional_id' => 2],
            ['nombre_centro' => 'Centro de Comercio y Servicios', 'regional_id' => 2],

            // Bolívar
            ['nombre_centro' => 'Centro Agroindustrial y Minero', 'regional_id' => 3],

            // Sucre
            ['nombre_centro' => 'Centro Tecnológico de la Innovación', 'regional_id' => 4],

            // Córdoba
            ['nombre_centro' => 'Centro de Comercio, Industria y Turismo de Córdoba', 'regional_id' => 5],

            // Antioquia
            ['nombre_centro' => 'Centro Tecnológico del Mobiliario', 'regional_id' => 6],
            ['nombre_centro' => 'Centro Tecnológico del Diseño y la Innovación', 'regional_id' => 6],
            ['nombre_centro' => 'Centro para el Desarrollo Agroindustrial y Empresarial', 'regional_id' => 6],
            ['nombre_centro' => 'Centro de Manufactura Avanzada', 'regional_id' => 6],

            // Chocó
            ['nombre_centro' => 'Centro de Tecnologías de la Información y Comunicación', 'regional_id' => 7],
            ['nombre_centro' => 'Centro Agroindustrial del Pacífico', 'regional_id' => 7],

            // Caldas
            ['nombre_centro' => 'Centro de Procesos Industriales y Construcción', 'regional_id' => 8],

            // Risaralda
            ['nombre_centro' => 'Centro de Diseño e Innovación Tecnológica Industrial', 'regional_id' => 9],

            // Quindío
            ['nombre_centro' => 'Centro Pecuario y Agroempresarial', 'regional_id' => 10],

            // Valle del Cauca
            ['nombre_centro' => 'Centro de Biotecnología Industrial', 'regional_id' => 11],
            ['nombre_centro' => 'Centro Agroindustrial del Valle del Cauca', 'regional_id' => 11],
            ['nombre_centro' => 'Centro de Electricidad y Automatización Industrial', 'regional_id' => 11],

            // Nariño
            ['nombre_centro' => 'Centro de la Industria y Construcción', 'regional_id' => 12],
            ['nombre_centro' => 'Centro Internacional de Producción Limpia Lope', 'regional_id' => 12],

            // Tolima
            ['nombre_centro' => 'Centro de Comercio y Servicios del Tolima', 'regional_id' => 13],
            ['nombre_centro' => 'Centro Agropecuario La Granja', 'regional_id' => 13],

            // Boyacá
            ['nombre_centro' => 'Centro Minero', 'regional_id' => 14],
            ['nombre_centro' => 'Centro de Desarrollo Agropecuario y Agroindustrial', 'regional_id' => 14],

            // Cundinamarca
            ['nombre_centro' => 'Centro de la Innovación y Tecnología del Transporte', 'regional_id' => 15],
            ['nombre_centro' => 'Centro de Biotecnología Agropecuaria', 'regional_id' => 15],

            // Meta
            ['nombre_centro' => 'Centro de Industria y Servicios del Meta', 'regional_id' => 16],
            ['nombre_centro' => 'Centro Agroindustrial del Meta', 'regional_id' => 16],

            // Santander
            ['nombre_centro' => 'Centro Industrial de Mantenimiento Integral', 'regional_id' => 17],
            ['nombre_centro' => 'Centro Agroempresarial y Turístico de los Andes', 'regional_id' => 17],

            // Norte de Santander
            ['nombre_centro' => 'Centro de Formación para el Desarrollo Rural y Minero', 'regional_id' => 18],

            // Arauca
            ['nombre_centro' => 'Centro Agroindustrial y Ganadero de Arauca', 'regional_id' => 19],

            // Casanare
            ['nombre_centro' => 'Centro Agroindustrial y de Fortalecimiento Empresarial', 'regional_id' => 20],

            // Vaupés
            ['nombre_centro' => 'Centro de Formación Integral Amazónico', 'regional_id' => 21],

            // Guaviare
            ['nombre_centro' => 'Centro Agropecuario de la Orinoquía', 'regional_id' => 22],

            // Guainía
            ['nombre_centro' => 'Centro de Servicios y Gestión Empresarial', 'regional_id' => 23],

            // Amazonas
            ['nombre_centro' => 'Centro para la Biodiversidad y el Turismo del Amazonas', 'regional_id' => 24],

            // Putumayo
            ['nombre_centro' => 'Centro Agroforestal y Acuícola Arapaima', 'regional_id' => 25],

            // Cauca
            ['nombre_centro' => 'Centro Agropecuario de El Tambo', 'regional_id' => 26],
            ['nombre_centro' => 'Centro de Teleinformática y Producción Industrial', 'regional_id' => 26],

            // Huila
            ['nombre_centro' => 'Centro Agroempresarial y Desarrollo Pecuario del Huila', 'regional_id' => 27],

            // Caquetá
            ['nombre_centro' => 'Centro Tecnológico de la Amazonia', 'regional_id' => 28],

            // Distrito Capital (Bogotá)
            ['nombre_centro' => 'Centro de Formación en Actividad Física y Deporte', 'regional_id' => 29],
            ['nombre_centro' => 'Centro de Electricidad, Electrónica y Telecomunicaciones', 'regional_id' => 29],
            ['nombre_centro' => 'Centro de Diseño y Metrología', 'regional_id' => 29],
            ['nombre_centro' => 'Centro de Gestión de Mercados, Logística y Tecnologías de la Información', 'regional_id' => 29],
        ];

        DB::table('centros')->insert($centros);
    }
}
