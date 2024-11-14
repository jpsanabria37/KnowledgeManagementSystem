<!-- resources/views/aprendiz/dashboard.blade.php -->
@extends('layouts.aprendiz')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800">Panel de Control</h2>
        <p class="text-gray-600 mt-2">Aquí puedes gestionar tus semilleros y anteproyectos.</p>
    </div>

    <!-- Secciones con enlaces rápidos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <a href="{{ route('aprendiz.semilleros.index') }}" class="block p-4 bg-blue-100 hover:bg-blue-200 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-blue-800">Ver Semilleros</h3>
            <p class="text-blue-700 mt-2">Explora todos los semilleros disponibles.</p>
        </a>
        <a href="{{ route('aprendiz.anteproyectos.createStep1') }}" class="block p-4 bg-green-100 hover:bg-green-200 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800">Crear Anteproyecto</h3>
            <p class="text-green-700 mt-2">Inicia un nuevo anteproyecto en un semillero.</p>
        </a>
        <a href="{{ route('aprendiz.anteproyectos.index') }}" class="block p-4 bg-yellow-100 hover:bg-yellow-200 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-800">Mis Anteproyectos</h3>
            <p class="text-yellow-700 mt-2">Consulta y administra tus anteproyectos.</p>
        </a>
    </div>
@endsection
 