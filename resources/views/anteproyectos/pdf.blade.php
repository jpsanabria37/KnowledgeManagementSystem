<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto - {{ $anteproyecto->titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }
        h1, h2, h3 {
            text-align: center;
            color: #333;
        }
        p {
            margin: 5px 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 16px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .badge {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        .badge-warning {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>
<body>

    <h1>Anteproyecto: {{ $anteproyecto->titulo }}</h1>

    <!-- Información principal del anteproyecto -->
    <div class="section">
        <div class="section-title">Detalles del Anteproyecto</div>
        <p><strong>Título:</strong> {{ $anteproyecto->titulo }}</p>
        <p><strong>Descripción:</strong> {{ $anteproyecto->descripcion }}</p>
        <p><strong>Objetivo General:</strong> {{ $anteproyecto->objetivo_general }}</p>
        <p><strong>Objetivos Específicos:</strong> {{ $anteproyecto->objetivos_especificos }}</p>
        <p><strong>Justificación:</strong> {{ $anteproyecto->justificacion }}</p>
    </div>

    <!-- Metodología y Alcance -->
    <div class="section">
        <div class="section-title">Metodología y Alcance</div>
        <p><strong>Metodología:</strong> {{ $anteproyecto->metodologia ?? 'No especificada' }}</p>
        <p><strong>Alcance:</strong> {{ $anteproyecto->alcance ?? 'No especificado' }}</p>
        <p><strong>Cronograma:</strong> {{ $anteproyecto->cronograma ?? 'No especificado' }}</p>
    </div>

    <!-- Información adicional -->
    <div class="section">
        <div class="section-title">Información Adicional</div>
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

</body>
</html>
