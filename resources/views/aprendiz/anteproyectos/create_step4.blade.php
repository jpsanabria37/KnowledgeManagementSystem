@extends('layouts.aprendiz')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Paso 4: Justificación, Alcance y Metodología</h2>

    <!-- Información General -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
        <h3 class="text-xl font-semibold mb-2">Información General</h3>
        <p><strong>Título:</strong> {{ $anteproyecto->titulo }}</p>
        <p><strong>Descripción:</strong> {{ $anteproyecto->descripcion }}</p>
        <p><strong>Objetivo General:</strong> {{ $anteproyecto->objetivo_general }}</p>
    </div>

    <!-- Mensajes de Error -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <p><strong>Error:</strong> Hay problemas con los datos ingresados.</p>
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de Justificación, Alcance y Metodología -->
    <form action="{{ route('aprendiz.anteproyectos.storeStep4', $anteproyecto->id) }}" method="POST">
        @csrf

        <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
            <label class="block text-gray-700 font-bold mb-2">Justificación:</label>
            <textarea name="justificacion" class="w-full border-gray-300 rounded-lg mb-4" rows="4" required>{{ old('justificacion', $anteproyecto->justificacion ?? '') }}</textarea>

            <label class="block text-gray-700 font-bold mb-2">Alcance:</label>
            <textarea name="alcance" class="w-full border-gray-300 rounded-lg mb-4" rows="4" required>{{ old('alcance', $anteproyecto->alcance ?? '') }}</textarea>

            <label class="block text-gray-700 font-bold mb-2">Metodología:</label>
            <textarea name="metodologia" class="w-full border-gray-300 rounded-lg mb-4" rows="4" required>{{ old('metodologia', $anteproyecto->metodologia ?? '') }}</textarea>
        </div>

        <!-- Botón de Guardar -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Guardar y Finalizar</button>
    </form>
@endsection
