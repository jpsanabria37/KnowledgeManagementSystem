@extends('layouts.aprendiz')

@section('content')

    <div x-data="{ showContent: false }" x-init="showContent = true" 
         class="bg-gradient-to-r from-blue-50 to-blue-100 p-8 rounded-lg shadow-xl transition-all duration-500"
         x-bind:class="showContent ? 'opacity-100 scale-100' : 'opacity-0 scale-90'">
        
        <h1 x-data="{ animate: false }" x-init="animate = true" 
            class="text-3xl font-extrabold text-gray-900 mb-6 border-b-2 border-blue-300 pb-2 "
            x-bind:class="animate ? 'translate-y-0 opacity-100' : '-translate-y-5 opacity-0'">
            {{ $anteproyecto->titulo }}
        </h1>

        <div class="mb-6">
            <p class="text-lg text-gray-700 mb-2">
                <span class="font-bold text-gray-800">Descripción:</span> {{ $anteproyecto->descripcion }}
            </p>
            <p class="text-lg text-gray-700 mb-2">
                <span class="font-bold text-gray-800">Justificación:</span> {{ $anteproyecto->justificacion }}
            </p>
            <p class="text-lg text-gray-700 mb-2">
                <span class="font-bold text-gray-800">Creado por:</span> 
                {{ $anteproyecto->creador->name ?? 'Desconocido' }}
            </p>
        </div>

        <!-- Mostrar colaboradores -->
        <div class="bg-white p-6 rounded-lg shadow-inner mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Colaboradores:</h2>
            @if (!empty($anteproyecto->colaboradores))
                <ul class="list-disc pl-6 text-gray-700">
                    @foreach ($anteproyecto->colaboradores as $colaborador)
                        <li class="mb-1" x-data="{ show: false }" x-intersect:enter="show = true"
                            x-bind:class="show ? 'translate-x-0 opacity-100' : '-translate-x-5 opacity-0'"
                            class="transition-transform duration-500 ease-in-out">
                            {{ $colaborador }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic">No hay colaboradores asignados.</p>
            @endif
        </div>

        <!-- Información del semillero -->
        <div class="bg-white p-6 rounded-lg shadow-inner">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Semillero:</h2>
            <p class="text-lg text-gray-700">
                {{ $anteproyecto->semillero->nombre_semillero ?? 'No asignado' }}
            </p>
        </div>

        <a href="{{ route('aprendiz.anteproyectos.index') }}" 
           class="block mt-8 text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 shadow-lg">
            Volver a la lista de anteproyectos
        </a>
    </div>
@endsection
