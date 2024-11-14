@extends('layouts.aprendiz')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Crear Nuevo Anteproyecto</h1>

        <!-- Mostrar errores de validación globales -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Oops!</strong> Hay algunos problemas con tus datos:
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('aprendiz.anteproyectos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Campo Título -->
            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 font-medium">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                @error('titulo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-medium">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Objetivo General -->
            <div class="mb-4">
                <label for="objetivo_general" class="block text-gray-700 font-medium">Objetivo General</label>
                <textarea name="objetivo_general" id="objetivo_general" rows="3" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>{{ old('objetivo_general') }}</textarea>
                @error('objetivo_general')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Objetivos Específicos -->
            <div class="mb-4">
                <label for="objetivos_especificos" class="block text-gray-700 font-medium">Objetivos Específicos</label>
                <textarea name="objetivos_especificos" id="objetivos_especificos" rows="3" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>{{ old('objetivos_especificos') }}</textarea>
                @error('objetivos_especificos')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Justificación -->
            <div class="mb-4">
                <label for="justificacion" class="block text-gray-700 font-medium">Justificación</label>
                <textarea name="justificacion" id="justificacion" rows="3" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>{{ old('justificacion') }}</textarea>
                @error('justificacion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Alcance -->
            <div class="mb-4">
                <label for="alcance" class="block text-gray-700 font-medium">Alcance</label>
                <textarea name="alcance" id="alcance" rows="3" class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('alcance') }}</textarea>
                @error('alcance')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Colaboradores -->
            <div class="mb-4">
                <label for="colaboradores" class="block text-gray-700 font-medium">Colaboradores</label>
                <input type="text" name="colaboradores[]" class="w-full mt-1 p-2 border border-gray-300 rounded-md mb-2" placeholder="Colaborador 1" value="{{ old('colaboradores.0') }}">
                <input type="text" name="colaboradores[]" class="w-full mt-1 p-2 border border-gray-300 rounded-md mb-2" placeholder="Colaborador 2" value="{{ old('colaboradores.1') }}">
                <input type="text" name="colaboradores[]" class="w-full mt-1 p-2 border border-gray-300 rounded-md mb-2" placeholder="Colaborador 3" value="{{ old('colaboradores.2') }}">
                <!-- Se pueden agregar más campos de colaboradores según se necesite -->
            </div>

            <!-- Campo Metodología -->
            <div class="mb-4">
                <label for="metodologia" class="block text-gray-700 font-medium">Metodología</label>
                <textarea name="metodologia" id="metodologia" rows="3" class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('metodologia') }}</textarea>
                @error('metodologia')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Estado -->
            <div class="mb-4">
                <label for="estado" class="block text-gray-700 font-medium">Estado</label>
                <select name="estado" id="estado" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                    <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="aprobado" {{ old('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rechazado" {{ old('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                </select>
                @error('estado')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de Inicio -->
            <div class="mb-4">
                <label for="fecha_inicio" class="block text-gray-700 font-medium">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                @error('fecha_inicio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de Fin -->
            <div class="mb-4">
                <label for="fecha_fin" class="block text-gray-700 font-medium">Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                @error('fecha_fin')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Opción para generar o subir PDF -->
            <div class="mb-4">
                <label for="pdf_option" class="block text-gray-700 font-medium">PDF del Anteproyecto</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="pdf_option" value="generate" class="mr-2" {{ old('pdf_option', 'generate') == 'generate' ? 'checked' : '' }}>
                        Generar PDF automáticamente
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="pdf_option" value="upload" class="mr-2" {{ old('pdf_option') == 'upload' ? 'checked' : '' }}>
                        Subir PDF manualmente
                    </label>
                </div>
                @error('pdf_option')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para subir PDF (visible solo si selecciona la opción de subir) -->
            <div class="mb-4" id="upload_pdf_section" style="display: none;">
                <label for="archivo_pdf" class="block text-gray-700 font-medium">Subir PDF</label>
                <input type="file" name="archivo_pdf" id="archivo_pdf" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
            </div>

            <!-- Botón de Envío -->
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700">
                Crear Anteproyecto
            </button>
        </form>
    </div>

    <!-- Script para manejo de la visibilidad de PDF -->
    <script>
        document.querySelectorAll('input[name="pdf_option"]').forEach(function(elem) {
            elem.addEventListener('change', function() {
                var uploadSection = document.getElementById('upload_pdf_section');
                uploadSection.style.display = this.value === 'upload' ? 'block' : 'none';
            });
        });
    </script>
@endsection
