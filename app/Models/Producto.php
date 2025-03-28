<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model

{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    // $fillable permite la asignacion masiva de datos cuando se crea un producto
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion'
    ];
}
