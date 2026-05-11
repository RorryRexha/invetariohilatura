<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
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
    | PRODUCTOS
    |--------------------------------------------------------------------------
    */

    // 👀 ADMIN + ALMACEN + COMPRAS pueden ver
    Route::middleware('role:admin|almacen|compras')->group(function () {

        Route::get('productos', [ProductoController::class, 'index'])
            ->name('productos.index');

    });

    // 🔐 SOLO ADMIN administra productos
    Route::middleware('role:admin')->group(function () {

        Route::get('productos/create', [ProductoController::class, 'create'])
            ->name('productos.create');

        Route::post('productos', [ProductoController::class, 'store'])
            ->name('productos.store');

        Route::get('productos/{id}/edit', [ProductoController::class, 'edit'])
            ->name('productos.edit');

        Route::put('productos/{id}', [ProductoController::class, 'update'])
            ->name('productos.update');

        Route::delete('productos/{id}', [ProductoController::class, 'destroy'])
            ->name('productos.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ENTRADAS
    |--------------------------------------------------------------------------
    */

    // 👀 ADMIN + COMPRAS pueden ver y crear
    Route::middleware('role:admin|compras')->group(function () {

        Route::get('entradas', [EntradaController::class, 'index'])
            ->name('entradas.index');

        Route::get('entradas/create', [EntradaController::class, 'create'])
            ->name('entradas.create');

        Route::post('entradas', [EntradaController::class, 'store'])
            ->name('entradas.store');

        Route::get('/entradas-excel', [EntradaController::class, 'exportExcel'])
            ->name('entradas.excel');

        Route::get('/entradas-pdf', [EntradaController::class, 'exportPDF'])
            ->name('entradas.pdf');
    });

    // 🔐 SOLO ADMIN edita/elimina entradas
    Route::middleware('role:admin')->group(function () {

        Route::get('entradas/{id}/edit', [EntradaController::class, 'edit'])
            ->name('entradas.edit');

        Route::put('entradas/{id}', [EntradaController::class, 'update'])
            ->name('entradas.update');

        Route::delete('entradas/{id}', [EntradaController::class, 'destroy'])
            ->name('entradas.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | SALIDAS
    |--------------------------------------------------------------------------
    */

    // 👀 ADMIN + ALMACEN pueden ver y crear
    Route::middleware('role:admin|almacen')->group(function () {

        Route::get('salidas', [SalidaController::class, 'index'])
            ->name('salidas.index');

        Route::get('salidas/create', [SalidaController::class, 'create'])
            ->name('salidas.create');

        Route::post('salidas', [SalidaController::class, 'store'])
            ->name('salidas.store');

        Route::get('/salidas-excel', [SalidaController::class, 'exportExcel'])
            ->name('salidas.excel');

        Route::get('/salidas-pdf', [SalidaController::class, 'pdf'])
            ->name('salidas.pdf');
    });

    // 🔐 SOLO ADMIN edita/elimina salidas
    Route::middleware('role:admin')->group(function () {

        Route::get('salidas/{id}/edit', [SalidaController::class, 'edit'])
            ->name('salidas.edit');

        Route::put('salidas/{id}', [SalidaController::class, 'update'])
            ->name('salidas.update');

        Route::delete('salidas/{id}', [SalidaController::class, 'destroy'])
            ->name('salidas.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    */

    // 🔐 SOLO ADMIN
    Route::middleware('role:admin')->group(function () {

        Route::resource('users', UserController::class);

    });

    Route::post('/productos/importar', [ProductoController::class, 'importar'])
    ->name('productos.importar');

});

require __DIR__ . '/auth.php';