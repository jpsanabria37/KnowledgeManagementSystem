<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\GrupoInvestigacionController;
use App\Http\Controllers\LineaInvestigacionController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\SemilleroController;
use App\Http\Controllers\AnteproyectoController;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use Laravel\Fortify\Fortify;


// Ruta de bienvenida (abierta para todos)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas para el Administrador (Acceso completo)
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Gestionar Regionales
    Route::resource('regionales', RegionalController::class);

    // Gestionar Centros
    Route::resource('centros', CentroController::class);

    // Gestionar Grupos de Investigación
    Route::resource('grupos', GrupoInvestigacionController::class);

    // Gestionar Líneas de Investigación
    Route::resource('lineas', LineaInvestigacionController::class);

    // Gestionar Semilleros (incluye creación, edición y eliminación)
    Route::resource('semilleros', SemilleroController::class);

    // Gestionar Anteproyectos (incluye creación, edición y eliminación)
    Route::resource('anteproyectos', AnteproyectoController::class);

    // Rutas para la gestión de PDFs en Anteproyectos
    Route::get('anteproyectos/{anteproyecto}/generate_pdf', [AnteproyectoController::class, 'generarPdf'])->name('anteproyectos.generate_pdf');
    Route::delete('anteproyectos/{anteproyecto}/delete_pdf', [AnteproyectoController::class, 'deletePdf'])->name('anteproyectos.delete_pdf');

    // Dashboard del administrador
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});


// Rutas para el rol de aprendiz
Route::middleware(['auth', 'role:aprendiz'])->prefix('aprendiz')->name('aprendiz.')->group(function () {
    Route::get('/dashboard', function () {
        return view('aprendiz.dashboard');
    })->name('dashboard');
// Ruta para ver los semilleros
    Route::get('/semilleros', [App\Http\Controllers\Aprendiz\SemilleroController::class, 'index'])->name('semilleros.index');
    Route::get('/semilleros/{id}', [App\Http\Controllers\Aprendiz\SemilleroController::class, 'show'])->name('semilleros.show');

      // Ruta para ver todos los anteproyectos del aprendiz
      Route::get('/anteproyectos', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'index'])->name('anteproyectos.index');

      // Ruta para crear un nuevo anteproyecto
      Route::get('/create-step1', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'createStep1'])->name('anteproyectos.createStep1');
    Route::post('/store-step1', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'storeStep1'])->name('anteproyectos.storeStep1');

    Route::get('/anteproyectos/{anteproyecto}/create-step2', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'createStep2'])->name('anteproyectos.createStep2');
    Route::post('/anteproyectos/{anteproyecto}/store-step2', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'storeStep2'])->name('anteproyectos.storeStep2');

    Route::get('/{anteproyecto}/create-step3', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'createStep3'])->name('anteproyectos.createStep3');
    Route::post('/{anteproyecto}/store-step3', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'storeStep3'])->name('anteproyectos.storeStep3');
      Route::get('/anteproyectos/{id}', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'showOwn'])
      ->name('anteproyectos.show');

      Route::get('anteproyectos/public/{id}', [App\Http\Controllers\Aprendiz\AnteproyectoController::class, 'showPublic'])
      ->name('anteproyectos.showPublic');

});



?>