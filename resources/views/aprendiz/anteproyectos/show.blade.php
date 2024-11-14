@extends('layouts.aprendiz')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow-lg">
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
                <p class="text-gray-700 mt-2">{{ $anteproyecto->objetivos_especificos }}</p>
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
                    <ul class="list-disc pl-5 text-gray-700 mt-2">
                        @foreach($anteproyecto->colaboradores as $colaborador)
                            <li>{{ $colaborador }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

        <!-- Archivos Adjuntos -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">Archivos Adjuntos</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Archivo PDF -->
                @if($anteproyecto->archivo_pdf)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Archivo PDF</h3>
                        <a href="{{ asset('storage/' . $anteproyecto->archivo_pdf) }}" target="_blank" class="text-blue-500 hover:underline">
                            Descargar PDF
                        </a>
                    </div>
                @endif

                <!-- Archivo Póster -->
                @if($anteproyecto->archivo_poster)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Póster</h3>
                        <a href="{{ asset('storage/' . $anteproyecto->archivo_poster) }}" target="_blank" class="text-blue-500 hover:underline">
                            Descargar Póster
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Botón de Volver -->
        <div class="mt-6">
            <a href="{{ route('aprendiz.anteproyectos.index') }}" class="inline-block bg-blue-700 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-800">
                Volver a Mis Anteproyectos
            </a>
        </div>
    </div>
@endsection
