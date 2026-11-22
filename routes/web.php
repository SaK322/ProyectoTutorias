<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('solicitudes', [App\Http\Controllers\TutoringRequestController::class, 'index'])->name('solicitudes.index');
    Route::get('solicitudes/crear', [App\Http\Controllers\TutoringRequestController::class, 'create'])->name('solicitudes.create');
    Route::post('solicitudes', [App\Http\Controllers\TutoringRequestController::class, 'store'])->name('solicitudes.store');
    Route::put('solicitudes/{solicitud}', [App\Http\Controllers\TutoringRequestController::class, 'update'])->name('solicitudes.update');
    Route::get('solicitudes/{solicitud}/editar', [App\Http\Controllers\TutoringRequestController::class, 'edit'])->name('solicitudes.edit');
    Route::delete('solicitudes/{solicitud}', [App\Http\Controllers\TutoringRequestController::class, 'destroy'])->name('solicitudes.destroy');

    // Rutas exclusivas para el Administrador
    Route::resource('tutores', TutorController::class)->parameters([
    'tutores' => 'tutor'
    ]);
});

require __DIR__.'/auth.php';