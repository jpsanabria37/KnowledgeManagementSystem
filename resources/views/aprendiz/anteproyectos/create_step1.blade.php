@extends('layouts.aprendiz')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Crear Anteproyecto - Paso 1</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('aprendiz.anteproyectos.storeStep1') }}" method="POST">
            @csrf
                <!-- Campo Semillero -->
            <div class="mb-4">
                <label for="semillero_id" class="block font-medium text-gray-700">Semillero</label>
                <select name="semillero_id" id="semillero_id" class="w-full border-gray-300 rounded-lg" required>
                    <option value="">Selecciona un Semillero</option>
                    @foreach ($semilleros as $semillero)
                        <option value="{{ $semillero->id }}" {{ old('semillero_id') == $semillero->id ? 'selected' : '' }}>
                            {{ $semillero->nombre_semillero }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Colaboradores -->
            <div class="mb-4">
        <label for="colaboradores" class="block text-sm font-medium text-gray-700">Colaboradores</label>
        <div id="colaboradores" class="flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <input type="text" name="colaboradores[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nombre del colaborador" required>
                    <button type="button" onclick="addColaborador()" class="p-2 bg-indigo-500 text-white rounded-full shadow hover:bg-indigo-600">
                        <span class="text-lg font-bold">+</span>
                    </button>
                </div>
        </div>
    </div>

            <!-- Título -->
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título del Anteproyecto</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('descripcion') }}</textarea>
            </div>

            <!-- Objetivo General -->
            <div class="mb-4">
                <label for="objetivo_general" class="block text-sm font-medium text-gray-700">Objetivo General</label>
                <textarea name="objetivo_general" id="objetivo_general" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('objetivo_general') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Guardar y Continuar</button>
            </div>
        </form>
    </div>

    <script>
        function addColaborador() {
            const container = document.getElementById('colaboradores');
            
            // Crear un contenedor para cada fila de input
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2';

            // Crear el input
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'colaboradores[]';
            input.className = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm';
            input.placeholder = 'Nombre del colaborador';

         

            // Crear botón para eliminar
            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'p-2 bg-red-500 text-white rounded-full shadow hover:bg-red-600';
            deleteButton.innerHTML = '<span class="text-lg font-bold">-</span>';
            deleteButton.onclick = function() {
                removeColaborador(row);
            };

            // Agregar input y botón de eliminar a la fila
            row.appendChild(input);
            row.appendChild(deleteButton);

            // Agregar la fila completa al contenedor principal
            container.appendChild(row);
        }

        function removeColaborador(row) {
            const container = document.getElementById('colaboradores');
            container.removeChild(row);
        }
    </script>
@endsection
