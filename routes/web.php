<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

// cuando el usuario visite `http://localhost:8000/productos`, laravel ejecutara el metodo `index` de `ProductoController`
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

// Formulario para la creacion de nuevos productos
Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create'); // Muestra el formulario
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store'); // Guarda el producto

// Formulario para editar productos
Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit'); // Muestra el formulario
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update'); // Actualiza el producto

// Eliminar un producto
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
