<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('productos', ProductoController::class);
    Route::resource('entradas', EntradaController::class);
    Route::resource('salidas', SalidaController::class);
    Route::get('/entradas-excel', [EntradaController::class, 'exportExcel'])
    ->name('entradas.excel');
    Route::get('entradas/pdf', [EntradaController::class, 'exportPDF'])
    ->name('entradas.pdf');

});

require __DIR__.'/auth.php';
