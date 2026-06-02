<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;

// Ruta Principal Institucional PGIQR
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas Protegidas o Públicas de Herramientas (En este caso dentro del layout del sistema)
Route::middleware(['auth'])->prefix('tools')->group(function () {

    // URL: pgiqr.test/tools/qr | Nombre de ruta: tools.qr
    Route::get('/qr', [ToolController::class, 'qr'])->name('tools.qr');

    // Aquí podrás añadir más herramientas fácilmente en el futuro:
    // Route::get('/barcode', [ToolController::class, 'barcode'])->name('tools.barcode');
});

require __DIR__.'/auth.php';
