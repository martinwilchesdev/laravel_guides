{{-- la vista hereda de un layout base llamado `app.blade.php` --}}
@extends('layouts.app')

{{-- define el contenido especifico dentro del layout `(@yield('content')) en el layout` --}}
@section('content')
<div>
    <h2>Editar producto</h2>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf

        {{-- Laravel no permite metodos PUT en formularios HTML asi que usa la siguiente directiva --}}
        @method('PUT')

        {{-- los campos del formulario se llenan con los datos del producto a editar --}}
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" value="{{ $producto->precio }}" required><br>

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion">{{ $producto->descripcion }}</textarea><br>

        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
