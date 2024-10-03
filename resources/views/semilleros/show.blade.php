@extends('adminlte::page')

@section('title', 'Detalles del Semillero')

@section('content_header')
    <h1>Detalles del Semillero</h1>
@endsection

@section('content')
    

    <div class="container">
  <div class="card">
        <div class="card-header">
            <h3 class="card-title">Información del Semillero</h3>
        </div>
        <div class="card-body">
            <!-- Información del Semillero -->
            <p><strong>Nombre:</strong> {{ $semillero->nombre_semillero }}</p>
            <p><strong>Líder:</strong> {{ $semillero->lider_semillero ?? 'No asignado' }}</p>

            <!-- Información del Grupo y Línea de Investigación -->
            <h4>Grupo y Línea de Investigación</h4>
            <p><strong>Grupo de Investigación:</strong> {{ $semillero->grupoLinea->grupo->nombre_grupo ?? 'No asignado' }}</p>
            <p><strong>Línea de Investigación:</strong> {{ $semillero->grupoLinea->linea->nombre_linea ?? 'No asignado' }}</p>

            <!-- Mostrar los Anteproyectos asociados -->
          
        </div>
    </div>
    <div class="card">
  
    <hr>
    <div class="card-header">
    <h2>Anteproyectos</h2>
    @if($semillero->anteproyectos->isEmpty())
        <p>No hay anteproyectos para este semillero.</p>
    @else
        <ul class="list-group">
            @foreach($semillero->anteproyectos as $anteproyecto)
                <li class="list-group-item">
                    <h5>{{ $anteproyecto->titulo }}</h5>
                    <p>{{ $anteproyecto->descripcion }}</p>
                    <a href="{{ route('anteproyectos.show', $anteproyecto->id) }}" class="btn btn-primary">Ver Anteproyecto</a>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('anteproyectos.create', ['semillero_id' => $semillero->id]) }}" class="btn btn-success mt-4">Formular Nuevo Anteproyecto</a>
</div>   
</div>
</div>
@endsection
