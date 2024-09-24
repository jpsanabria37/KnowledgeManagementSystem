<!-- resources/views/semilleros/create.blade.php -->
@extends('adminlte::page')

@section('title', 'Nuevo Semillero')

@section('content_header')
    <h1>Nuevo Semillero</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('semilleros.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="linea_investigacion_id">Línea de Investigación</label>
                <select name="linea_investigacion_id" class="form-control" required>
                    <option value="">Seleccionar Línea</option>
                    @foreach ($lineas as $linea)
                        <option value="{{ $linea->id }}">{{ $linea->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@stop
