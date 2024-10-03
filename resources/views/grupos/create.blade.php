@extends('adminlte::page')

@section('title', 'Crear Grupo de Investigación')

@section('content_header')
    <h1>Crear Nuevo Grupo de Investigación</h1>
@stop

@section('content')
    <div class="container">
        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear un nuevo grupo de investigación -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario de Nuevo Grupo de Investigación</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('grupos.store') }}" method="POST">
                    @csrf <!-- Token de seguridad CSRF -->

                    <div class="form-group">
                        <label for="nombre_grupo">Nombre del Grupo de Investigación</label>
                        <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" value="{{ old('nombre_grupo') }}" placeholder="Ingrese el nombre del grupo" required>
                    </div>

                    <div class="form-group">
                        <label for="lider_investigacion">Líder de Investigación (Opcional)</label>
                        <input type="text" name="lider_investigacion" class="form-control" id="lider_investigacion" value="{{ old('lider_investigacion') }}" placeholder="Ingrese el nombre del líder">
                    </div>

                    <div class="form-group">
                        <label for="centro_id">Centro Asociado</label>
                        <select name="centro_id" id="centro_id" class="form-control" required>
                            <option value="">Seleccione un centro</option>
                            @foreach ($centros as $centro)
                                <option value="{{ $centro->id }}" {{ old('centro_id') == $centro->id ? 'selected' : '' }}>
                                    {{ $centro->nombre_centro }}
                                </option>
                            @endforeach
                        </select>
                    </div>       
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crear Grupo</button>
                        <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
