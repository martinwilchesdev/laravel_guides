<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

// cuando el usuario visite `http://localhost:8000/productos`, laravel ejecutara el metodo `index` del `ProductoController`
Route::get('/productos', [ProductoController::class, 'index']);
