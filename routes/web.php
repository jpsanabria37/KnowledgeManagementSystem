<?php

use App\Http\Controllers\CentroController;
use App\Http\Controllers\GrupoInvestigacionController;
use App\Http\Controllers\LineaInvestigacionController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\SemilleroController;
use App\Http\Controllers\AnteproyectoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
// Mostrar todas las regionales (index)
Route::get('regionales', [RegionalController::class, 'index'])->name('regionales.index');

// Mostrar formulario para crear una nueva regional (create)
Route::get('regionales/create', [RegionalController::class, 'create'])->name('regionales.create');

// Guardar una nueva regional (store)
Route::post('regionales', [RegionalController::class, 'store'])->name('regionales.store');

// Mostrar una regional específica (show)
Route::get('regionales/{regional}', [RegionalController::class, 'show'])->name('regionales.show');

// Mostrar formulario para editar una regional (edit)
Route::get('regionales/{regional}/edit', [RegionalController::class, 'edit'])->name('regionales.edit');

// Actualizar una regional existente (update)
Route::put('regionales/{regional}', [RegionalController::class, 'update'])->name('regionales.update');

// Eliminar una regional (destroy)
Route::delete('regionales/{regional}', [RegionalController::class, 'destroy'])->name('regionales.destroy');

Route::resource('centros', CentroController::class);
Route::resource('grupos', GrupoInvestigacionController::class);
Route::resource('lineas', LineaInvestigacionController::class);
// Crear nuevo semillero (formulario)
Route::get('semilleros/create', [SemilleroController::class, 'create'])->name('semilleros.create');

// Guardar semillero (almacenamiento)
Route::post('semilleros', [SemilleroController::class, 'store'])->name('semilleros.store');

// Mostrar lista de semilleros
Route::get('semilleros', [SemilleroController::class, 'index'])->name('semilleros.index');

// Mostrar un semillero en detalle
Route::get('semilleros/{semillero}', [SemilleroController::class, 'show'])->name('semilleros.show');

// Editar un semillero (formulario)
Route::get('semilleros/{semillero}/edit', [SemilleroController::class, 'edit'])->name('semilleros.edit');

// Actualizar un semillero
Route::put('semilleros/{semillero}', [SemilleroController::class, 'update'])->name('semilleros.update');

// Eliminar un semillero
Route::delete('semilleros/{semillero}', [SemilleroController::class, 'destroy'])->name('semilleros.destroy');

Route::resource('anteproyectos', AnteproyectoController::class);

// Ruta para generar el PDF dinámicamente
Route::get('anteproyectos/{anteproyecto}/generate_pdf', [AnteproyectoController::class, 'generarPdf'])->name('anteproyectos.generate_pdf');

// Ruta para eliminar el PDF almacenado
Route::delete('anteproyectos/{anteproyecto}/delete_pdf', [AnteproyectoController::class, 'deletePdf'])->name('anteproyectos.delete_pdf');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
