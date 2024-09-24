<!-- resources/views/semilleros/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Semilleros')

@section('content_header')
    <h1>Semilleros</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('semilleros.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus-circle"></i> Nuevo Semillero
        </a>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Línea de Investigación Asociada</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($semilleros as $semillero)
                <tr>
                    <td>{{ $semillero->id }}</td>
                    <td>{{ $semillero->nombre }}</td>
                    <td>{{ $semillero->lineaInvestigacion->nombre }}</td>
                    <td>
                        <a href="{{ route('semilleros.edit', $semillero) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('semilleros.destroy', $semillero) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $semilleros->links() }}
    </div>
@stop
