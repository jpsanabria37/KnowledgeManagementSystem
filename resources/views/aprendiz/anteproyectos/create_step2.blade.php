<!-- resources/views/aprendiz/anteproyectos/create_step2.blade.php -->
@extends('layouts.aprendiz')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Paso 2: Añadir Objetivos Específicos y Recursos Necesarios</h2>
    <p class="text-gray-600 mb-6">Por favor, añade al menos 4 objetivos específicos y los recursos necesarios para cada uno.</p>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('aprendiz.anteproyectos.storeStep2', $anteproyecto->id) }}" method="POST" onsubmit="return validateObjectives()">
        @csrf
        <div id="objetivosContainer">
            <!-- Objetivo Específico -->
            <div class="objetivo-item mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <label class="block text-gray-700 font-bold mb-2">Objetivo Específico:</label>
                <input type="text" name="objetivos_especificos[0][nombre]" class="w-full border border-gray-300 rounded-lg p-2 mb-4" required>

                <label class="block text-gray-700 font-bold mb-2">Recursos Necesarios:</label>
                <textarea name="objetivos_especificos[0][recursos_necesarios]" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Especifica los recursos necesarios"></textarea>
            </div>
        </div>

        <button type="button" onclick="addObjective()" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg mt-4">Añadir Otro Objetivo</button>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg mt-4">Guardar Objetivos</button>
    </form>

    <script>
        let objetivoIndex = 1;

        function addObjective() {
            const container = document.getElementById('objetivosContainer');
            const newObjetivo = document.createElement('div');
            newObjetivo.classList.add('objetivo-item', 'mb-6', 'p-4', 'bg-blue-50', 'rounded-lg', 'border', 'border-blue-200');
            newObjetivo.innerHTML = `
                <label class="block text-gray-700 font-bold mb-2">Objetivo Específico:</label>
                <input type="text" name="objetivos_especificos[${objetivoIndex}][nombre]" class="w-full border border-gray-300 rounded-lg p-2 mb-4" required>

                <label class="block text-gray-700 font-bold mb-2">Recursos Necesarios:</label>
                <textarea name="objetivos_especificos[${objetivoIndex}][recursos_necesarios]" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Especifica los recursos necesarios"></textarea>
            `;
            container.appendChild(newObjetivo);
            objetivoIndex++;
        }

        function validateObjectives() {
            const objectiveItems = document.querySelectorAll('.objetivo-item');
            if (objectiveItems.length < 4) {
                alert("Debe añadir al menos 4 objetivos específicos antes de continuar.");
                return false; // Evita el envío del formulario
            }
            return true; // Permite el envío del formulario si hay al menos 4 objetivos
        }
    </script>
@endsection
