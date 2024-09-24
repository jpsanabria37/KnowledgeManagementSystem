<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Regional;
use Illuminate\Http\Request;

class CentroController extends Controller
{
    // Mostrar listado de centros
    public function index(Request $request)
    {
        // Búsqueda por nombre de centro o regional
        $search = $request->input('search');

        $centros = Centro::with('regional')
            ->whereHas('regional', function($query) use ($search) {
                if ($search) {
                    $query->where('nombre_regional', 'like', "%$search%");
                }
            })
            ->orWhere('nombre_centro', 'like', "%$search%")
            ->paginate(10);

        return view('centros.index', compact('centros'));
    }


    // Mostrar formulario para crear un nuevo centro
    public function create()
    {
        $regionales = Regional::all(); // Obtener todas las regionales para el formulario
        return view('centros.create', compact('regionales'));
    }

    // Guardar un nuevo centro
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_centro' => 'required|string|max:255',
            'regional_id' => 'required|exists:regionales,id',  // Verificar que la regional exista
        ]);

        Centro::create($validatedData);

        return redirect()->route('centros.index')->with('success', 'Centro creado con éxito');
    }

    // Mostrar los detalles de un centro específico
    public function show(Centro $centro)
    {
        return view('centros.show', compact('centro'));
    }

    // Mostrar formulario para editar un centro
    public function edit(Centro $centro)
    {
        $regionales = Regional::all();  // Obtener todas las regionales para el formulario
        return view('centros.edit', compact('centro', 'regionales'));
    }

    // Actualizar un centro
    public function update(Request $request, Centro $centro)
    {
        $validatedData = $request->validate([
            'nombre_centro' => 'required|string|max:255',
            'regional_id' => 'required|exists:regionales,id',
        ]);

        $centro->update($validatedData);

        return redirect()->route('centros.index')->with('success', 'Centro actualizado con éxito');
    }

    // Eliminar un centro
    public function destroy(Centro $centro)
    {
        $centro->delete();

        return redirect()->route('centros.index')->with('success', 'Centro eliminado con éxito');
    }
}
