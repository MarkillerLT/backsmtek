<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\ProductoController;

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

Route::get('/productos', [ProductoController::class, 'catalogo'])
    ->name('productos.catalogo');
Route::get('/productos/{producto}', [ProductoController::class, 'showPublico'])
    ->name('productos.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [UserController::class, 'index'])
        ->name('dashboard');

    Route::get('/perfil', [UserController::class, 'profile'])
        ->name('profile');

    Route::patch('/perfil', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    Route::middleware('auth.admin')->group(function () {

        Route::get('/admin', [AdminController::class, 'index'])
            ->name('admin.index');

        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {

                Route::resource('productos', ProductoController::class)
                    ->except(['show']);

                Route::resource('cotizaciones', CotizacionController::class)
                    ->parameters(['cotizaciones' => 'cotizacion'])
                    ->only(['index', 'show', 'update']);

                Route::resource('postulaciones', PostulacionController::class)
                    ->only(['index', 'show']);

                Route::patch('postulaciones/{postulacion}/estado', [PostulacionController::class, 'updateEstado'])
                    ->name('postulaciones.estado'); // 👈 corregido: sin "admin." repetido

                Route::get('/usuarios', [AdminController::class, 'usuarios'])
                    ->name('usuarios.index');

                Route::patch('/usuarios/{user}/rol', [AdminController::class, 'cambiarRol'])
                    ->name('usuarios.rol');

                Route::get('/perfil', [AdminController::class, 'perfil'])
                    ->name('perfil');

                Route::patch('/perfil', [AdminController::class, 'actualizarPerfil'])
                    ->name('perfil.update');
        });
    });
});
