@extends('layouts.aprendiz')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Bienvenido, {{ auth()->user()->name }}</h1>
    <p class="text-gray-600 mb-6">Esta es tu área de trabajo en la plataforma del SENA.</p>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Mis Anteproyectos</h2>

        <a href="{{ route('aprendiz.anteproyectos.createStep1') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-4 inline-block">Crear Nuevo Anteproyecto</a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            @foreach ($anteproyectos as $anteproyecto)
                <div class="p-4 bg-gray-50 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-lg font-semibold text-green-700">{{ $anteproyecto->titulo }}</h3>
                    <p class="text-gray-600 mb-2">{{ $anteproyecto->descripcion }}</p>

                    <!-- Estado y progreso del anteproyecto -->
                    <div class="mb-2">
                        <p class="text-gray-700 font-semibold">Estado: 
                            <span class="{{ $anteproyecto->estado === 'completo' ? 'text-green-500' : 'text-red-500' }}">
                                {{ ucfirst($anteproyecto->estado) }}
                            </span>
                        </p>
                        <p>Progreso: Paso {{ $anteproyecto->paso_actual }} de 4</p>

                        <!-- Barra de progreso -->
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($anteproyecto->paso_actual / 4) * 100 }}%"></div>
                        </div>
                    </div>

                    <!-- Botón para continuar o ver detalles -->
                    @if ($anteproyecto->estado_creacion === 'incompleto')
                        <a href="{{ route('aprendiz.anteproyectos.createStep' . $anteproyecto->paso_actual, $anteproyecto->id) }}" class="text-blue-500 hover:underline">Continuar</a>
                    @elseif ($anteproyecto->estado_creacion === 'completo')
                        <a href="{{ route('aprendiz.anteproyectos.show', $anteproyecto->id) }}" class="text-blue-500 hover:underline">Ver detalles</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
