<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use Illuminate\Http\Request;

class RegionalController extends Controller
{
    // Mostrar listado de regionales
    public function index()
    {
        // Cambia 'all' o 'get' por 'paginate' para habilitar la paginación
        $regionales = Regional::paginate(10); // Paginación con 10 resultados por página
        return view('regionales.index', compact('regionales'));
    }

    // Mostrar formulario para crear una nueva regional
    public function create()
    {
        return view('regionales.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_regional' => 'required|string|max:255',
            'descripcion_regional' => 'nullable|string',
            'ubicacion_regional' => 'required|string|max:255',
        ]);

        Regional::create($validatedData);

        return redirect()->route('regionales.index')->with('success', 'Regional creada con éxito');
    }


    // Mostrar los detalles de una regional específica
    public function show(Regional $regional)
    {
        return view('regionales.show', compact('regional'));
    }

    // Mostrar formulario para editar una regional
    public function edit(Regional $regional)
    {
        return view('regionales.edit', compact('regional'));
    }

    // Actualizar una regional
    public function update(Request $request, Regional $regional)
    {
        $validatedData = $request->validate([
            'nombre_regional' => 'required|string|max:255',
            'descripcion_regional' => 'nullable|string',
            'ubicacion_regional' => 'required|string|max:255',
        ]);

        $regional->update($validatedData);

        return redirect()->route('regionales.index')->with('success', 'Regional actualizada con éxito');
    }

    // Eliminar una regional
    public function destroy(Regional $regional)
    {
        $regional->delete();

        return redirect()->route('regionales.index')->with('success', 'Regional eliminada con éxito');
    }
}
