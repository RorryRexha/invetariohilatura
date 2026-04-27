<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PERFIL
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | SOLO ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        // PRODUCTOS
        Route::resource('productos', ProductoController::class);

        // ENTRADAS
        Route::resource('entradas', EntradaController::class);

        Route::get('/entradas-excel', [EntradaController::class, 'exportExcel'])
            ->name('entradas.excel');

        Route::get('/entradas-pdf', [EntradaController::class, 'exportPDF'])
            ->name('entradas.pdf');

    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN Y USUARIO
    |--------------------------------------------------------------------------
    */

    // SALIDAS
    Route::resource('salidas', SalidaController::class);

    Route::get('/salidas-pdf', [SalidaController::class, 'pdf'])
        ->name('salidas.pdf');

    Route::get('/salidas-excel', [SalidaController::class, 'exportExcel'])
        ->name('salidas.excel');

});

require __DIR__.'/auth.php';