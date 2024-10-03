@extends('adminlte::page')

@section('title', 'Semilleros')

@section('content_header')
    <h1>Semilleros</h1>
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Lista de Semilleros</h4>
        <a href="{{ route('semilleros.create') }}" class="btn btn-success">Nuevo Semillero</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Líder</th>
                <th>Grupo de Investigación</th>
                <th>Línea de Investigación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semilleros as $semillero)
                <tr>
                    <td>{{ $semillero->id }}</td>
                    <td>{{ $semillero->nombre_semillero }}</td>
                    <td>{{ $semillero->lider_semillero }}</td>
                    <!-- Mostrar el Grupo de Investigación asociado -->
                    <td>{{ $semillero->grupoLinea->grupo->nombre_grupo ?? 'No asignado' }}</td>
                    
                    <!-- Mostrar la Línea de Investigación asociada -->
                    <td>{{ $semillero->grupoLinea->linea->nombre_linea ?? 'No asignado' }}</td>
                    
                    <td>
                    <a href="{{ route('semilleros.show', $semillero->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('semilleros.edit', $semillero->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('semilleros.destroy', $semillero->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este semillero?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
