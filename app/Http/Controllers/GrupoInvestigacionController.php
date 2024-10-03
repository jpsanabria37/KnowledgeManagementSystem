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
        $grupos = GrupoInvestigacion::with(['centro'])->paginate(10);
        return view('grupos.index', compact('grupos'));
    }


    public function create()
    {
        $centros = Centro::all();
        return view('grupos.create', compact('centros'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_grupo' => 'required|string|max:255',
            'centro_id' => 'required|exists:centros,id',
            'lider_investigacion' => 'nullable|string|max:255',
        ]);

        GrupoInvestigacion::create($validatedData);

        return redirect()->route('grupos.index')->with('success', 'Grupo de investigación creado con éxito');
    }
    public function show($id)
    {
        $grupo = GrupoInvestigacion::with([
            'centro.regional', 
            'lineas',  // Cargar semilleros a través de las líneas
        ])->findOrFail($id);
    
        return view('grupos.show', compact('grupo'));
    }
    
    public function edit($id)
    {
        $grupo = GrupoInvestigacion::findOrFail($id);
        $centros = Centro::all();
        $lineas = LineaInvestigacion::all(); // Todas las líneas de investigación

        return view('grupos.edit', compact('grupo', 'centros', 'lineas'));
    }

    public function update(Request $request, $id)
    {
        // Validamos los datos recibidos
        $request->validate([
            'nombre_grupo' => 'required|string|max:255',
            'centro_id' => 'required|exists:centros,id',
            'lineas' => 'nullable|array', // Validamos que sea un array
            'lineas.*' => 'exists:lineas_investigacion,id' // Validamos que cada línea exista
        ]);
    
        // Encontramos el grupo de investigación a actualizar
        $grupo = GrupoInvestigacion::findOrFail($id);
    
        // Actualizamos los campos básicos del grupo
        $grupo->update($request->only('nombre_grupo', 'lider_investigacion', 'centro_id'));
    
        // Sincronizamos las líneas de investigación seleccionadas
        $grupo->lineas()->sync($request->input('lineas', []));
    
        // Redirigimos con un mensaje de éxito
        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    public function destroy(GrupoInvestigacion $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', 'Grupo de investigación eliminado con éxito');
    }
}
