@extends('adminlte::page')

@section('title', 'Editar Anteproyecto')

@section('content_header')
    <h1>Editar Anteproyecto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario para editar el anteproyecto</h3>
        </div>
        <div class="card-body">
            <!-- Verificar si hay errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario de edición -->
            <form action="{{ route('anteproyectos.update', $anteproyecto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Campo Título -->
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $anteproyecto->titulo) }}" required>
                </div>

                <!-- Campo Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" required>{{ old('descripcion', $anteproyecto->descripcion) }}</textarea>
                </div>

                <!-- Campo Objetivo General -->
                <div class="form-group">
                    <label for="objetivo_general">Objetivo General</label>
                    <textarea name="objetivo_general" class="form-control" required>{{ old('objetivo_general', $anteproyecto->objetivo_general) }}</textarea>
                </div>

                <!-- Campo Objetivos Específicos -->
                <div class="form-group">
                    <label for="objetivos_especificos">Objetivos Específicos</label>
                    <textarea name="objetivos_especificos" class="form-control" required>{{ old('objetivos_especificos', $anteproyecto->objetivos_especificos) }}</textarea>
                </div>

                <!-- Campo Justificación -->
                <div class="form-group">
                    <label for="justificacion">Justificación</label>
                    <textarea name="justificacion" class="form-control" required>{{ old('justificacion', $anteproyecto->justificacion) }}</textarea>
                </div>

                <!-- Campo Alcance -->
                <div class="form-group">
                    <label for="alcance">Alcance</label>
                    <textarea name="alcance" class="form-control">{{ old('alcance', $anteproyecto->alcance) }}</textarea>
                </div>

                <!-- Campo Metodología -->
                <div class="form-group">
                    <label for="metodologia">Metodología</label>
                    <textarea name="metodologia" class="form-control">{{ old('metodologia', $anteproyecto->metodologia) }}</textarea>
                </div>

                <!-- Campo Cronograma -->
                <div class="form-group">
                    <label for="cronograma">Cronograma</label>
                    <textarea name="cronograma" class="form-control">{{ old('cronograma', $anteproyecto->cronograma) }}</textarea>
                </div>

                <!-- Campo Realizado por -->
                <div class="form-group">
                    <label for="realizado_por">Realizado por</label>
                    <input type="text" name="realizado_por" class="form-control" value="{{ old('realizado_por', $anteproyecto->realizado_por) }}" required>
                </div>

                <!-- Campo Semillero -->
                <div class="form-group">
                    <label for="semillero_id">Semillero</label>
                    <select name="semillero_id" class="form-control" required>
                        @foreach($semilleros as $semillero)
                            <option value="{{ $semillero->id }}" {{ old('semillero_id', $anteproyecto->semillero_id) == $semillero->id ? 'selected' : '' }}>
                                {{ $semillero->nombre_semillero }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo Estado -->
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="en_proceso" {{ old('estado', $anteproyecto->estado) == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="aprobado" {{ old('estado', $anteproyecto->estado) == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                        <option value="rechazado" {{ old('estado', $anteproyecto->estado) == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                    </select>
                </div>

                <!-- Opción para generar o subir PDF -->
                <div class="form-group">
                    <label for="pdf_option">PDF del Anteproyecto</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="pdf_option" value="generate" class="form-check-input" id="pdf_generate" {{ old('pdf_option', 'generate') == 'generate' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pdf_generate">Generar PDF automáticamente</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="pdf_option" value="upload" class="form-check-input" id="pdf_upload" {{ old('pdf_option') == 'upload' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pdf_upload">Subir PDF manualmente</label>
                    </div>
                </div>

                <!-- Campo para subir PDF (visible solo si selecciona la opción de subir) -->
                <div class="form-group" id="upload_pdf_section" style="display: none;">
                    <label for="archivo_pdf">Subir PDF</label>
                    <input type="file" name="archivo_pdf" class="form-control">
                </div>

                <!-- Campo para subir el póster -->
                <div class="form-group">
                    <label for="archivo_poster">Subir Póster</label>
                    <input type="file" name="archivo_poster" class="form-control" accept=".pdf,.jpg,.png">
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>

    <!-- Script para manejar la visibilidad del campo de PDF -->
    <script>
        document.querySelectorAll('input[name="pdf_option"]').forEach(function(elem) {
            elem.addEventListener('change', function() {
                var uploadSection = document.getElementById('upload_pdf_section');
                if (this.value === 'upload') {
                    uploadSection.style.display = 'block';
                } else {
                    uploadSection.style.display = 'none';
                }
            });
        });

        // Mostrar el campo si se seleccionó la opción "upload" previamente
        if (document.querySelector('input[name="pdf_option"]:checked').value === 'upload') {
            document.getElementById('upload_pdf_section').style.display = 'block';
        }
    </script>
@stop
