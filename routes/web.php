<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;

// formulario de registro de usuarios
Route::get('/registro', [AuthController::class, 'showRegisterForm'])
    ->middleware('guest')
    ->name('register.form'); // tendran acceso al formulario de registro unicamente los usuarios no autenticados

Route::post('/registro', [AuthController::class, 'register'])
    ->name('register'); // registra el usuario en la base de datos

// formulario de inicio de sesion
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login.form'); // tendran acceso al formulario de login unicamente los usuarios no autenticados

Route::post('/login', [AuthController::class, 'login'])
    ->name('login'); // autentica el usuario que intenta iniciar sesion

// cerrar la sesion
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// vista con la informacion sobre el envio del correo de confirmacion
Route::get('/email/verify', [AuthController::class, 'verifyEmail'])
    ->middleware('auth')
    ->name('verification.notice'); // tendran acceso a la vistas unicamente los usuarios autenticados

// ruta que maneja la solicitud cuando el usuario verifica el email enviado al correo
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyHandler'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// envia un nuevo email de verificacion al correo del cliente
Route::post('/email/verification-notification', [AuthController::class, 'verifySend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');


// rutas protegidas por el middleware de autenticacion
// si el usuario no esta autenticado, al acceder a estas rutas sera redirigido a `/login` (bootstrap/app.php) - middleware `auth`
// si el usuario no ha confirmado el correo proporcionado durante el registro, no podra acceder a las rutas protegidas - middleware `verified`
Route::middleware(['auth', 'verified'])->group(function () {
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
});
