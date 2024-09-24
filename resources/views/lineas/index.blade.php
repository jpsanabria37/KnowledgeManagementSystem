@extends('adminlte::page')

@section('title', 'Listado de Líneas de Investigación')

@section('content_header')
    <h1>Gestión de Líneas de Investigación</h1>
@stop

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Líneas de Investigación</h3>

                <div class="card-tools">
                    <a href="{{ route('lineas.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Nueva Línea
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Línea</th>
                        <th>Centro Asociado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($lineas as $linea)
                        <tr>
                            <td>{{ $linea->id }}</td>
                            <td>{{ $linea->nombre_linea }}</td>
                            <td>{{ $linea->centro ? $linea->centro->nombre_centro : 'No asignado' }}</td> <!-- Mostrar el centro asociado o "No asignado" -->
                            <td>
                                <a href="{{ route('lineas.edit', $linea->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('lineas.destroy', $linea->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta línea?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $lineas->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
