@extends('adminlte::page')

@section('title', 'Lista de Anteproyectos')

@section('content_header')
    <h1>Lista de Anteproyectos</h1>
@stop

@section('content')
    <!-- Verificar si hay un mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Anteproyectos</h3>
            <div class="card-tools">
                <a href="{{ route('anteproyectos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Crear Anteproyecto
                </a>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <!-- Estilos mejorados para la tabla -->
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Semillero</th>
                        <th>Estado</th>
                        <th>Realizado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anteproyectos as $anteproyecto)
                    <tr>
                        <td>{{ $anteproyecto->titulo }}</td>
                        <td>{{ $anteproyecto->semillero->nombre_semillero }}</td>
                        <td>
                            <span class="badge badge-{{ $anteproyecto->estado == 'aprobado' ? 'success' : ($anteproyecto->estado == 'rechazado' ? 'danger' : 'warning') }}">
                                {{ ucfirst($anteproyecto->estado) }}
                            </span>
                        </td>
                        <td>{{ $anteproyecto->realizado_por }}</td>
                        <td>
                               <!-- Botón de Editar con ícono -->
                               <a href="{{ route('anteproyectos.show', $anteproyecto->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Ver
                            </a>
                            
                            <!-- Botón de Editar con ícono -->
                            <a href="{{ route('anteproyectos.edit', $anteproyecto->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            
                            <!-- Botón de Eliminar con ícono y confirmación -->
                            <form action="{{ route('anteproyectos.destroy', $anteproyecto->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este anteproyecto?');">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop
