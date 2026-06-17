<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProcesoDisciplinarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| PANEL PRINCIPAL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:coordinadora,abogado'])->group(function () {

    Route::get('/abogado', function () {

        $role = auth()->user()->role;

        return view('abogado.dashboard', compact('role'));

    })->name('abogado.dashboard');

});

/*
|--------------------------------------------------------------------------
| ESTADÍSTICAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:coordinadora,abogado'])->group(function () {

    Route::get('/abogado/estadistica', function () {

        return view('abogado.Estadistica');

    })->name('abogado.estadistica');

    Route::get('/abogado/estadisticas/datos',
        [ProcesoDisciplinarioController::class, 'estadisticasDatos']
    )->name('abogado.estadisticas.datos');

});

/*
|--------------------------------------------------------------------------
| REGISTRO DE PROCESOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:coordinadora,abogado'])->group(function () {

    Route::get('/abogado/registro',
        [ProcesoDisciplinarioController::class, 'create']
    )->name('abogado.registro');

    Route::post('/abogado/registro',
        [ProcesoDisciplinarioController::class, 'store']
    )->name('abogado.registro.store');

});

/*
|--------------------------------------------------------------------------
| CONSULTAR PROCESOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:coordinadora,abogado'])->group(function () {

    Route::get('/abogado/consultarproceso',
        [ProcesoDisciplinarioController::class, 'index']
    )->name('abogado.consultarproceso');

});

/*
|--------------------------------------------------------------------------
| DETALLE PROCESO
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:coordinadora,abogado'])->group(function () {

    Route::get('/abogado/detalleproceso/{id}',
        [ProcesoDisciplinarioController::class, 'show']
    )->name('abogado.detalleproceso');

});

/*
|--------------------------------------------------------------------------
| ACTUALIZAR PROCESO
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:coordinadora,abogado'])->group(function () {

    Route::put('/abogado/actualizarproceso/{id}',
        [ProcesoDisciplinarioController::class, 'update']
    )->name('abogado.actualizarproceso');

});
Route::delete('/abogado/eliminarproceso/{id}',
    [ProcesoDisciplinarioController::class, 'destroy']
)->name('abogado.eliminarproceso');

//ABOGADS
Route::middleware(['auth', 'role:coordinadora'])->group(function () {

    Route::get('/coordinadora/abogados',
        [ProcesoDisciplinarioController::class, 'abogados']
    )->name('coordinadora.abogados');

});
Route::delete('/coordinadora/abogados/{id}', [ProcesoDisciplinarioController::class, 'eliminarAbogado'])
    ->name('coordinadora.abogados.eliminar');

Route::post('/coordinadora/abogados/guardar', [ProcesoDisciplinarioController::class, 'guardarAbogado'])
    ->name('coordinadora.abogados.guardar');
Route::put('/coordinadora/abogados/editar/{id}',
    [ProcesoDisciplinarioController::class, 'editarAbogado'])
    ->name('coordinadora.abogados.editar');