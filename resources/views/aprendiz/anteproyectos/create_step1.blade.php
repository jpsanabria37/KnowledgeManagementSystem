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
                <div id="colaboradores">
                    <input type="text" name="colaboradores[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nombre del colaborador" required>
                </div>
                <button type="button" onclick="addColaborador()" class="text-indigo-500 hover:underline mt-2">Agregar colaborador</button>
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
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'colaboradores[]';
            input.className = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm';
            input.placeholder = 'Nombre del colaborador';
            container.appendChild(input);
        }
    </script>
@endsection
