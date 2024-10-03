<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use App\Models\Centro;
use Illuminate\Http\Request;

class LineaInvestigacionController extends Controller
{
    public function index(Request $request)
    {
        $lineas = LineaInvestigacion::paginate(10);
        return view('lineas.index', compact('lineas'));
    }


    public function create()
    {
        return view('lineas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_linea' => 'required|string|max:255',
        ]);

        LineaInvestigacion::create($validatedData);

        return redirect()->route('lineas.index')->with('success', 'Línea de investigación creada con éxito');
    }



    public function show(LineaInvestigacion $linea)
    {
        return view('lineas.show', compact('linea'));
    }

    public function edit(LineaInvestigacion $linea)
    {
        return view('lineas.edit', compact('linea')); // Pasar la línea y los centros a la vista
    }


    public function update(Request $request, LineaInvestigacion $linea)
    {
        $validatedData = $request->validate([
            'nombre_linea' => 'required|string|max:255',
        ]);

        $linea->update($validatedData);

        return redirect()->route('lineas.index')->with('success', 'Línea de investigación actualizada con éxito');
    }


    public function destroy(LineaInvestigacion $linea)
    {
        $linea->delete();

        return redirect()->route('lineas.index')->with('success', 'Línea de investigación eliminada con éxito');
    }
}
