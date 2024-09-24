@extends('adminlte::page')

@section('title', 'Listado de Centros de Formación')

@section('content_header')
    <h1>Gestión de Centros de Formación</h1>
@stop

@section('content')
    <div class="container">
        <!-- Mostrar mensajes de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Caja principal con la tabla de centros -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Centros</h3>

                <!-- Botón para agregar un nuevo centro -->
                <div class="card-tools">
                    <a href="{{ route('centros.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Nuevo Centro
                    </a>
                </div>
            </div>

            <!-- Cuerpo de la tarjeta -->
            <div class="card-body">
                <!-- Formulario de búsqueda -->
                <form method="GET" action="{{ route('centros.index') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o regional..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Tabla de Centros -->
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Centro</th>
                        <th>Regional</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($centros as $centro)
                        <tr>
                            <td>{{ $centro->id }}</td>
                            <td>{{ $centro->nombre_centro }}</td>
                            <td>{{ $centro->regional->nombre_regional }}</td> <!-- Mostrar el nombre de la regional asociada -->
                            <td>
                                <!-- Botón para editar -->
                                <a href="{{ route('centros.edit', $centro->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Formulario para eliminar -->
                                <form action="{{ route('centros.destroy', $centro->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este centro?')">
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
                    {{ $centros->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
