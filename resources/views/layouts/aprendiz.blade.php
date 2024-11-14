<!-- resources/views/layouts/aprendiz.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aprendiz | SENA</title>
    
    <!-- Cargar estilos con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fuente adicional y CSS para íconos -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar de navegación -->
        <aside class="w-1/4 bg-green-800 text-white p-6 shadow-lg">
            <div class="mb-8">
                <h2 class="text-2xl font-bold">Panel del Aprendiz</h2>
                <p class="text-green-300 text-sm">Área de trabajo</p>
            </div>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('aprendiz.dashboard') }}" class="flex items-center p-2 text-white hover:bg-green-700 rounded-md">
                            <i class="fas fa-home mr-2"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('aprendiz.semilleros.index') }}" class="flex items-center p-2 text-white hover:bg-green-700 rounded-md">
                            <i class="fas fa-seedling mr-2"></i> Ver Semilleros
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('aprendiz.anteproyectos.createStep1') }}" class="flex items-center p-2 text-white hover:bg-green-700 rounded-md">
                            <i class="fas fa-plus mr-2"></i> Crear Anteproyecto
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('aprendiz.anteproyectos.index') }}" class="flex items-center p-2 text-white hover:bg-green-700 rounded-md">
                            <i class="fas fa-folder mr-2"></i> Mis Anteproyectos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="flex items-center p-2 text-white hover:bg-green-700 rounded-md"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-8 bg-gray-50">
            <header class="mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Bienvenido, {{ auth()->user()->name }}</h1>
                <p class="text-gray-600">Esta es tu área de trabajo en la plataforma del SENA.</p>
            </header>
            
            <!-- Contenido dinámico -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
