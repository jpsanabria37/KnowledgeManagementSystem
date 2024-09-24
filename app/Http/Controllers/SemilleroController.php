<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use App\Models\Semillero;
use Illuminate\Http\Request;

class SemilleroController extends Controller
{
    public function index()
    {
        $semilleros = Semillero::with('lineaInvestigacion')->paginate(10);
        return view('semilleros.index', compact('semilleros'));
    }

    public function create()
    {
        $lineas = LineaInvestigacion::all();
        return view('semilleros.create', compact('lineas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'linea_investigacion_id' => 'required|exists:lineas_investigacion,id',
        ]);

        Semillero::create($data);
        return redirect()->route('semilleros.index');
    }

    public function edit(Semillero $semillero)
    {
        $lineas = LineaInvestigacion::all();
        return view('semilleros.edit', compact('semillero', 'lineas'));
    }

    public function update(Request $request, Semillero $semillero)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'linea_investigacion_id' => 'required|exists:lineas_investigacion,id',
        ]);

        $semillero->update($data);
        return redirect()->route('semilleros.index');
    }

    public function destroy(Semillero $semillero)
    {
        $semillero->delete();
        return redirect()->route('semilleros.index');
    }
}
