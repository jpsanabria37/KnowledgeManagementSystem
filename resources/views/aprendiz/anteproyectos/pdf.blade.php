<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto PDF</title>
    <style>
        
        @page {
            margin: 100px 25px;
        }

        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.5;
        }


        main {
            margin-top: 80px; /* Reservar espacio para el encabezado */
            margin-bottom: 50px; /* Reservar espacio para el pie de página */
        }

        /* Portada */
        .cover-page {
            text-align: center;
            margin: 100px auto;
            padding: 0 40px;
        }

        .cover-page h1 {
            font-size: 20px;
            color: #00A859;
            font-weight: bold;
        }

        .cover-page p {
            font-size: 14px;
            color: #333;
            text-align: justify;
            margin-top: 30px;
            line-height: 1.8;
        }

        .cover-page img {
            max-height: 100px;
            margin-bottom: 30px;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 50px; /* Altura del encabezado */
            text-align: center;
            padding: 10px 0;
        }

        .header img {
            max-height: 40px; /* Asegura que el logo no sea demasiado grande */
        }


        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
        }

        .footer .page-number::after {
            content: counter(page);
        }

        /* Page break */
        .page-break {
            page-break-before: always;
        }

        /* Content styling */
        .section {
            margin: 50px;
            padding: 20px;
            border: 2px solid #00A859;
            border-radius: 10px;
            background-color: #F4F4F4;
        }

        .section h2 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #00A859;
            border-bottom: 1px solid #00A859;
            padding-bottom: 5px;
        }

        h3 {
            font-size: 15px;
            margin-bottom: 10px;
            color: #00A859;
        }


        .section p {
            font-size: 12px;
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 12px;
        }

        table th, table td {
            border: 1px solid #00A859; /* Bordes verdes para consistencia */
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #00A859; /* Fondo verde */
            color: white; /* Texto blanco */
            font-weight: bold;
            text-transform: uppercase; /* Mayúsculas para énfasis */
        }

        table tr:nth-child(even) {
            background-color: #E8F5E9; /* Fila alternada en verde claro */
        }

        table tr:nth-child(odd) {
            background-color: #F4F4F4; /* Fila alternada en gris claro */
        }

        table tr:hover {
            background-color: #C8E6C9; /* Resaltado al pasar el mouse */
        }

        table td {
            color: #333;
        }

        /* Table Title */
        .table-title {
            font-size: 14px;
            color: #00A859;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0 5px;
        }

        /* Contenedor del producto */
        .producto-container {
            margin-top: 20px;
            padding: 15px;
            border: 2px solid #00A859; /* Borde verde */
            border-radius: 8px;
            background-color: #F4F4F4; /* Fondo claro */
        }

        /* Título del producto */
        .producto-titulo {
            font-size: 18px;
            color: #007B3E; /* Verde oscuro */
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
            text-align: left;
            border-bottom: 2px solid #00A859; /* Línea de énfasis */
            padding-bottom: 5px;
        }

        /* Descripción del producto */
        .producto-descripcion {
            font-size: 14px;
            color: #555; /* Gris para lectura más suave */
            text-align: justify;
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Encabezado con Logo -->
    <div class="header">
        <img src="{{ public_path('img/logo_sena.png') }}" alt="Logo SENA">
    </div>

    <!-- Portada -->
    <div class="cover-page">
        <img src="{{ public_path('img/logo_sena.png') }}" alt="Logo SENA">
        <h1>{{ $anteproyecto->titulo }}</h1>
        <p>
            Este documento, titulado "{{ $anteproyecto->titulo }}", ha sido desarrollado como parte del trabajo de investigación llevado a cabo por el semillero "{{ $anteproyecto->semillero->nombre_semillero ?? 'No especificado' }}", adscrito al grupo de investigación "{{ $anteproyecto->semillero->grupoLinea->grupoInvestigacion->nombre_grupo ?? 'No especificado' }}". El propósito de este anteproyecto es proporcionar una base estructurada para el desarrollo del proyecto de investigación en el marco del Centro "{{ $anteproyecto->semillero->grupoLinea->grupoInvestigacion->centro->nombre_centro ?? 'No especificado' }}", en línea con los objetivos del Servicio Nacional de Aprendizaje (SENA). Fecha de elaboración: {{ now()->format('d/m/Y') }}.
        </p>
        <p>
             Autor:{{ $anteproyecto->creador->name ?? 'No especificado' }} {{ $anteproyecto->creador->ficha }}  {{ $anteproyecto->creador->programa}}<br>
            Colaboradores:{{ implode(', ', $anteproyecto->colaboradores ?? ['No especificados']) }}<br>
                    <!-- Detalles del Semillero, Grupo y Centro -->
        @if($anteproyecto->semillero)
               {{ $anteproyecto->semillero->nombre_semillero }}
  
        @endif

        @if($anteproyecto->semillero && $anteproyecto->semillero->grupoLinea->grupo->nombre_grupo)
               {{ $anteproyecto->semillero->grupoLinea->grupo->nombre_grupo }}

        @endif

        @if($anteproyecto->semillero && $anteproyecto->semillero->grupoLinea->grupo->centro)
               {{ $anteproyecto->semillero->grupoLinea->grupo->centro->nombre_centro }} - 
                   {{ $anteproyecto->semillero->grupoLinea->grupo->centro->regional->nombre_regional }}
               

        @endif
    </p>

        <!-- Creador -->

    </div>

    <!-- Salto de página -->
    <div class="page-break"></div>

    <main>
        <div class="section">
            <h2>Descripción</h2>
            <p>{{ $anteproyecto->descripcion }}</p>

            <h2>Justificación</h2>
            <p>{{ $anteproyecto->justificacion }}</p>

            <h2>Objetivo General</h2>
            <p>{{ $anteproyecto->objetivo_general }}</p>

            <h2>Objetivos Específicos</h2>
            <p>
                @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
                    <p> - {{ $objetivo->nombre }}</p>
                @endforeach
            </p>

            <h2>Productos y Actividades por Objetivo</h2>
            @foreach ($anteproyecto->objetivosEspecificos as $objetivo)
                <div class="producto-container">
                    <h3 class="producto-titulo">{{ $objetivo->nombre }}</h3>
                    <p class="producto-descripcion">{{ $objetivo->recursos }}</p>
                </div>
                @foreach ($objetivo->productos as $producto)
                    <h3 >{{ $producto->nombre }}</h3>
                    <p>{{ $producto->descripcion }}</p>
                                <!-- Tabla de Actividades del Producto -->
                    <table>
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="table-title">Actividad</th>
                                <th class="table-title">Responsable</th>
                                <th class="table-title">Fecha Inicio</th>
                                <th class="table-title">Fecha Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($producto->actividades as $actividad)
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
            @endforeach

            <h2>Metodología</h2>
            <p>{{ $anteproyecto->metodologia }}</p>


            <h2>Alcance</h2>
            <p>{{ $anteproyecto->alcance }}</p>
        </div>
    </main>

    <!-- Footer -->
    <div class="footer">
        <p class="page-number">Página </p>
    </div>
</body>
</html>
