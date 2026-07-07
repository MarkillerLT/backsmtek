<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

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
