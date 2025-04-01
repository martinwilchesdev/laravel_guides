<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

// cuando el usuario visite `http://localhost:8000/productos`, laravel ejecutara el metodo `index` de `ProductoController`
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

// formulario para la creacion de nuevos productos
Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create'); // muestra el formulario
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store'); // guarda el producto

// formulario para editar productos
Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit'); // muestra el formulario
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update'); // actualiza el producto

// eliminar un producto
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

// formulario de registro de usuarios
Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('auth.registerForm');
Route::post('/registro', [AuthController::class, 'register'])->name('auth.register'); // registra el usuario en la base de datos

// formulario de inicio de sesion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); // autentica el usuario que intenta iniciar sesion

// cerrar la sesion
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
