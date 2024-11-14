@extends('layouts.aprendiz')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Revisión y Configuración Final del Anteproyecto</h2>

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

    <!-- Formulario para los Objetivos Específicos y Actividades -->
    <form action="{{ route('aprendiz.anteproyectos.storeStep3', $anteproyecto->id) }}" method="POST" onsubmit="return validateForm()">
        @csrf

        <h3 class="text-xl font-semibold mb-4">Objetivos Específicos y Actividades</h3>

        @foreach($anteproyecto->objetivosEspecificos as $index => $objetivo)
            <!-- Sección Colapsable de Objetivo Específico -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                <button type="button" onclick="toggleObjective({{ $index }})" class="w-full text-left font-semibold text-lg">
                    Objetivo {{ $index + 1 }}
                </button>

                <div id="objective-{{ $index }}" class="mt-4 hidden">
                    <input type="hidden" name="objetivos_especificos[{{ $index }}][id]" value="{{ $objetivo->id }}">
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-1">Nombre:</label>
                            <input type="text" name="objetivos_especificos[{{ $objetivo->id }}][nombre]"
                                   value="{{ old("objetivos_especificos.{$objetivo->id}.nombre", $objetivo->nombre) }}"
                                   class="w-full border-gray-300 rounded-lg mb-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-1">Recursos Necesarios:</label>
                            <textarea name="objetivos_especificos[{{ $objetivo->id }}][recursos_necesarios]"
                                      class="w-full border-gray-300 rounded-lg mb-2">{{ old("objetivos_especificos.{$objetivo->id}.recursos_necesarios", $objetivo->recursos_necesarios) }}</textarea>
                        </div>
                    </div>

                    <!-- Actividades -->
                    <div class="mb-4">
                        <h5 class="font-semibold text-gray-700 mt-2">Actividades</h5>
                        <div class="actividad-list grid grid-cols-1 gap-2" id="actividad-list-{{ $objetivo->id }}">
                            @foreach ($objetivo->actividades as $actividad)
                                <div class="bg-white p-3 rounded-lg border border-gray-200 grid grid-cols-2 gap-2">
                                    <input type="hidden" name="objetivos_especificos[{{ $objetivo->id }}][actividades][{{ $actividad->id }}][id]" value="{{ $actividad->id }}">
                                    
                                    <div>
                                        <label>Nombre:</label>
                                        <input type="text" name="objetivos_especificos[{{ $objetivo->id }}][actividades][{{ $actividad->id }}][nombre]"
                                               value="{{ old("objetivos_especificos.{$objetivo->id}.actividades.{$actividad->id}.nombre", $actividad->nombre) }}"
                                               class="w-full border-gray-300 rounded-lg" required>
                                    </div>
                                    <div>
                                        <label>Responsable:</label>
                                        <input type="text" name="objetivos_especificos[{{ $objetivo->id }}][actividades][{{ $actividad->id }}][responsable]"
                                               value="{{ old("objetivos_especificos.{$objetivo->id}.actividades.{$actividad->id}.responsable", $actividad->responsable) }}"
                                               class="w-full border-gray-300 rounded-lg" required>
                                    </div>
                                    <div>
                                        <label>Fecha Inicio:</label>
                                        <input type="date" name="objetivos_especificos[{{ $objetivo->id }}][actividades][{{ $actividad->id }}][fecha_inicio]"
                                               value="{{ old("objetivos_especificos.{$objetivo->id}.actividades.{$actividad->id}.fecha_inicio", $actividad->fecha_inicio) }}"
                                               class="w-full border-gray-300 rounded-lg" required>
                                    </div>
                                    <div>
                                        <label>Fecha Fin:</label>
                                        <input type="date" name="objetivos_especificos[{{ $objetivo->id }}][actividades][{{ $actividad->id }}][fecha_fin]"
                                               value="{{ old("objetivos_especificos.{$objetivo->id}.actividades.{$actividad->id}.fecha_fin", $actividad->fecha_fin) }}"
                                               class="w-full border-gray-300 rounded-lg" required>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Botón para añadir una nueva actividad -->
                        <button type="button" onclick="addActivity({{ $objetivo->id }})" class="text-blue-500 hover:text-blue-700 mt-2">
                            + Añadir Actividad
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 w-full">Guardar y Continuar</button>
    </form>

    <script>
        // Alternar sección de cada objetivo
        function toggleObjective(index) {
            const objective = document.getElementById('objective-' + index);
            objective.classList.toggle('hidden');
        }

        function addActivity(objetivoId) {
            const container = document.getElementById('actividad-list-' + objetivoId);
            const uniqueId = Date.now();
            const newActivity = document.createElement('div');
            newActivity.classList.add('bg-white', 'p-3', 'rounded-lg', 'border', 'border-gray-200', 'grid', 'grid-cols-2', 'gap-2');

            newActivity.innerHTML = `
                <input type="hidden" name="objetivos_especificos[${objetivoId}][actividades][new_${uniqueId}][id]" value="new_${uniqueId}">
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="objetivos_especificos[${objetivoId}][actividades][new_${uniqueId}][nombre]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Responsable:</label>
                    <input type="text" name="objetivos_especificos[${objetivoId}][actividades][new_${uniqueId}][responsable]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Fecha Inicio:</label>
                    <input type="date" name="objetivos_especificos[${objetivoId}][actividades][new_${uniqueId}][fecha_inicio]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Fecha Fin:</label>
                    <input type="date" name="objetivos_especificos[${objetivoId}][actividades][new_${uniqueId}][fecha_fin]" class="w-full border-gray-300 rounded-lg" required>
                </div>
            `;
            container.appendChild(newActivity);
        }

        function validateForm() {
            const errorContainer = document.getElementById('error-container');
            let valid = true;

            const objetivos = document.querySelectorAll('.actividad-list');
            objetivos.forEach(container => {
                if (container.children.length === 0) valid = false;
            });

            if (!valid) {
                errorContainer.classList.remove('hidden');
                errorContainer.scrollIntoView({ behavior: 'smooth' });
            } else {
                errorContainer.classList.add('hidden');
            }
            return valid;
        }
    </script>
@endsection
