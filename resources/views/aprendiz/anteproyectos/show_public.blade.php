@extends('layouts.aprendiz')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{ $anteproyecto->titulo }}</h1>
        
        <p class="text-gray-600 mb-2"><strong>Descripción:</strong> {{ $anteproyecto->descripcion }}</p>
        <p class="text-gray-600 mb-2"><strong>Justificación:</strong> {{ $anteproyecto->justificacion }}</p>
        <p class="text-gray-600 mb-2"><strong>Creado por:</strong> {{ $anteproyecto->creador->name ?? 'Desconocido' }}</p>
        
        <!-- Mostrar colaboradores -->
        <h2 class="text-lg font-semibold mt-4">Colaboradores:</h2>
        @if (!empty($anteproyecto->colaboradores))
            <ul class="list-disc pl-6 mb-4">
                @foreach ($anteproyecto->colaboradores as $colaborador)
                    <li>{{ $colaborador }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No hay colaboradores asignados.</p>
        @endif

        <!-- Información del semillero -->
        <h2 class="text-lg font-semibold mt-4">Semillero:</h2>
        <p class="text-gray-600">{{ $anteproyecto->semillero->nombre_semillero ?? 'No asignado' }}</p>

        <a href="{{ route('aprendiz.anteproyectos.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">
            Volver a la lista de anteproyectos
        </a>
    </div>
@endsection
