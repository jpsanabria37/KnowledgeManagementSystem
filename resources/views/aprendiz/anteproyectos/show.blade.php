@extends('layouts.aprendiz')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <!-- Título Principal -->
        <h1 class="text-4xl font-extrabold text-blue-900 mb-6">{{ $anteproyecto->titulo }}</h1>
        <p class="text-gray-500 mb-8">Creado por: <strong>{{ $anteproyecto->creador->name }} - No. Ficha: {{ $anteproyecto->creador->ficha }} - {{ $anteproyecto->creador->programa }} </strong></p>

        <!-- Sección de Detalles del Anteproyecto -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Descripción -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Descripción</h2>
                <p class="text-gray-700 mt-2">{{ $anteproyecto->descripcion }}</p>
            </div>

            <!-- Justificación -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Justificación</h2>
                <p class="text-gray-700 mt-2">{{ $anteproyecto->justificacion }}</p>
            </div>

            <!-- Objetivo General -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Objetivo General</h2>
                <p class="text-gray-700 mt-2">{{ $anteproyecto->objetivo_general }}</p>
            </div>

            <!-- Objetivos Específicos -->
            <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-blue-800">Objetivos Específicos</h2>
                <ul class="list-disc pl-5 mt-2 text-gray-700">
                    @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
                        <li>{{ $objetivo->nombre }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Alcance (si existe) -->
            @if($anteproyecto->alcance)
                <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-blue-800">Alcance</h2>
                    <p class="text-gray-700 mt-2">{{ $anteproyecto->alcance }}</p>
                </div>
            @endif

            <!-- Metodología (si existe) -->
            @if($anteproyecto->metodologia)
                <div class="p-4 bg-blue-50 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-blue-800">Metodología</h2>
                    <p class="text-gray-700 mt-2">{{ $anteproyecto->metodologia }}</p>
                </div>
            @endif

            <!-- Colaboradores (si existen) -->
            @if(!empty($anteproyecto->colaboradores))
                <div class="col-span-2 p-4 bg-blue-50 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-blue-800">Colaboradores</h2>
                    <ul class="list-disc pl-5 mt-2 text-gray-700">
                        @foreach($anteproyecto->colaboradores as $colaborador)
                            <li>{{ $colaborador }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow-lg space-y-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Productos y Actividades por Objetivo</h2>

    @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
        <div class="bg-white rounded-lg p-6 shadow-md border border-gray-200">
            <!-- Titulo del Objetivo -->
            <h3 class="text-2xl font-semibold text-indigo-600 mb-4">{{ $objetivo->nombre }}</h3>
            <p class="text-gray-700 mb-4 text-sm italic">Recursos Necesarios: <span class="font-medium">{{ $objetivo->recursos_necesarios }}</span></p>

            <!-- Productos del Objetivo -->
            @foreach ($objetivo->productos as $producto)
                <div class="bg-gray-100 p-4 rounded-lg mb-6 shadow-sm">
                    <!-- Titulo del Producto -->
                    <h4 class="text-xl font-semibold text-green-600 mb-3">{{ $producto->nombre }}</h4>
                    <p class="text-gray-600 mb-3">{{ $producto->descripcion }}</p>

                    <!-- Tabla de Actividades del Producto -->
                    <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Actividad</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Responsable</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Fecha Inicio</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-blue-700 font-medium">Fecha Fin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($producto->actividades as $actividad)
                                <tr class="hover:bg-blue-50">
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->nombre }}</td>
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->responsable }}</td>
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->fecha_inicio }}</td>
                                    <td class="border border-gray-300 px-6 py-4">{{ $actividad->fecha_fin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endforeach
</div>


<!-- Sección de Relaciones (Semillero, Grupo de Investigación, Centro) -->
<div class="mt-8 bg-white p-8 rounded-xl shadow-lg border border-gray-200">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-4">Información Adicional</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Semillero -->
        @if($anteproyecto->semillero)
            <div>
                <h3 class="text-xl font-semibold text-gray-700">Semillero</h3>
                <p class="text-gray-600 text-sm mt-2">{{ $anteproyecto->semillero->nombre_semillero }}</p>
            </div>
        @endif

        <!-- Grupo de Investigación -->
        @if($anteproyecto->semillero && $anteproyecto->semillero->grupoLinea->grupo->nombre_grupo)
            <div>
                <h3 class="text-xl font-semibold text-gray-700">Grupo de Investigación</h3>
                <p class="text-gray-600 text-sm mt-2">{{ $anteproyecto->semillero->grupoLinea->grupo->nombre_grupo }}</p>
            </div>
        @endif

        <!-- Centro -->
        @if($anteproyecto->semillero && $anteproyecto->semillero->grupoLinea->grupo->centro)
            <div>
                <h3 class="text-xl font-semibold text-gray-700">Centro</h3>
                <p class="text-gray-600 text-sm mt-2">{{ $anteproyecto->semillero->grupoLinea->grupo->centro->nombre_centro }} - {{ $anteproyecto->semillero->grupoLinea->grupo->centro->regional->nombre_regional }}</p>
            </div>
        @endif
    </div>

    <!-- Póster -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-700">Póster</h3>
        @if($anteproyecto->poster_path)
            <div class="mt-4 flex gap-4 items-center">
                <a href="{{ asset($anteproyecto->poster_path)}}" target="_blank" class="bg-blue-600 text-white px-5 py-2 rounded-md shadow hover:bg-blue-700 transition duration-200">
                    Ver Póster
                </a>
                <form method="POST" action="{{ route('aprendiz.anteproyectos.eliminarPoster', $anteproyecto->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 border border-red-600 text-red-600 rounded-lg bg-white hover:bg-red-600 hover:text-white hover:shadow-lg transition duration-300 ease-in-out">
                        Eliminar
                    </button>

                </form>
            </div>
        @else
            <form id="posterForm" method="POST" action="{{ route('aprendiz.anteproyectos.subirPoster', $anteproyecto->id) }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                <label for="poster" class="block text-gray-700 font-medium">Subir Póster</label>
                <input type="file" name="poster" id="poster" class="mt-2 w-full border rounded p-2 text-gray-700" accept=".pptx,.docx,.pdf">
                <span id="posterError" class="text-red-600 text-sm mt-2"></span>
                <button type="submit" class="mt-4 bg-green-600 text-white px-5 py-2 rounded-md shadow hover:bg-green-700 transition duration-200">
                    Subir
                </button>
            </form>
        @endif
    </div>

    <!-- Video -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-700">Video</h3>
        @if($anteproyecto->video_path)
            <div class="flex flex-col mt-4 gap-4 items-center">
                <div class="flex gap-4">
                    <a href="{{ asset($anteproyecto->video_path) }}" target="_blank" class="bg-blue-600 text-white px-5 py-2 rounded-md shadow hover:bg-blue-700 transition duration-200">
                        Ver en Otra Pestaña
                    </a>
                    <a href="{{asset($anteproyecto->video_path)}}" download class="bg-gray-600 text-white px-5 py-2 rounded-md shadow hover:bg-gray-700 transition duration-200">
                        Descargar Video
                    </a>
                </div>
                <form method="POST" action="{{ route('aprendiz.anteproyectos.eliminarVideo', $anteproyecto->id) }}" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 border border-red-600 text-red-600 rounded-lg bg-white hover:bg-red-600 hover:text-white hover:shadow-lg transition duration-300 ease-in-out">
                        Eliminar
                    </button>
                </form>
            </div>
        @else
            <form id="videoForm" method="POST" action="{{ route('aprendiz.anteproyectos.subirVideo', $anteproyecto->id) }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                <label for="video" class="block text-gray-700 font-medium">Subir Video</label>
                <input type="file" name="video" id="video" class="mt-2 w-full border rounded p-2 text-gray-700" accept="video/mp4,video/avi,video/mov,video/wmv">
                <span id="videoError" class="text-red-600 text-sm mt-2"></span>
                <button type="submit" class="mt-4 bg-green-600 text-white px-5 py-2 rounded-md shadow hover:bg-green-700 transition duration-200">
                    Subir
                </button>
            </form>
        @endif
    </div>

    <!-- Botones de acciones -->
    <div class="mt-8 flex gap-6">
        <a href="{{ route('aprendiz.anteproyectos.index') }}" class="inline-block bg-blue-700 text-white font-semibold py-3 px-6 rounded-md shadow hover:bg-blue-800 transition duration-200">
            Volver a Mis Anteproyectos
        </a>
        <a href="{{ route('aprendiz.anteproyectos.generarPdf', $anteproyecto->id) }}" class="inline-block bg-red-500 text-white font-semibold py-3 px-6 rounded-md shadow hover:bg-red-600 transition duration-200">
            Generar PDF
        </a>
        </div>
    </div>


    <script>
  // Validación del póster
document.getElementById('posterForm').addEventListener('submit', function(e) {
    const posterInput = document.getElementById('poster');
    const posterError = document.getElementById('posterError');

    posterError.textContent = ''; // Limpiar error previo

    if (posterInput.files.length === 0) {
        posterError.textContent = 'Por favor, selecciona un archivo.';
        e.preventDefault();
        return;
    }

    const allowedExtensions = ['pptx', 'docx', 'pdf'];
    const fileSizeLimit = 5 * 1024 * 1024; // 5 MB
    const file = posterInput.files[0];
    const extension = file.name.split('.').pop().toLowerCase();

    if (!allowedExtensions.includes(extension)) {
        posterError.textContent = 'Solo se permiten archivos PPTX, DOCX o PDF.';
        e.preventDefault();
    } else if (file.size > fileSizeLimit) {
        posterError.textContent = 'El archivo no debe superar los 5 MB.';
        e.preventDefault();
    }
});

// Validación del video
document.getElementById('videoForm').addEventListener('submit', function(e) {
    const videoInput = document.getElementById('video');
    const videoError = document.getElementById('videoError');

    videoError.textContent = ''; // Limpiar error previo

    if (videoInput.files.length === 0) {
        videoError.textContent = 'Por favor, selecciona un archivo.';
        e.preventDefault();
        return;
    }

    const allowedExtensions = ['mp4', 'avi', 'mov', 'wmv'];
    const fileSizeLimit = 50 * 1024 * 1024; // 50 MB
    const file = videoInput.files[0];
    const extension = file.name.split('.').pop().toLowerCase();

    if (!allowedExtensions.includes(extension)) {
        videoError.textContent = 'Solo se permiten archivos MP4, AVI, MOV o WMV.';
        e.preventDefault();
    } else if (file.size > fileSizeLimit) {
        videoError.textContent = 'El archivo no debe superar los 50 MB.';
        e.preventDefault();
    }
});

</script>
@endsection
