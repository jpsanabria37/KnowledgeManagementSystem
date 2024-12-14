@extends('layouts.aprendiz')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <!-- Título Principal -->
        <h1 class="text-4xl font-extrabold text-blue-900 mb-6">{{ $anteproyecto->titulo }}</h1>
        <p class="text-gray-500 mb-8">Creado por: <strong>{{ $anteproyecto->creador->name }} - No. Ficha: {{ $anteproyecto->creador->ficha }} - {{ $anteproyecto->creador->programa }} </strong></p>

        <!-- Sección de Detalles del Anteproyecto -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Descripción -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Descripción</h2>
                <p class="text-gray-700 mt-2">{{ $anteproyecto->descripcion }}</p>
            </div>

            <!-- Justificación -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Justificación</h2>
                <p class="text-gray-700 mt-2">{{ $anteproyecto->justificacion }}</p>
            </div>

            <!-- Objetivo General -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Objetivo General</h2>
                <p class="text-gray-700 mt-2">{{ $anteproyecto->objetivo_general }}</p>
            </div>

            <!-- Objetivos Específicos -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Objetivos Específicos</h2>
                <ul class="list-disc pl-5 mt-2 text-gray-700">
                    @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
                        <li>{{ $objetivo->nombre }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Alcance (si existe) -->
            @if($anteproyecto->alcance)
                <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-blue-800">Alcance</h2>
                    <p class="text-gray-700 mt-2">{{ $anteproyecto->alcance }}</p>
                </div>
            @endif

            <!-- Metodología (si existe) -->
            @if($anteproyecto->metodologia)
                <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-blue-800">Metodología</h2>
                    <p class="text-gray-700 mt-2">{{ $anteproyecto->metodologia }}</p>
                </div>
            @endif

            <!-- Colaboradores (si existen) -->
            @if(!empty($anteproyecto->colaboradores))
                <div class="col-span-2 p-4 bg-blue-50 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-blue-800">Colaboradores</h2>
                    <ul class="list-disc pl-5 mt-2 text-gray-700">
                        @foreach($anteproyecto->colaboradores as $colaborador)
                            <li>{{ $colaborador }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow-lg space-y-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Productos y Actividades por Objetivo</h2>

    @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
        <div class="bg-white rounded-lg p-6 shadow-md border border-gray-200">
            <!-- Titulo del Objetivo -->
            <h3 class="text-2xl font-semibold text-indigo-600 mb-4">{{ $objetivo->nombre }}</h3>
            <p class="text-gray-700 mb-4 text-sm italic">Recursos Necesarios: <span class="font-medium">{{ $objetivo->recursos_necesarios }}</span></p>

            <!-- Productos del Objetivo -->
            @foreach ($objetivo->productos as $producto)
                <div class="bg-gray-100 p-4 rounded-lg mb-6 shadow-sm">
                    <!-- Titulo del Producto -->
                    <h4 class="text-xl font-semibold text-green-600 mb-3">{{ $producto->nombre }}</h4>
                    <p class="text-gray-600 mb-3">{{ $producto->descripcion }}</p>

                    <!-- Tabla de Actividades del Producto -->
                    <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Actividad</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Responsable</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Fecha Inicio</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Fecha Fin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($producto->actividades as $actividad)
                                <tr class="hover:bg-blue-50">
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->nombre }}</td>
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->responsable }}</td>
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->fecha_inicio }}</td>
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->fecha_fin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endforeach
</div>


        <!-- Sección de Relaciones (Semillero, Grupo de Investigación, Centro) -->
        <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Información Adicional</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Semillero -->
        @if($anteproyecto->semillero)
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Semillero</h3>
                <p class="text-gray-600">{{ $anteproyecto->semillero->nombre_semillero }}</p>
            </div>
        @endif

        <!-- Grupo de Investigación -->
        @if($anteproyecto->semillero && $anteproyecto->semillero->grupoLinea->grupo->nombre_grupo)
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Grupo de Investigación</h3>
                <p class="text-gray-600">{{ $anteproyecto->semillero->grupoLinea->grupo->nombre_grupo }}</p>
            </div>
        @endif

        <!-- Centro -->
        @if($anteproyecto->semillero && $anteproyecto->semillero->grupoLinea->grupo->centro)
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Centro</h3>
                <p class="text-gray-600">
                    {{ $anteproyecto->semillero->grupoLinea->grupo->centro->nombre_centro }} - 
                    {{ $anteproyecto->semillero->grupoLinea->grupo->centro->regional->nombre_regional }}
                </p>
            </div>
        @endif
    </div>

    <div class="mt-6">
        <h3 class="text-xl font-semibold text-gray-800">Archivos Adjuntos</h3>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Póster -->
            <div>
                <h4 class="text-lg font-semibold text-gray-700">Póster</h4>
                @if($anteproyecto->poster_path && file_exists(public_path($anteproyecto->poster_path)))
                    <a href="{{ asset($anteproyecto->poster_path) }}" target="_blank" 
                        class="text-blue-600 underline hover:text-blue-800">
                        Ver Póster
                    </a>
                @else
                    <p class="text-gray-600 italic">No se ha cargado un póster para este anteproyecto.</p>
                @endif
            </div>

            <!-- Video -->
            <div>
                <h4 class="text-lg font-semibold text-gray-700">Video</h4>
                @if($anteproyecto->video_path && file_exists(public_path($anteproyecto->video_path)))
                    <div class="flex flex-col space-y-2">
                        <video controls class="w-full max-h-64 rounded-md shadow-md">
                            <source src="{{ asset($anteproyecto->video_path) }}" type="video/mp4">
                            Tu navegador no soporta la reproducción de este video.
                        </video>
                        <a href="{{ asset($anteproyecto->video_path) }}" target="_blank" 
                           class="bg-blue-600 text-white px-4 py-2 text-sm rounded-md text-center hover:bg-blue-700">
                            Ver en Otra Pestaña
                        </a>
                    </div>
                @else
                    <p class="text-gray-600 italic">No se ha cargado un video para este anteproyecto.</p>
                @endif
            </div>
        </div>
</div>
</div>


        <!-- Botones de Acciones -->
        <div class="mt-6 flex gap-4">
            <a href="{{ route('aprendiz.anteproyectos.index') }}" class="inline-block bg-blue-700 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-800">
                Volver a Mis Anteproyectos
            </a>
            <a href="{{ route('aprendiz.anteproyectos.generarPdf', $anteproyecto->id) }}" class="inline-block bg-red-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-600">
                Generar PDF
            </a>
        </div>
    </div>
@endsection
