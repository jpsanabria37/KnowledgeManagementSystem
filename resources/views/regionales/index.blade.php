@extends('adminlte::page')

@section('title', 'Listado de Regionales')

@section('content_header')
    <h1>Gestión de Regionales</h1>
@stop

@section('content')
    <div class="container">
        <!-- Mensaje de éxito si existe -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Caja principal con la tabla de regionales -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Regionales</h3>

                <!-- Botón para agregar una nueva regional -->
                <div class="card-tools">
                    <a href="{{ route('regionales.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Nueva Regional
                    </a>
                </div>
            </div>

            <!-- Cuerpo de la tarjeta -->
            <div class="card-body">
                <!-- Formulario de búsqueda -->
                <form method="GET" action="{{ route('regionales.index') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o ubicación..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Tabla de Regionales -->
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($regionales as $regional)
                        <tr>
                            <td>{{ $regional->id }}</td>
                            <td>{{ $regional->nombre_regional }}</td>
                            <td>{{ $regional->ubicacion_regional }}</td>
                            <td>
                                <!-- Botón para editar -->
                                <a href="{{ route('regionales.edit', $regional) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Formulario para eliminar -->
                                <form action="{{ route('regionales.destroy', $regional) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta regional?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    {{ $regionales->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
