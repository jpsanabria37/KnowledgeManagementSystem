<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Base de Conocimientos SENA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        /* Encabezado con logo y título */
        .header {
            text-align: center;
            padding: 2rem;
            background-color: #006a4e;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 0.5rem;
            animation: fadeIn 1s ease-in-out;
        }
        .header h1 {
            font-size: 2.5rem;
            margin: 0.5rem 0;
            animation: slideIn 1s ease-in-out;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 3rem;
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Tarjetas de contenido */
        .button-group {
            margin: 1.5rem 0;
        }
        .button-group a {
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            background-color: #ff6600; /* Botones en color naranja */
            transition: background-color 0.3s;
            margin: 0 0.5rem;
        }
        .button-group a:hover {
            background-color: #e65500; /* Color al pasar el cursor */
        }

        /* Animación para el contenido adicional */
        .info-section {
            max-width: 800px;
            margin-top: 2rem;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: slideInUp 1s ease-in-out;
        }

        /* Pie de página */
        .footer {
            margin-top: 2rem;
            color: #888;
            font-size: 0.9rem;
            text-align: center;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Encabezado con el logo y título -->
    <header class="header">
        <img src="{{ asset('img/logo_sena_2.png') }}" alt="Logo del SENA"> <!-- Aquí agregamos el logo -->
        <h1>Bienvenido a la Base de Conocimientos del SENA</h1>
        <p>Esta plataforma permite a los aprendices crear, gestionar y colaborar en anteproyectos dentro de los semilleros del SENA.</p>
    </header>

    <!-- Contenedor principal -->
    <div class="container">
        <div class="button-group">
            <a href="{{ route('login') }}">Iniciar Sesión</a>
            <a href="{{ route('register') }}">Registrarse</a>
        </div>

        <div class="info-section">
            <h2>¿Qué es un Semillero de Investigación?</h2>
            <p>
                Los semilleros de investigación son espacios académicos donde los aprendices pueden explorar, crear y compartir conocimiento a través de proyectos de investigación.
                <strong>¡Únete y aporta al desarrollo del conocimiento en el SENA!</strong>
            </p>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="footer">
        <p>© {{ date('Y') }} Servicio Nacional de Aprendizaje - SENA. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
