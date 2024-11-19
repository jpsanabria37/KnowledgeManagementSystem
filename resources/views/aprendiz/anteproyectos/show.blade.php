@extends('layouts.aprendiz')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <!-- Título Principal -->
        <h1 class="text-4xl font-extrabold text-blue-900 mb-6">{{ $anteproyecto->titulo }}</h1>
        <p class="text-gray-500 mb-8">Creado por: <strong>{{ $anteproyecto->realizado_por }}</strong></p>

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

        <!-- Actividades por Objetivo -->
        <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Actividades por Objetivo</h2>
            @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-blue-800">{{ $objetivo->nombre }}</h3>
                    <p class="text-gray-700 mb-2">Recursos Necesarios: <strong>{{ $objetivo->recursos_necesarios }}</strong></p>
                    <table class="w-full border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Actividad</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Responsable</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Fecha Inicio</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Fecha Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($objetivo->actividades as $actividad)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $actividad->nombre }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $actividad->responsable }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $actividad->fecha_inicio }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $actividad->fecha_fin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                @if($anteproyecto->semillero && $anteproyecto->semillero->grupoInvestigacion)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Grupo de Investigación</h3>
                        <p class="text-gray-600">{{ $anteproyecto->semillero->grupoInvestigacion->nombre_grupo }}</p>
                    </div>
                @endif

                <!-- Centro -->
                @if($anteproyecto->semillero && $anteproyecto->semillero->grupoInvestigacion && $anteproyecto->semillero->grupoInvestigacion->centro)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Centro</h3>
                        <p class="text-gray-600">{{ $anteproyecto->semillero->grupoInvestigacion->centro->nombre_centro }}</p>
                    </div>
                @endif
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
