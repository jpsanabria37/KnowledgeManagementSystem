@extends('adminlte::page')

@section('title', 'Listado de Grupos de Investigación')

@section('content_header')
    <h1>Gestión de Grupos de Investigación</h1>
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
                <h3 class="card-title">Listado de Grupos de Investigación</h3>

                <div class="card-tools">
                    <a href="{{ route('grupos.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Nuevo Grupo
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Grupo</th>
                        <th>Líder de Investigación</th>
                        <th>Centro</th>
                        <th>Línea de Investigación</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($grupos as $grupo)
                        <tr>
                            <td>{{ $grupo->id }}</td>
                            <td>{{ $grupo->nombre_grupo }}</td>
                            <td>{{ $grupo->lider_investigacion }}</td>
                            <td>{{ $grupo->centro->nombre_centro }}</td>
                            <td>{{ $grupo->linea->nombre_linea }}</td>
                            <td>
                                <a href="{{ route('grupos.edit', $grupo->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este grupo?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $grupos->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
