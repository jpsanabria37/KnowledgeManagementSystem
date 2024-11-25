@extends('adminlte::page')

@section('title', 'Crear Semillero')

@section('content_header')
    <h1>Crear Semillero</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario de Creación de Semillero</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('semilleros.store') }}" method="POST">
                @csrf
                <!-- Nombre del Semillero -->
                <div class="form-group">
                    <label for="nombre_semillero">Nombre del Semillero:</label>
                    <input type="text" name="nombre_semillero" id="nombre_semillero" class="form-control" placeholder="Ingrese el nombre del semillero" required autocomplete="off">
                </div>

                <!-- Lider del Semillero -->
                <div class="form-group">
                    <label for="lider_semillero">Líder del Semillero:</label>
                    <input type="text" name="lider_semillero" id="lider_semillero" class="form-control" placeholder="Ingrese el nombre del líder del semillero" autocomplete="off">
                </div>

                <!-- Seleccionar Grupo y Línea de Investigación -->
                <div class="form-group">
                    <label for="grupo_linea_id">Seleccionar Grupo y Línea de Investigación:</label>
                    <select name="grupo_linea_id" id="grupo_linea_id" class="form-control" required>
                        @foreach($grupos as $grupo)
                            <optgroup label="Grupo: {{ $grupo->nombre_grupo }}">
                                @foreach($grupo->lineas as $linea)
                                    <option value="{{ $linea->pivot->id }}">
                                        Línea: {{ $linea->nombre_linea }} (Grupo: {{ $grupo->nombre_grupo }})
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <!-- Botón para crear el semillero -->
                <button type="submit" class="btn btn-primary">Crear Semillero</button>
            </form>
        </div>
    </div>
@endsection
