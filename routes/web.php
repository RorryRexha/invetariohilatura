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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | PRODUCTOS
    |--------------------------------------------------------------------------
    */

    // 👀 Todos pueden ver
    Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');

    // 🔐 Solo admin
    Route::middleware('role:admin')->group(function () {
        Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ENTRADAS (SOLO ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::resource('entradas', EntradaController::class);

        Route::get('/entradas-excel', [EntradaController::class, 'exportExcel'])
            ->name('entradas.excel');

        Route::get('/entradas-pdf', [EntradaController::class, 'exportPDF'])
            ->name('entradas.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | SALIDAS
    |--------------------------------------------------------------------------
    */

    // 👀 Todos pueden ver
    Route::get('salidas', [SalidaController::class, 'index'])->name('salidas.index');

    // ➕ Admin + Almacen pueden crear
    Route::middleware('role:admin|almacen')->group(function () {
        Route::get('salidas/create', [SalidaController::class, 'create'])->name('salidas.create');
        Route::post('salidas', [SalidaController::class, 'store'])->name('salidas.store');
    });

    // 🔐 Solo admin edita/elimina
    Route::middleware('role:admin')->group(function () {
        Route::get('salidas/{id}/edit', [SalidaController::class, 'edit'])->name('salidas.edit');
        Route::put('salidas/{id}', [SalidaController::class, 'update'])->name('salidas.update');
        Route::delete('salidas/{id}', [SalidaController::class, 'destroy'])->name('salidas.destroy');
    });

    // 📊 reportes
    Route::get('/salidas-excel', [SalidaController::class, 'exportExcel'])
        ->name('salidas.excel');

    Route::get('/salidas-pdf', [SalidaController::class, 'pdf'])
        ->name('salidas.pdf');

    /*
    |--------------------------------------------------------------------------
    | USUARIOS (SOLO ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

});

require __DIR__ . '/auth.php';