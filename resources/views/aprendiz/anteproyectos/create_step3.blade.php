@extends('layouts.aprendiz')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Añadir Actividades a los Objetivos Específicos</h2>

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

    <!-- Formulario por Objetivo Específico -->
    @php $todosCompletos = true; @endphp
    @foreach ($anteproyecto->objetivosEspecificos as $index => $objetivo)
        <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
            <h4 class="text-lg font-semibold mb-2">Objetivo {{ $index + 1 }}</h4>
            <p><strong>Nombre:</strong> {{ $objetivo->nombre }}</p>
            <p><strong>Recursos Necesarios:</strong> {{ $objetivo->recursos_necesarios }}</p>

            @if ($objetivo->actividades->isEmpty())
                @php $todosCompletos = false; @endphp
                <p class="text-red-500 font-semibold">Este objetivo aún no tiene actividades registradas.</p>
            @else
                <h5 class="font-semibold text-gray-700 mt-2">Actividades Registradas</h5>
                <ul class="list-disc pl-6">
                    @foreach ($objetivo->actividades as $actividad)
                        <li>
                            <strong>{{ $actividad->nombre }}</strong> 
                            ({{ $actividad->fecha_inicio }} - {{ $actividad->fecha_fin }}) - Responsable: {{ $actividad->responsable }}
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- Formulario para añadir nuevas actividades -->
            <form action="{{ route('aprendiz.anteproyectos.storeStep3', $objetivo->id) }}" method="POST" class="mt-4">
                @csrf

                <h5 class="font-semibold text-gray-700 mb-2">Añadir Actividades</h5>
                <div id="actividad-list-{{ $objetivo->id }}" class="grid grid-cols-1 gap-2">
                    <div class="bg-white p-3 rounded-lg border border-gray-200 grid grid-cols-2 gap-2">
                        <div>
                            <label>Nombre:</label>
                            <input type="text" name="actividades[0][nombre]" class="w-full border-gray-300 rounded-lg" required>
                        </div>
                        <div>
                            <label>Responsable:</label>
                            <input type="text" name="actividades[0][responsable]" class="w-full border-gray-300 rounded-lg" required>
                        </div>
                        <div>
                            <label>Fecha Inicio:</label>
                            <input type="date" name="actividades[0][fecha_inicio]" class="w-full border-gray-300 rounded-lg" required>
                        </div>
                        <div>
                            <label>Fecha Fin:</label>
                            <input type="date" name="actividades[0][fecha_fin]" class="w-full border-gray-300 rounded-lg" required>
                        </div>
                    </div>
                </div>

                <!-- Botón para añadir más actividades -->
                <button type="button" onclick="addActivity({{ $objetivo->id }})" class="text-blue-500 hover:text-blue-700 mt-2">
                    + Añadir Actividad
                </button>

                <!-- Botón para enviar -->
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4 w-full">Guardar Actividades</button>
            </form>
        </div>
    @endforeach

    <!-- Botón para avanzar al siguiente paso -->
    @if ($todosCompletos)
        <div class="mt-6">
            <a href="{{ route('aprendiz.anteproyectos.createStep4', $anteproyecto->id) }}"
               class="bg-blue-500 text-white px-4 py-2 rounded w-full inline-block text-center">
                Avanzar al Siguiente Paso
            </a>
        </div>
    @else
        <p class="text-center text-gray-700 mt-4">Completa todas las actividades para avanzar al siguiente paso.</p>
    @endif

    <script>
        // Función para añadir nuevas actividades dinámicamente
        function addActivity(objetivoId) {
            const container = document.getElementById('actividad-list-' + objetivoId);
            const uniqueId = Date.now();
            const newActivity = document.createElement('div');
            newActivity.classList.add('bg-white', 'p-3', 'rounded-lg', 'border', 'border-gray-200', 'grid', 'grid-cols-2', 'gap-2');

            newActivity.innerHTML = `
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="actividades[${uniqueId}][nombre]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Responsable:</label>
                    <input type="text" name="actividades[${uniqueId}][responsable]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Fecha Inicio:</label>
                    <input type="date" name="actividades[${uniqueId}][fecha_inicio]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Fecha Fin:</label>
                    <input type="date" name="actividades[${uniqueId}][fecha_fin]" class="w-full border-gray-300 rounded-lg" required>
                </div>
            `;
            container.appendChild(newActivity);
        }
    </script>
@endsection
