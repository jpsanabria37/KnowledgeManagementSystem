@extends('adminlte::page')

@section('title', 'Detalles del Anteproyecto')

@section('content_header')
    <h1>Detalles del Anteproyecto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Información del Anteproyecto</h3>
            <div class="card-tools">
                <!-- Botón para editar el anteproyecto -->
                <a href="{{ route('anteproyectos.edit', $anteproyecto->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Editar
                </a>

                <!-- Botón para eliminar el anteproyecto -->
                <form action="{{ route('anteproyectos.destroy', $anteproyecto->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este anteproyecto?');">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <!-- Mostrar los detalles del anteproyecto -->
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Título:</strong> {{ $anteproyecto->titulo }}</p>
                    <p><strong>Descripción:</strong> {{ $anteproyecto->descripcion }}</p>
                    <p><strong>Objetivo General:</strong> {{ $anteproyecto->objetivo_general }}</p>
                    <p><strong>Objetivos Específicos:</strong> {{ $anteproyecto->objetivos_especificos }}</p>
                    <p><strong>Justificación:</strong> {{ $anteproyecto->justificacion }}</p>
                    <p><strong>Alcance:</strong> {{ $anteproyecto->alcance ?? 'No especificado' }}</p>
                    <p><strong>Metodología:</strong> {{ $anteproyecto->metodologia ?? 'No especificada' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Cronograma:</strong> {{ $anteproyecto->cronograma ?? 'No especificado' }}</p>
                    <p><strong>Realizado por:</strong> {{ $anteproyecto->realizado_por }}</p>
                    <p><strong>Semillero:</strong> {{ $anteproyecto->semillero->nombre_semillero }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge badge-{{ $anteproyecto->estado == 'aprobado' ? 'success' : ($anteproyecto->estado == 'rechazado' ? 'danger' : 'warning') }}">
                            {{ ucfirst($anteproyecto->estado) }}
                        </span>
                    </p>
                    <p><strong>Fecha de Inicio:</strong> {{ $anteproyecto->fecha_inicio ?? 'No especificada' }}</p>
                    <p><strong>Fecha de Finalización:</strong> {{ $anteproyecto->fecha_fin ?? 'No especificada' }}</p>
                </div>
            </div>

            <!-- Mostrar opciones para el PDF -->
            @if($anteproyecto->archivo_pdf)
                <p><strong>Descargar PDF:</strong> 
                    <a href="{{ asset('storage/' . $anteproyecto->archivo_pdf) }}" class="btn btn-success" target="_blank">
                        <i class="fas fa-file-pdf"></i> Ver y Descargar PDF
                    </a>
                </p>
            @else
                <!-- Opción para generar y previsualizar el PDF -->
                <p><strong>PDF no disponible:</strong> 
                    <a href="{{ route('anteproyectos.generate_pdf', $anteproyecto->id) }}" class="btn btn-info" target="_blank">
                        <i class="fas fa-file-pdf"></i> Generar y Previsualizar PDF
                    </a>
                </p>
            @endif

            <!-- Mostrar el Póster si está disponible -->
            @if($anteproyecto->archivo_poster)
                <p><strong>Descargar Póster:</strong> 
                    <a href="{{ asset('storage/' . $anteproyecto->archivo_poster) }}" class="btn btn-info" target="_blank">
                        <i class="fas fa-file-image"></i> Descargar Póster
                    </a>
                </p>
            @else
                <p><strong>Póster:</strong> No disponible</p>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Botón para regresar a la lista de anteproyectos -->
    <a href="{{ route('anteproyectos.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver a la lista
    </a>
@stop
