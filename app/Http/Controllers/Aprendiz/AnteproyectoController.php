<?php

namespace App\Http\Controllers\Aprendiz;

use App\Http\Controllers\Controller;
use App\Models\Anteproyecto;
use App\Models\Actividad;
use App\Models\ObjetivoEspecifico;
use Illuminate\Http\Request;
use App\Models\Semillero;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth; // Agrega esta línea para importar Auth
use Barryvdh\DomPDF\Facade\Pdf; // Importa la clase para generar PDFs
use Illuminate\Support\Facades\Storage;

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
            'tags' => 'nullable|string', // Validamos que sea opcional y texto
            'semillero_id' => 'required|exists:semilleros,id', // Asegúrate de que semillero_id sea obligatorio y exista en la tabla semilleros
        ]);
    
        $anteproyecto = Anteproyecto::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'objetivo_general' => $validated['objetivo_general'],
            'colaboradores' => $validated['colaboradores'] ?? [],
            'user_id' => Auth::id(),
            'paso_actual' => 2,
            'tags' => $validated['tags'],
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

    $validated = $request->validate([
        'anteproyecto_id' => 'required|exists:anteproyectos,id',
        'objetivo_especifico_id' => 'required|exists:objetivos_especificos,id',
        'productos.*.nombre' => 'required|string',
        'productos.*.descripcion' => 'required|string',
        'productos.*.actividades.*.nombre' => 'required|string',
        'productos.*.actividades.*.responsable' => 'required|string',
        'productos.*.actividades.*.fecha_inicio' => 'required|date',
        'productos.*.actividades.*.fecha_fin' => 'required|date|after_or_equal:productos.*.actividades.*.fecha_inicio',
    ]);

    // Obtener el anteproyecto y el objetivo
    $anteproyecto = Anteproyecto::find($validated['anteproyecto_id']);
    $objetivoEspecifico = ObjetivoEspecifico::find($validated['objetivo_especifico_id']);

    foreach ($validated['productos'] as $productoData) {
        // Si el producto tiene un ID, actualizamos. Si no, lo creamos.
        $producto = Producto::updateOrCreate(
            ['id' => $productoData['id'] ?? null], // Busca por ID si existe
            [
                'nombre' => $productoData['nombre'],
                'descripcion' => $productoData['descripcion'],
                'objetivo_especifico_id' => $objetivoEspecifico->id, // Relación al objetivo específico
            ]
        );

        foreach ($productoData['actividades'] as $actividadData) {
            // Si la actividad tiene un ID, actualizamos. Si no, la creamos.
            Actividad::updateOrCreate(
                ['id' => $actividadData['id'] ?? null], // Busca por ID si existe
                [
                    'nombre' => $actividadData['nombre'],
                    'responsable' => $actividadData['responsable'],
                    'fecha_inicio' => $actividadData['fecha_inicio'],
                    'fecha_fin' => $actividadData['fecha_fin'],
                    'producto_id' => $producto->id, // Relación al producto
                    'objetivo_especifico_id' => $objetivoEspecifico->id
                ]
            );
        }
    }

    return back()->with('success', 'Datos guardados correctamente');
}




public function createStep4($id)
{
    // Buscar el anteproyecto
    $anteproyecto = Anteproyecto::with('objetivosEspecificos.actividades')->findOrFail($id);

    // Renderizar la vista del paso 4
    return view('aprendiz.anteproyectos.create_step4', compact('anteproyecto'));
}




