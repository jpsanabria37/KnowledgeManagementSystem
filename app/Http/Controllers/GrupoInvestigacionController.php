<?php

namespace App\Http\Controllers;

use App\Models\GrupoInvestigacion;
use App\Models\Centro;
use App\Models\LineaInvestigacion;
use Illuminate\Http\Request;

class GrupoInvestigacionController extends Controller
{
    public function index(Request $request)
    {
        $grupos = GrupoInvestigacion::with(['centro', 'linea'])->paginate(10);
        return view('grupos.index', compact('grupos'));
    }


    public function create()
    {
        $centros = Centro::all();
        $lineas = LineaInvestigacion::all();
        return view('grupos.create', compact('centros', 'lineas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_grupo' => 'required|string|max:255',
            'centro_id' => 'required|exists:centros,id',
            'linea_id' => 'required|exists:lineas_investigacion,id',
            'lider_investigacion' => 'nullable|string|max:255',
        ]);

        GrupoInvestigacion::create($validatedData);

        return redirect()->route('grupos.index')->with('success', 'Grupo de investigación creado con éxito');
    }

    public function show(GrupoInvestigacion $grupo)
    {
        return view('grupos.show', compact('grupo'));
    }

    public function edit(GrupoInvestigacion $grupo)
    {
        $centros = Centro::all();
        $lineas = LineaInvestigacion::all();
        return view('grupos.edit', compact('grupo', 'centros', 'lineas'));
    }

    public function update(Request $request, GrupoInvestigacion $grupo)
    {
        $validatedData = $request->validate([
            'nombre_grupo' => 'required|string|max:255',
            'centro_id' => 'required|exists:centros,id',
            'linea_id' => 'required|exists:lineas_investigacion,id',
            'lider_investigacion' => 'nullable|string|max:255',
        ]);

        $grupo->update($validatedData);

        return redirect()->route('grupos.index')->with('success', 'Grupo de investigación actualizado con éxito');
    }

    public function destroy(GrupoInvestigacion $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', 'Grupo de investigación eliminado con éxito');
    }
}
