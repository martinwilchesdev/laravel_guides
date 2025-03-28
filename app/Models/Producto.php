<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // $fillable permite la asignacion masiva de datos cuando se crea un producto
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion'
    ];
}
