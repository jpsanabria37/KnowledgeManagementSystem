@extends('adminlte::page')

@section('title', 'Editar Regional')

@section('content_header')
    <h1>Editar Regional</h1>
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

        <!-- Formulario para editar la regional -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actualizar Información de la Regional</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('regionales.update', $regional->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Necesario para el método PUT de actualización -->

                    <div class="form-group">
                        <label for="nombre_regional">Nombre de la Regional</label>
                        <input type="text" name="nombre_regional" class="form-control" id="nombre_regional" value="{{ old('nombre_regional', $regional->nombre_regional) }}" placeholder="Ingrese el nombre de la regional" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion_regional">Descripción (Opcional)</label>
                        <textarea name="descripcion_regional" class="form-control" id="descripcion_regional" rows="3" placeholder="Descripción opcional">{{ old('descripcion_regional', $regional->descripcion_regional) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="ubicacion_regional">Ubicación de la Regional</label>
                        <input type="text" name="ubicacion_regional" class="form-control" id="ubicacion_regional" value="{{ old('ubicacion_regional', $regional->ubicacion_regional) }}" placeholder="Ingrese la ubicación de la regional" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <a href="{{ route('regionales.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
