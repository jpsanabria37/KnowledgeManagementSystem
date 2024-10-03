@extends('adminlte::page')

@section('title', 'Editar Grupo de Investigación')

@section('content_header')
    <h1>Editar Grupo de Investigación</h1>
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

        <!-- Formulario para editar el grupo -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actualizar Información del Grupo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Para actualizar los datos -->

                    <div class="form-group">
                        <label for="nombre_grupo">Nombre del Grupo de Investigación</label>
                        <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" value="{{ old('nombre_grupo', $grupo->nombre_grupo) }}" placeholder="Ingrese el nombre del grupo" required>
                    </div>

                    <div class="form-group">
                        <label for="lider_investigacion">Líder de Investigación (Opcional)</label>
                        <input type="text" name="lider_investigacion" class="form-control" id="lider_investigacion" value="{{ old('lider_investigacion', $grupo->lider_investigacion) }}" placeholder="Ingrese el nombre del líder">
                    </div>

                    <div class="form-group">
                        <label for="centro_id">Centro Asociado</label>
                        <select name="centro_id" id="centro_id" class="form-control" required>
                            <option value="">Seleccione un centro</option>
                            @foreach ($centros as $centro)
                                <option value="{{ $centro->id }}" {{ old('centro_id', $grupo->centro_id) == $centro->id ? 'selected' : '' }}>
                                    {{ $centro->nombre_centro }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
        <label for="lineas">Líneas de Investigación</label>
        @foreach($lineas as $linea)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="lineas[]" value="{{ $linea->id }}"
                       @if(in_array($linea->id, $grupo->lineas->pluck('id')->toArray())) checked @endif>
                <label class="form-check-label">
                    {{ $linea->nombre_linea }}
                </label>
            </div>
        @endforeach
    </div>

                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
