@extends('adminlte::page')

@section('title', 'Crear Línea de Investigación')

@section('content_header')
    <h1>Crear Nueva Línea de Investigación</h1>
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

        <!-- Formulario para crear una nueva línea de investigación -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario de Nueva Línea de Investigación</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('lineas.store') }}" method="POST">
                    @csrf <!-- Token CSRF -->

                    <div class="form-group">
                        <label for="nombre_linea">Nombre de la Línea de Investigación</label>
                        <input type="text" name="nombre_linea" class="form-control" id="nombre_linea" value="{{ old('nombre_linea') }}" placeholder="Ingrese el nombre de la línea" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crear Línea</button>
                        <a href="{{ route('lineas.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
