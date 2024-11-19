<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto PDF</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.5;
        }

        /* Header */
        .header {
            background-color: #00A859; /* SENA Green */
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        .header img {
            max-height: 80px;
            margin-top: 10px;
        }

        /* Section Container */
        .section {
            margin: 20px;
            padding: 20px;
            border: 2px solid #00A859;
            border-radius: 10px;
            background-color: #F4F4F4;
        }

        .section h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #00A859;
            border-bottom: 2px solid #00A859;
            padding-bottom: 5px;
        }

        .section p, .section ul {
            font-size: 14px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #00A859;
            color: white;
            text-align: left;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 30px;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }

        /* Highlight box */
        .highlight {
            background-color: #E8F5E9;
            padding: 10px;
            border-left: 4px solid #00A859;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <h1>Anteproyecto: {{ $anteproyecto->titulo }}</h1>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2d/Logo_SENA.svg/512px-Logo_SENA.svg.png" alt="Logo SENA">
    </div>

    <!-- Descripción -->
    <div class="section">
        <h2>Descripción</h2>
        <p class="highlight">{{ $anteproyecto->descripcion }}</p>
    </div>

    <!-- Justificación -->
    <div class="section">
        <h2>Justificación</h2>
        <p>{{ $anteproyecto->justificacion }}</p>
    </div>

    <!-- Objetivo General -->
    <div class="section">
        <h2>Objetivo General</h2>
        <p>{{ $anteproyecto->objetivo_general }}</p>
    </div>

    <!-- Objetivos Específicos -->
    <div class="section">
        <h2>Objetivos Específicos</h2>
        <ul>
            @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
                <li>{{ $objetivo->nombre }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Actividades -->
    <div class="section">
        <h2>Actividades por Objetivo</h2>
        @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
            <h3 style="color: #007B3E; font-size: 16px; margin-top: 10px;">{{ $objetivo->nombre }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>Actividad</th>
                        <th>Responsable</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($objetivo->actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->nombre }}</td>
                            <td>{{ $actividad->responsable }}</td>
                            <td>{{ $actividad->fecha_inicio }}</td>
                            <td>{{ $actividad->fecha_fin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>

    <!-- Metodología -->
    <div class="section">
        <h2>Metodología</h2>
        <p>{{ $anteproyecto->metodologia }}</p>
    </div>

    <!-- Información Adicional -->
    <div class="section">
        <h2>Información Adicional</h2>
        <ul>
            <li><strong>Semillero:</strong> {{ $anteproyecto->semillero->nombre_semillero ?? 'No especificado' }}</li>
            <li><strong>Grupo de Investigación:</strong> {{ $anteproyecto->semillero->grupoLinea->grupoInvestigacion->nombre_grupo ?? 'No especificado' }}</li>
            <li><strong>Centro:</strong> {{ $anteproyecto->semillero->grupoLinea->grupoInvestigacion->centro->nombre_centro ?? 'No especificado' }}</li>
        </ul>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>Documento generado automáticamente el {{ now()->format('d/m/Y') }}</p>
        <p>SENA - Servicio Nacional de Aprendizaje</p>
    </div>
</body>
</html>
