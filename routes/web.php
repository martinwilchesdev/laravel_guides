<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

// cuando el usuario visite `http://localhost:8000/productos`, laravel ejecutara el metodo `index` de `ProductoController`
Route::get('/productos', [ProductoController::class, 'index']);

// Formulario para la creacion de nuevos productos
Route::get('/productos/crear', [ProductoController::class, 'create']); // Muestra el formulario
Route::post('/productos', [ProductoController::class, 'store']); // Guarda el producto
