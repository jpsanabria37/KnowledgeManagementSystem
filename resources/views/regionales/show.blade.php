{{-- resources/views/regionales/show.blade.php --}}
@extends('adminlte::page')

@section('title', 'Detalle de la Regional')

@section('content_header')
    <h1>Detalles de la Regional: {{ $regional->nombre }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        {{-- Información básica de la Regional --}}
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Información de la Regional</h3>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $regional->nombre }}</p>
                <p><strong>Ubicación:</strong> {{ $regional->ubicacion }}</p>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('regionales.edit', $regional->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar Regional
                    </a>
                </div>
            </div>
        </div>

        {{-- Lista de Centros de Formación --}}
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title">Centros de Formación en {{ $regional->nombre }}</h3>
                <div class="card-tools">
                    <a href="{{ route('centros.create', ['regional_id' => $regional->id]) }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Agregar Centro de Formación
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($regional->centros->isEmpty())
                    <p>No hay centros de formación asociados a esta regional.</p>
                @else
                    @foreach ($regional->centros as $centro)
                        <div class="mb-4">
                            <h5><strong>Centro de Formación:</strong> {{ $centro->nombre }} (Líder: {{ $centro->lider_investigacion }})</h5>

                            {{-- Mostrar Grupos de Investigación dentro del centro --}}
                            @if($centro->grupos->isEmpty())
                                <p>No hay grupos de investigación asociados a este centro.</p>
                            @else
                                @foreach ($centro->grupos as $grupo)
                                    <div class="ml-3 mb-3">
                                        <h6><strong>Grupo de Investigación:</strong> {{ $grupo->nombre }} (Línea: {{ $grupo->linea->nombre }})</h6>

                                        {{-- Mostrar Proyectos asociados al grupo --}}
                                        @if($grupo->proyectos->isEmpty())
                                            <p>No hay proyectos asociados a este grupo.</p>
                                        @else
                                            <ul>
                                                @foreach ($grupo->proyectos as $proyecto)
                                                    <li><strong>Proyecto:</strong> {{ $proyecto->nombre }} - {{ $proyecto->descripcion }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Lista de Líneas de Investigación y Semilleros --}}
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="card-title">Líneas de Investigación y Semilleros</h3>
            </div>
            <div class="card-body">
                @if($regional->centros->isEmpty())
                    <p>No hay centros de formación asociados a esta regional.</p>
                @else
                    @foreach ($regional->centros as $centro)
                        @foreach ($centro->lineas as $linea)
                            <div class="mb-4">
                                <h5><strong>Línea de Investigación:</strong> {{ $linea->nombre }}</h5>

                                {{-- Mostrar Semilleros de Investigación --}}
                                @if($linea->semilleros->isEmpty())
                                    <p>No hay semilleros asociados a esta línea de investigación.</p>
                                @else
                                    <ul>
                                        @foreach ($linea->semilleros as $semillero)
                                            <li><strong>Semillero:</strong> {{ $semillero->nombre }} (Líder: {{ $semillero->lider_semillero }})</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop
