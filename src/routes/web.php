<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\PostulacionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cotizacion', [CotizacionController::class, 'create'])
    ->name('cotizacion.create');

Route::post('/cotizacion', [CotizacionController::class, 'store'])
    ->name('cotizacion.store');

Route::get('/trabaja-con-nosotros', [PostulacionController::class, 'create'])
    ->name('postulacion.create');

Route::post('/trabaja-con-nosotros', [PostulacionController::class, 'store'])
    ->name('postulacion.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [UserController::class, 'index'])
        ->name('dashboard');

    Route::middleware('auth.admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])
            ->name('admin.index');
    });

});
