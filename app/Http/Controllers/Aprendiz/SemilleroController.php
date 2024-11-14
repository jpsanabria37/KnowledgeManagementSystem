<?php

namespace App\Http\Controllers\Aprendiz;

use App\Http\Controllers\Controller;
use App\Models\Semillero; // Modelo de Semillero
use Illuminate\Http\Request;

class SemilleroController extends Controller
{
    /**
     * Mostrar la lista de semilleros disponibles.
     */
    public function index()
    {
        // Obtener todos los semilleros o filtrarlos según sea necesario
        $semilleros = Semillero::with('grupoLinea.linea', 'grupoLinea.grupo')->get();

        // Retornar la vista para el aprendiz
        return view('aprendiz.semilleros.index', compact('semilleros'));
    }
    public function show($id)
    {
        // Cargar el semillero junto con todas sus relaciones
        $semillero = Semillero::with([
            'grupoLinea.grupo.centro',  // Centro de formación del grupo
            'grupoLinea.linea',          // Todas las líneas de investigación asociadas
            'anteproyectos',             // Anteproyectos asociados al semillero
        ])->findOrFail($id);
    
        // Devolver la vista correcta con la variable de datos
        return view('aprendiz.semilleros.show', compact('semillero'));
    }
    
}
