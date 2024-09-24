@extends('adminlte::page')

@section('title', 'Editar Centro de Formación')

@section('content_header')
    <h1>Editar Centro de Formación</h1>
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

        <!-- Formulario para editar el centro -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actualizar Información del Centro</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('centros.update', $centro->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Método PUT para la actualización -->

                    <div class="form-group">
                        <label for="nombre_centro">Nombre del Centro</label>
                        <input type="text" name="nombre_centro" class="form-control" id="nombre_centro" value="{{ old('nombre_centro', $centro->nombre_centro) }}" placeholder="Ingrese el nombre del centro" required>
                    </div>

                    <div class="form-group">
                        <label for="regional_id">Regional Asociada</label>
                        <select name="regional_id" id="regional_id" class="form-control" required>
                            <option value="">Seleccione una regional</option>
                            @foreach ($regionales as $regional)
                                <option value="{{ $regional->id }}" {{ old('regional_id', $centro->regional_id) == $regional->id ? 'selected' : '' }}>
                                    {{ $regional->nombre_regional }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <a href="{{ route('centros.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
