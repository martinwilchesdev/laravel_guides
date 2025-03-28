<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index() {
        $productos = Producto::all(); // obtiene todos los productos de la base de datos
        return view('productos.index', compact('productos')); // los productos obtenidos son pasados a la vista `productos.index`
        /**
         * `compact('productos')` crea un array asociativo donde el nombre de la variable es la clave y su valor es el contenido de `$productos`
         * o lo que es lo mismo a escribir `return view('productos.index', ['productos' => $productos])`
        */
    }
}
