<!-- resources/views/aprendiz/semilleros/index.blade.php -->
@extends('layouts.aprendiz')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Semilleros Disponibles</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($semilleros as $semillero)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-green-800">{{ $semillero->nombre_semillero }}</h2>
                <p><strong>Grupo de Investigación:</strong> {{ $semillero->grupoLinea->grupo->nombre_grupo ?? 'No asignado' }}</p>
                <p class="text-gray-600 mt-2">{{ $semillero->lider_semillero }}</p>
                <p class="text-gray-500 mt-1">Instructor: {{ $semillero->instructor->name ?? 'No asignado' }}</p>
                <a href="{{ route('aprendiz.semilleros.show', $semillero->id) }}" class="inline-block mt-4 text-blue-600 hover:underline">
                    Ver detalles
                </a>
            </div>
        @endforeach
    </div>
@endsection
