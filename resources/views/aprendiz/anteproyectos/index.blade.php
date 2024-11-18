@extends('layouts.aprendiz')

@section('content')
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
                        <p class="text-gray-700 font-semibold">Estado de Creación: 
                            <span class="{{ $anteproyecto->estado_creacion === 'completo' ? 'text-green-500' : 'text-red-500' }}">
                                {{ ucfirst($anteproyecto->estado_creacion) }}
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

                    <!-- Botón para enviar en el Paso 4 -->
                    @if ($anteproyecto->paso_actual == 4 && $anteproyecto->estado_creacion === 'incompleto')
                        <form action="{{ route('aprendiz.anteproyectos.enviar', $anteproyecto->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded w-full">
                                Enviar Anteproyecto
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
