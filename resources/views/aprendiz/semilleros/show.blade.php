@extends('layouts.aprendiz')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-3xl font-bold text-blue-700 mb-4">{{ $semillero->nombre_semillero }}</h1>
        <p class="text-gray-600 mb-4">{{ $semillero->descripcion }}</p>

        <div class="border-t border-gray-300 mt-6 pt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detalles del Centro de Formación</h2>
            <p><strong>Centro:</strong> {{ $semillero->grupoLinea->grupo->centro->nombre_centro }}</p>
            <p><strong>Regional:</strong> {{ $semillero->grupoLinea->grupo->centro->regional->nombre_regional }}</p>
        </div>

        <div class="border-t border-gray-300 mt-6 pt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Línea de Investigación</h2>
            <p>{{ $semillero->grupoLinea->linea->nombre_linea }}</p>
        </div>

        <div class="border-t border-gray-300 mt-6 pt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Anteproyectos Asociados</h2>
            @if ($semillero->anteproyectos->isEmpty())
                <p class="text-gray-500">No hay anteproyectos registrados en este semillero.</p>
            @else
                <ul class="list-disc pl-6">
                    @foreach ($semillero->anteproyectos as $anteproyecto)
                        <li>
                            <a href="{{ route('aprendiz.anteproyectos.showPublic', $anteproyecto->id) }}" class="text-blue-500 hover:underline">
                                {{ $anteproyecto->titulo }}
                            </a> - Estado: {{ ucfirst($anteproyecto->estado) }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
