<?php

namespace App\Http\Controllers;

use App\Models\Anteproyecto;
use App\Models\Semillero;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage; // Asegúrate de importar Storage

class AnteproyectoController extends Controller
{
    public function index()
    {
        $anteproyectos = Anteproyecto::with('semillero')->get();
        return view('anteproyectos.index', compact('anteproyectos'));
    }

    public function create()
    {
        $semilleros = Semillero::all();
        return view('anteproyectos.create', compact('semilleros'));
    }


    
    public function store(Request $request)
    {
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
        ]);
    
        // Manejo del archivo Poster
        if ($request->hasFile('archivo_poster')) {
            $validated['archivo_poster'] = $request->file('archivo_poster')->store('anteproyectos', 'public');
        }
    
        // Verificar si el PDF será generado o subido
        if ($request->pdf_option === 'upload' && $request->hasFile('archivo_pdf')) {
            // Subir PDF
            $validated['archivo_pdf'] = $request->file('archivo_pdf')->store('anteproyectos', 'public');
        } elseif ($request->pdf_option === 'generate') {
            // Generar PDF automáticamente y pasar todas las variables necesarias
            //$pdf = Pdf::loadView('anteproyectos.pdf', $validated); 
            //$pdfPath = 'anteproyectos/pdf_' . time() . '.pdf';
            //Storage::put('public/' . $pdfPath, $pdf->output()); // Almacenar el archivo en storage/app/public
            //$validated['archivo_pdf'] = $pdfPath;
        }
    
        // Crear el anteproyecto con los datos validados
        Anteproyecto::create($validated);
    
        return redirect()->route('anteproyectos.index')->with('success', 'Anteproyecto creado exitosamente.');
    }
    public function edit(Anteproyecto $anteproyecto)
    {
        $semilleros = Semillero::all();
        return view('anteproyectos.edit', compact('anteproyecto', 'semilleros'));
    }

    // app/Http/Controllers/AnteproyectoController.php

    public function show(Anteproyecto $anteproyecto)
    {
        return view('anteproyectos.show', compact('anteproyecto'));
    }

    public function deletePdf(Anteproyecto $anteproyecto)
{
    if ($anteproyecto->archivo_pdf) {
        // Eliminar el archivo del almacenamiento
        Storage::delete('public/' . $anteproyecto->archivo_pdf);

        // Actualizar el registro en la base de datos
        $anteproyecto->update(['archivo_pdf' => null]);
    }

    return redirect()->back()->with('success', 'El PDF ha sido eliminado.');
}

public function generarPdf($id)
{
    // Obtener el anteproyecto por su ID
    $anteproyecto = Anteproyecto::findOrFail($id);

    // Cargar la vista del PDF
    $pdf = Pdf::loadView('anteproyectos.pdf', compact('anteproyecto'));

    // Mostrar el PDF sin descargarlo automáticamente
    return $pdf->stream('anteproyecto_' . $anteproyecto->titulo . '.pdf');
}


    public function update(Request $request, Anteproyecto $anteproyecto)
    {
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
            'realizado_por' => 'required|string|max:255', // Validación para el campo realizado_por
        ]);

        $anteproyecto->update($validated);

        return redirect()->route('anteproyectos.index')->with('success', 'Anteproyecto actualizado exitosamente.');
    }

    public function destroy(Anteproyecto $anteproyecto)
    {
        $anteproyecto->delete();
        return redirect()->route('anteproyectos.index')->with('success', 'Anteproyecto eliminado exitosamente.');
    }
}
