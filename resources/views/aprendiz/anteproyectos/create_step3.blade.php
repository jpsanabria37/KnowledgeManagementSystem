@extends('layouts.aprendiz')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Añadir Productos y Actividades a los Objetivos Específicos</h2>

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

    <!-- Validación para avanzar -->
    @php
        $puedeAvanzar = false;
    @endphp

    <!-- Formulario por Objetivo Específico -->
    @foreach ($anteproyecto->objetivosEspecificos as $index => $objetivo)
        <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
            <h4 class="text-lg font-semibold mb-2">Objetivo {{ $index + 1 }}</h4>
            <p><strong>Nombre:</strong> {{ $objetivo->nombre }}</p>
            <p><strong>Recursos Necesarios:</strong> {{ $objetivo->recursos_necesarios }}</p>

            <!-- Productos Registrados -->
            @if ($objetivo->productos->isEmpty())
                <p class="text-red-500 font-semibold">Este objetivo aún no tiene productos registrados.</p>
            @else
                <h5 class="font-semibold text-gray-700 mt-2">Productos Registrados</h5>
                <ul class="list-disc pl-6">
                    @foreach ($objetivo->productos as $producto)
                        <li>
                            <strong>{{ $producto->nombre }}</strong>: {{ $producto->descripcion }}
                            @if ($producto->actividades->isNotEmpty())
                                @php $puedeAvanzar = true; @endphp
                                <ul class="list-disc pl-6">
                                    @foreach ($producto->actividades as $actividad)
                                        <li>
                                            <strong>{{ $actividad->nombre }}</strong> 
                                            ({{ $actividad->fecha_inicio }} - {{ $actividad->fecha_fin }}) - Responsable: {{ $actividad->responsable }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-red-500 font-semibold">Este producto no tiene actividades registradas.</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- Formulario para añadir productos -->
            <form action="{{ route('aprendiz.anteproyectos.storeStep3', $anteproyecto->id) }}" method="POST" class="mt-4">
                @csrf
                <!-- Campo oculto para el ID del anteproyecto -->
                <input type="hidden" name="anteproyecto_id" value="{{ $anteproyecto->id }}">

                <!-- Campo oculto para el ID del objetivo específico, si aplica -->
                <input type="hidden" name="objetivo_especifico_id" value="{{ $objetivo->id }}">

                <h5 class="font-semibold text-gray-700 mb-2">Añadir Productos</h5>
                <div id="producto-list-{{ $objetivo->id }}" class="grid grid-cols-1 gap-2">
                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <div>
                            <label>Nombre del Producto:</label>
                            <input type="text" name="productos[0][nombre]" class="w-full border-gray-300 rounded-lg" required>
                        </div>
                        <div class="mt-2">
                            <label>Descripción:</label>
                            <textarea name="productos[0][descripcion]" class="w-full border-gray-300 rounded-lg" required></textarea>
                        </div>

                        <!-- Actividades para el producto -->
                        <h6 class="font-semibold text-gray-700 mt-4">Actividades del Producto</h6>
                        <div id="actividad-list-{{ $objetivo->id }}-0" class="grid grid-cols-1 gap-2">
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 grid grid-cols-2 gap-2">
                                <div>
                                    <label>Nombre de la Actividad:</label>
                                    <input type="text" name="productos[0][actividades][0][nombre]" class="w-full border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <label>Responsable:</label>
                                    <input type="text" name="productos[0][actividades][0][responsable]" class="w-full border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <label>Fecha Inicio:</label>
                                    <input type="date" name="productos[0][actividades][0][fecha_inicio]" class="w-full border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <label>Fecha Fin:</label>
                                    <input type="date" name="productos[0][actividades][0][fecha_fin]" class="w-full border-gray-300 rounded-lg" required>
                                </div>
                            </div>
                        </div>
                        <!-- Botón para añadir más actividades al producto -->
                        <button 
                                type="button" 
                                onclick="addActivity({{ $objetivo->id }}, 0)" 
                                class="flex items-center justify-center gap-2 bg-blue-600 text-white font-medium px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none transition-all duration-300 mt-5"
                            >
                                Añadir Actividad
                        </button>
                    </div>
                </div>

                <!-- Botón para añadir más productos -->
                <button type="button" 
                onclick="addProducto({{ $objetivo->id }})" 
                class="flex items-center justify-center gap-2 bg-blue-600 text-white font-medium px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none transition-all duration-300 mt-5">
                    + Añadir Producto
                </button>

                <!-- Botón para enviar -->
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4 w-full">Guardar Productos</button>
            </form>
        </div>
    @endforeach

    <!-- Botón para avanzar -->
    <div class="text-center mt-6">
        <form action="{{ route('aprendiz.anteproyectos.createStep4', $anteproyecto->id) }}" method="GET">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg"
                {{ $puedeAvanzar ? '' : 'disabled' }}>
                Avanzar al Paso 4
            </button>
        </form>
        @if (!$puedeAvanzar)
            <p class="text-red-500 mt-2">Debes registrar al menos un producto con actividades para avanzar.</p>
        @endif
    </div>

    <script>
    // Función para añadir nuevos productos dinámicamente
function addProducto(objetivoId) {
    const container = document.getElementById('producto-list-' + objetivoId);
    const uniqueId = Date.now();
    const newProducto = document.createElement('div');
    newProducto.classList.add('bg-white', 'p-3', 'rounded-lg', 'border', 'border-gray-200', 'mt-2');
    newProducto.setAttribute('id', `producto-${uniqueId}`);

    newProducto.innerHTML = `
        <div>
            <label>Nombre del Producto:</label>
            <input type="text" name="productos[${uniqueId}][nombre]" class="w-full border-gray-300 rounded-lg" required>
        </div>
        <div class="mt-2">
            <label>Descripción:</label>
            <textarea name="productos[${uniqueId}][descripcion]" class="w-full border-gray-300 rounded-lg" required></textarea>
        </div>
        <h6 class="font-semibold text-gray-700 mt-4">Actividades del Producto</h6>
        <div id="actividad-list-${objetivoId}-${uniqueId}" class="grid grid-cols-1 gap-2">
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 grid grid-cols-2 gap-2">
                <div>
                    <label>Nombre de la Actividad:</label>
                    <input type="text" name="productos[${uniqueId}][actividades][0][nombre]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Responsable:</label>
                    <input type="text" name="productos[${uniqueId}][actividades][0][responsable]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Fecha Inicio:</label>
                    <input type="date" name="productos[${uniqueId}][actividades][0][fecha_inicio]" class="w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label>Fecha Fin:</label>
                    <input type="date" name="productos[${uniqueId}][actividades][0][fecha_fin]" class="w-full border-gray-300 rounded-lg" required>
                </div>
            </div>
        </div>
        <button type="button" onclick="addActivity(${objetivoId}, ${uniqueId})" 
        class="flex items-center justify-center gap-2 bg-blue-600 text-white font-medium px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none transition-all duration-300 mt-5">
            + Añadir Actividad
        </button>
        <button type="button" onclick="removeProducto(${uniqueId})" 
        class="flex items-center justify-center gap-2 bg-red-500 text-white font-medium px-4 py-2 rounded-lg shadow-lg hover:bg-red-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none transition-all duration-300 mt-5"">
            - Eliminar Producto
        </button>
    `;
    container.appendChild(newProducto);
}

// Función para añadir nuevas actividades dinámicamente
function addActivity(objetivoId, productoId) {
    const container = document.getElementById(`actividad-list-${objetivoId}-${productoId}`);
    const uniqueId = Date.now();
    const newActivity = document.createElement('div');
    newActivity.classList.add('bg-gray-50', 'p-3', 'rounded-lg', 'border', 'border-gray-200', 'grid', 'grid-cols-2', 'gap-2', 'mt-2');
    newActivity.setAttribute('id', `actividad-${uniqueId}`);

    newActivity.innerHTML = `
        <div>
            <label>Nombre de la Actividad:</label>
            <input type="text" name="productos[${productoId}][actividades][${uniqueId}][nombre]" class="w-full border-gray-300 rounded-lg" required>
        </div>
        <div>
            <label>Responsable:</label>
            <input type="text" name="productos[${productoId}][actividades][${uniqueId}][responsable]" class="w-full border-gray-300 rounded-lg" required>
        </div>
        <div>
            <label>Fecha Inicio:</label>
            <input type="date" name="productos[${productoId}][actividades][${uniqueId}][fecha_inicio]" class="w-full border-gray-300 rounded-lg" required>
        </div>
        <div>
            <label>Fecha Fin:</label>
            <input type="date" name="productos[${productoId}][actividades][${uniqueId}][fecha_fin]" class="w-full border-gray-300 rounded-lg" required>
        </div>
        <button type="button" onclick="removeActivity(${uniqueId})" 
        class="flex items-center justify-center gap-2 bg-red-500 text-white font-medium px-4 py-2 rounded-lg shadow-lg hover:bg-red-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none transition-all duration-300 mt-5 w-60">
            - Eliminar Actividad 
        </button>
    `;
    container.appendChild(newActivity);
}

// Función para eliminar un producto dinámicamente
function removeProducto(productoId) {
    const productoElement = document.getElementById(`producto-${productoId}`);
    if (productoElement) {
        productoElement.remove();
    }
}

// Función para eliminar una actividad dinámicamente
function removeActivity(activityId) {
    const activityElement = document.getElementById(`actividad-${activityId}`);
    if (activityElement) {
        activityElement.remove();
    }
}

</script>
@endsection