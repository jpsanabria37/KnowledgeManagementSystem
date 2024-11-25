<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto PDF</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.5;
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

        /* Encabezado */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            background-color: white;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .header img {
            max-height: 40px;
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
            margin: 20px;
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

        .section p {
            font-size: 12px;
            text-align: justify;
        }
    </style>
</head>
<body>
    <!-- Encabezado con Logo -->
    <div class="header">
        <img src="{{ asset('img/logo_sena.png') }}" alt="Logo SENA">
    </div>

    <!-- Portada -->
    <div class="cover-page">
        <img src="{{ asset('img/logo_sena.png') }}" alt="Logo SENA">
        <h1>{{ $anteproyecto->titulo }}</h1>
        <p>
            Este documento, titulado "{{ $anteproyecto->titulo }}", ha sido desarrollado como parte del trabajo de investigación llevado a cabo por el semillero "{{ $anteproyecto->semillero->nombre_semillero ?? 'No especificado' }}", adscrito al grupo de investigación "{{ $anteproyecto->semillero->grupoLinea->grupoInvestigacion->nombre_grupo ?? 'No especificado' }}". El propósito de este anteproyecto es proporcionar una base estructurada para el desarrollo del proyecto de investigación en el marco del Centro "{{ $anteproyecto->semillero->grupoLinea->grupoInvestigacion->centro->nombre_centro ?? 'No especificado' }}", en línea con los objetivos del Servicio Nacional de Aprendizaje (SENA). Fecha de elaboración: {{ now()->format('d/m/Y') }}.
        </p>
    </div>

    <!-- Salto de página -->
    <div class="page-break"></div>

    <!-- Contenido del informe -->
    <div class="section">
        <h2>Descripción</h2>
        <p>{{ $anteproyecto->descripcion }}</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p class="page-number">Página </p>
    </div>
</body>
</html>
