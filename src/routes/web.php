<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba',function () {
    return 'Hola desde la ruta de prueba';
});
