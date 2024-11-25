@extends('layouts.aprendiz')  <!-- Usa tu layout principal -->

@section('content')
<div class="container mx-auto py-6">
<div class="mb-6">
<form action="{{ route('aprendiz.buscar') }}" method="POST" class="w-full max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
    @csrf <!-- Token de seguridad obligatorio en POST -->
    <div class="flex items-center space-x-4">
        <!-- Input de búsqueda -->
        <input
            type="text"
            name="query"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-500"
            placeholder="Buscar anteproyectos..."
            value="{{ old('term', $term ?? '') }}"
            autocomplete="off"
            required
        >

        <!-- Botón de búsqueda -->
        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Buscar
        </button>
    </div>
</form>
</div>


        <h1 class="text-3xl font-bold mb-4">Resultados de búsqueda para: "{{ $term }}"</h1>

        @if($resultados->isEmpty())
            <p class="text-gray-600">No se encontraron anteproyectos que coincidan con tu búsqueda.</p>
        @else
            <div class="space-y-6">
                @foreach($resultados as $anteproyecto)
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300">
                        <!-- Hacer que el anteproyecto sea un enlace -->
                        <a href="{{ route('aprendiz.anteproyectos.showPublic', $anteproyecto->id) }}" class="block">
                            <h4 class="text-xl font-semibold text-blue-600 mb-2">{{ $anteproyecto->titulo }}</h4>
                            <p class="text-gray-700 mb-4">{{ Str::limit($anteproyecto->descripcion, 150) }}</p>

                            <div class="text-sm text-gray-500">
                                <p><strong>Tags:</strong> {{ $anteproyecto->tags }}</p>
                                <p><strong>Objetivo General:</strong> {{ $anteproyecto->objetivo_general }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
