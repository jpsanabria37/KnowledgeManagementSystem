@extends('adminlte::page')

@section('title', 'Detalles del Grupo de Investigación')

@section('content_header')
    <h1>Detalles del Grupo de Investigación</h1>
@stop

@section('content')


<div class="container-fluid">
    <div class="row">
        <!-- Información general del Grupo -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Información del Grupo</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nombre del Grupo:</strong> {{ $grupo->nombre_grupo }}</p>
                    <p><strong>Líder de Investigación:</strong> {{ $grupo->lider_investigacion ?? 'No asignado' }}</p>
                </div>
            </div>
        </div>

        <!-- Información del Centro y Regional -->
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Centro y Regional</h3>
                </div>
                <div class="card-body">
                    <p><strong>Centro:</strong> {{ $grupo->centro->nombre_centro }}</p>
                    <p><strong>Regional:</strong> {{ $grupo->centro->regional->nombre_regional }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Líneas de Investigación y Semilleros Asociados -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Líneas de Investigación y Semilleros Asociados</h3>
                </div>
                <div class="card-body">
                @foreach($grupo->lineas as $linea)
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title"><strong>Línea de Investigación:</strong> {{ $linea->nombre }}</h5>
        </div>
        <div class="card-body">
            <!-- Acceder al semillero a través de la relación en GrupoLinea -->
            @php
                // Obtenemos la relación pivot (grupo_linea)
                $grupoLinea = \App\Models\GrupoLinea::where('grupo_id', $grupo->id)
                            ->where('linea_id', $linea->id)
                            ->first();
            @endphp

            <!-- Verificar si hay un semillero asociado -->
            @if($grupoLinea && $grupoLinea->semillero)
                <p><strong>Semillero Asociado:</strong> {{ $grupoLinea->semillero->nombre_semillero }}</p>
            @else
                <p><strong>Semillero:</strong> No tiene semillero asociado.</p>
            @endif
        </div>
    </div>
@endforeach


                </div>
            </div>
        </div>
    </div>
</div>

@stop