public function storeStep4(Request $request, $id)
{
    $validatedData = $request->validate([
        'justificacion' => 'required|string',
        'alcance' => 'required|string',
        'metodologia' => 'required|string',
    ]);

    $anteproyecto = Anteproyecto::findOrFail($id);
    $anteproyecto->update([
        'justificacion' => $validatedData['justificacion'],
        'alcance' => $validatedData['alcance'],
        'metodologia' => $validatedData['metodologia'],
        'paso_actual' => 4, // Actualizamos el paso actual
    ]);

    return redirect()->route('aprendiz.anteproyectos.index')
        ->with('success', 'El anteproyecto ha sido completado con éxito.');
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
                        ->with(['semillero.grupoLinea.grupo.centro', 'creador', 'objetivosEspecificos.productos.actividades', 'objetivosEspecificos.actividades'])
                        ->firstOrFail();
    
        return view('aprendiz.anteproyectos.show', compact('anteproyecto'));
    }


    public function showPublic($id)
    {
        // Permitir a cualquier usuario ver el anteproyecto en modo lectura
        $anteproyecto = Anteproyecto::with([ 'semillero.grupoLinea.grupo.centro', 'creador',  'objetivosEspecificos.productos.actividades', 'objetivosEspecificos.actividades'])->findOrFail($id);

        return view('aprendiz.anteproyectos.show_public', compact('anteproyecto'));
    }

    public function enviarAnteproyecto($id)
{
    // Buscar el anteproyecto
    $anteproyecto = Anteproyecto::findOrFail($id);

    // Cambiar el estado de creación a "completo"
    $anteproyecto->update([
        'estado_creacion' => 'completo',
        'paso_actual' => 4, // Asegurar que el paso actual esté en 4
    ]);

    return redirect()->route('aprendiz.anteproyectos.index')->with('success', 'Anteproyecto enviado correctamente.');
}
public function generarPdf($id)
{
    // Carga el anteproyecto con relaciones
    $anteproyecto = Anteproyecto::with([
        'objetivosEspecificos.productos.actividades',
        'objetivosEspecificos.actividades',
        'semillero.grupoLinea.grupo.centro'
    ])->findOrFail($id);

    // Cargar la vista del PDF
    $pdf = Pdf::loadView('aprendiz.anteproyectos.pdf', compact('anteproyecto'));

    // Mostrar el PDF sin descargarlo automáticamente
    return $pdf->stream('anteproyecto_' . $anteproyecto->titulo . '.pdf');
}


public function buscar(Request $request)
{
    // Validar la entrada del usuario
    $request->validate([
        'query' => 'required|string|min:1',
    ]);

    $term = $request->input('query'); // Obtener el término de búsqueda
    $resultados = Anteproyecto::query()->buscar2($term)->get(); // Usar el scope buscar2 definido en el modelo

    // Devolver la vista con los resultados
    return view('aprendiz.resultados', compact('resultados', 'term'));
}

public function subirPoster(Request $request, $id)
{
    $request->validate([
        'poster' => [
            'required',
            'file',
            'mimes:pptx,docx,pdf', // Extensiones válidas
            'max:5120', // Tamaño máximo 5 MB
        ],
    ], [
        'poster.required' => 'El archivo del póster es obligatorio.',
        'poster.file' => 'El póster debe ser un archivo válido.',
        'poster.mimes' => 'El póster debe ser de tipo PPTX, DOCX o PDF.',
        'poster.max' => 'El póster no puede exceder los 5 MB.',
    ]);

    $anteproyecto = Anteproyecto::findOrFail($id);

    // Eliminar póster existente si hay uno
    if ($anteproyecto->poster_path) {
        Storage::disk('public')->delete($anteproyecto->poster_path);
    }

    // Subir el nuevo póster
    $path = $request->file('poster')->store('posters', 'public');
    $anteproyecto->poster_path = $path;
    $anteproyecto->save();

    return redirect()->back()->with('success', 'Póster subido correctamente.');
}

public function subirVideo(Request $request, $id)
{
    $request->validate([
        'video' => [
            'required',
            'file',
            'mimes:mp4,avi,mov,wmv', // Extensiones válidas
            'max:51200', // Tamaño máximo 50 MB
        ],
    ], [
        'video.required' => 'El archivo de video es obligatorio.',
        'video.file' => 'El video debe ser un archivo válido.',
        'video.mimes' => 'El video debe ser de tipo MP4, AVI, MOV o WMV.',
        'video.max' => 'El video no puede exceder los 50 MB.',
    ]);

    $anteproyecto = Anteproyecto::findOrFail($id);

    // Eliminar video existente si hay uno
    if ($anteproyecto->video_path) {
        Storage::disk('public')->delete($anteproyecto->video_path);
    }

    // Subir el nuevo video
    $videoPath = $request->file('video')->store('videos', 'public');
    $anteproyecto->video_path = $videoPath;
    $anteproyecto->save();

    return redirect()->back()->with('success', 'Video subido correctamente.');
}



    public function eliminarPoster($id)
    {
        $anteproyecto = Anteproyecto::findOrFail($id);

        if ($anteproyecto->poster_path) {
            Storage::delete($anteproyecto->poster_path);
            $anteproyecto->poster_path = null;
            $anteproyecto->save();
        }

        return redirect()->back()->with('success', 'Póster eliminado correctamente.');
    }

    public function eliminarVideo($id)
    {
        $anteproyecto = Anteproyecto::findOrFail($id);

        if ($anteproyecto->video_path) {
            Storage::delete($anteproyecto->video_path);
            $anteproyecto->video_path = null;
            $anteproyecto->save();
        }

        return redirect()->back()->with('success', 'Video eliminado correctamente.');
    }


}