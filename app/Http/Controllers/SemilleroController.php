<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semillero;
use App\Models\GrupoInvestigacion;

class SemilleroController extends Controller
{
    public function index()
    {
        // Cargamos todos los semilleros con su relación a la línea y grupo a través de grupo_linea
        $semilleros = Semillero::with('grupoLinea.linea', 'grupoLinea.grupo')->get();
    
        return view('semilleros.index', compact('semilleros'));
    }
    

       /**
     * Muestra el formulario para crear un nuevo semillero.
     */
    public function create()
    {
        // Obtener todos los grupos de investigación
        $grupos = GrupoInvestigacion::with('lineas')->get();

        // Retornar la vista con los grupos y las líneas asociadas
        return view('semilleros.create', compact('grupos'));
    }


    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombre_semillero' => 'required|string|max:255',
            'lider_semillero' => 'required|string|max:255',
            'grupo_linea_id' => 'required|exists:grupo_linea,id',  // Asegúrate de validar el grupo_linea_id
        ]);
    
        // Crear el semillero, asignándolo a la línea de investigación y grupo de investigación
        Semillero::create([
            'nombre_semillero' => $validatedData['nombre_semillero'],
            'lider_semillero' => $validatedData['lider_semillero'],
            'grupo_linea_id' => $validatedData['grupo_linea_id'],  // Asignar la relación pivote
            // Otros campos
        ]);
    
        // Redireccionar al índice de semilleros con un mensaje de éxito
        return redirect()->route('semilleros.index')->with('success', 'Semillero creado exitosamente.');
    }
    
    


  
public function edit($id)
{
    $semillero = Semillero::findOrFail($id);
    $grupos = GrupoInvestigacion::with('lineas')->get();
    return view('semilleros.edit', compact('semillero', 'grupos'));
}

public function show($id)
{
    $semillero = Semillero::with(['grupoLinea.grupo', 'grupoLinea.linea', 'anteproyectos'])->findOrFail($id);
    return view('semilleros.show', compact('semillero'));
}

public function update(Request $request, $id)
{
    // 1. Validar los campos que vienen en la solicitud.
    $validatedData = $request->validate([
        'nombre_semillero' => 'required|string|max:255',
        'lider_semillero' => 'nullable|string|max:255',
        'grupo_linea_id' => 'required|exists:grupo_linea,id', // Asegurarse de que el ID de la relación exista.
    ]);

    // 2. Encontrar el semillero que se va a actualizar.
    $semillero = Semillero::findOrFail($id);

    // 3. Actualizar los campos del semillero.
    $semillero->nombre_semillero = $validatedData['nombre_semillero'];
    $semillero->lider_semillero = $validatedData['lider_semillero'] ?? null;  // El líder puede ser nulo.
    $semillero->grupo_linea_id = $validatedData['grupo_linea_id'];

    // 4. Guardar los cambios en la base de datos.
    $semillero->save();

    // 5. Redirigir de vuelta con un mensaje de éxito.
    return redirect()->route('semilleros.index')
        ->with('success', 'El semillero se ha actualizado correctamente.');
}


    public function destroy(Semillero $semillero)
    {
        $semillero->delete();
        return redirect()->route('semilleros.index');
    }
}
