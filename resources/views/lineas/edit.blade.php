@extends('adminlte::page')

@section('title', 'Editar Línea de Investigación')

@section('content_header')
    <h1>Editar Línea de Investigación</h1>
@stop

@section('content')
    <div class="container">
        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para editar la línea de investigación -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actualizar Información de la Línea</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('lineas.update', $linea->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Este es el método para actualizar -->

                    <div class="form-group">
                        <label for="nombre_linea">Nombre de la Línea de Investigación</label>
                        <input type="text" name="nombre_linea" class="form-control" id="nombre_linea" value="{{ old('nombre_linea', $linea->nombre_linea) }}" placeholder="Ingrese el nombre de la línea" required>
                    </div>

                    <div class="form-group">
                        <label for="id_centro">Centro Asociado</label>
                        <select name="id_centro" id="id_centro" class="form-control" required>
                            <option value="">Seleccione un centro</option>
                            @foreach ($centros as $centro)
                                <option value="{{ $centro->id }}" {{ old('id_centro', $linea->id_centro) == $centro->id ? 'selected' : '' }}>
                                    {{ $centro->nombre_centro }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <a href="{{ route('lineas.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
