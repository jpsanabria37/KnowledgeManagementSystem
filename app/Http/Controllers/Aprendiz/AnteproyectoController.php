<?php

namespace App\Http\Controllers\Aprendiz;

use App\Http\Controllers\Controller;
use App\Models\Anteproyecto;
use App\Models\Actividad;
use App\Models\ObjetivoEspecifico;
use Illuminate\Http\Request;
use App\Models\Semillero;
use Illuminate\Support\Facades\Auth; // Agrega esta línea para importar Auth

class AnteproyectoController extends Controller
{

    public function createStep1()
    {
        $semilleros = Semillero::all(); 
        // Vista del primer paso
        return view('aprendiz.anteproyectos.create_step1', compact('semilleros'));
    }
    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'objetivo_general' => 'required|string',
            'colaboradores' => 'nullable|array',
            'semillero_id' => 'required|exists:semilleros,id', // Asegúrate de que semillero_id sea obligatorio y exista en la tabla semilleros
        ]);
    
        $anteproyecto = Anteproyecto::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'objetivo_general' => $validated['objetivo_general'],
            'colaboradores' => $validated['colaboradores'] ?? [],
            'user_id' => Auth::id(),
            'semillero_id' => $validated['semillero_id'], // Asigna el semillero_id validado
        ]);
    
        return redirect()->route('aprendiz.anteproyectos.createStep2', $anteproyecto->id);
    }
    


    public function createStep2($anteproyectoId)
    {
        $anteproyecto = Anteproyecto::findOrFail($anteproyectoId);
        return view('aprendiz.anteproyectos.create_step2', compact('anteproyecto'));
    }
    public function storeStep2(Request $request, $id)
    {
        $anteproyecto = Anteproyecto::findOrFail($id);
    
        // Validación y almacenamiento de datos del paso 2
        $validatedData = $request->validate([
            'objetivos_especificos.*.nombre' => 'required|string|max:255',
            'objetivos_especificos.*.recursos_necesarios' => 'nullable|string',
        ]);
    
        // Almacenar objetivos específicos y recursos necesarios
        foreach ($validatedData['objetivos_especificos'] as $objetivoData) {
            $anteproyecto->objetivosEspecificos()->create($objetivoData);
        }
    
        // Actualizar el paso actual del anteproyecto
        $anteproyecto->paso_actual = 3; // Ahora estamos en el paso 3, por ejemplo
        $anteproyecto->save();
    
        return redirect()->route('aprendiz.anteproyectos.createStep3', $anteproyecto->id);
    }


    public function createStep3($anteproyectoId)
    {
        $anteproyecto = Anteproyecto::with('objetivosEspecificos.actividades')->findOrFail($anteproyectoId);
        return view('aprendiz.anteproyectos.create_step3', compact('anteproyecto'));
    }
// Paso 3: Añadir Actividades a cada Objetivo Específico
public function storeStep3(Request $request, $id)
{
    $anteproyecto = Anteproyecto::findOrFail($id);

    // Validación de los datos
    $validatedData = $request->validate([
        'objetivos_especificos.*.nombre' => 'required|string|max:255',
        'objetivos_especificos.*.recursos_necesarios' => 'nullable|string',
        'objetivos_especificos.*.actividades' => 'array|min:1',
        'objetivos_especificos.*.actividades.*.nombre' => 'required|string|max:255',
        'objetivos_especificos.*.actividades.*.fecha_inicio' => 'required|date',
        'objetivos_especificos.*.actividades.*.fecha_fin' => 'required|date|after_or_equal:objetivos_especificos.*.actividades.*.fecha_inicio',
        'objetivos_especificos.*.actividades.*.responsable' => 'required|string|max:255',
    ]);

    // Mostrar datos validados para depurar
    dd($validatedData);

    // Luego de revisar los datos, podemos continuar con la lógica
}




    public function storeStep4(Request $request, $id)
{
    $anteproyecto = Anteproyecto::findOrFail($id);

    // Validación y almacenamiento de datos del paso 4
    // ...

    // Marcar el anteproyecto como completo
    $anteproyecto->estado = 'completo';
    $anteproyecto->paso_actual = 4;
    $anteproyecto->save();

    return redirect()->route('aprendiz.anteproyectos.index')->with('success', 'Anteproyecto completado exitosamente.');
}
    
    /**
     * Mostrar una lista de todos los anteproyectos del aprendiz.
     */
    public function index()
    {
        // Obtener los anteproyectos creados por el usuario autenticado
        $anteproyectos = Anteproyecto::where('user_id', auth()->id())->get();

        return view('aprendiz.anteproyectos.index', compact('anteproyectos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo anteproyecto.
     */
    public function create()
    {
        $semilleros = Semillero::all();
        return view('aprendiz.anteproyectos.create', compact('semilleros'));
    }

    /**
     * Almacenar un nuevo anteproyecto en la base de datos.
     */
    public function store(Request $request)
    {
        // Aquí usaremos el método store actualizado con los cambios de migración
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'objetivo_general' => 'required|string',
            'objetivos_especificos' => 'required|string',
            'justificacion' => 'required|string',
            'alcance' => 'nullable|string',
            'metodologia' => 'nullable|string',
            'cronograma' => 'nullable|string',
            'recursos_necesarios' => 'nullable|string',
            'archivo_pdf' => 'nullable|file|mimes:pdf|max:2048',
            'archivo_poster' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'semillero_id' => 'required|exists:semilleros,id',
            'estado' => 'required|in:en_proceso,aprobado,rechazado',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'realizado_por' => 'required|string|max:255',
            'pdf_option' => 'required|in:generate,upload',
            'colaboradores' => 'nullable|array',
            'colaboradores.*' => 'string|max:255',
        ]);

        // Guardar el anteproyecto como en el método anterior
        $validated['user_id'] = auth()->id();
        $validated['colaboradores'] = $request->colaboradores ? json_encode($request->colaboradores) : null;

        // Manejar archivo PDF y poster
        if ($request->hasFile('archivo_pdf') && $request->pdf_option === 'upload') {
            $validated['archivo_pdf'] = $request->file('archivo_pdf')->store('anteproyectos', 'public');
        }
        if ($request->hasFile('archivo_poster')) {
            $validated['archivo_poster'] = $request->file('archivo_poster')->store('anteproyectos', 'public');
        }

        Anteproyecto::create($validated);

        return redirect()->route('aprendiz.anteproyectos.index')->with('success', 'Anteproyecto creado exitosamente.');
    }

    /**
     * Mostrar detalles de un anteproyecto específico.
     */
    public function showOwn($id)
    {
        // Verificar que el usuario sea el creador del anteproyecto
        $anteproyecto = Anteproyecto::where('id', $id)
                        ->where('user_id', auth()->id()) // Asegura que sea del usuario logueado
                        ->with(['semillero', 'creador'])
                        ->firstOrFail();
    
        return view('aprendiz.anteproyectos.show', compact('anteproyecto'));
    }


    public function showPublic($id)
    {
        // Permitir a cualquier usuario ver el anteproyecto en modo lectura
        $anteproyecto = Anteproyecto::with(['semillero', 'creador'])->findOrFail($id);

        return view('aprendiz.anteproyectos.show_public', compact('anteproyecto'));
    }
}