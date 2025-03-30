{{-- la vista hereda de un layout base llamado `app.blade.php` --}}
@extends('layouts.app')

{{-- define el contenido especifico dentro del layout `(@yield('content')) en el layout` --}}
@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Lista de productos</h2>

    {{-- Despues de que el usuario es redirigido, se pueden mostrar el mensaje asociado a la accion desde `session` --}}
    @if (@session('success'))
        <div class="bg-green-500 text-white text-center font-semibold w-full p-4 my-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('productos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar producto</a>

    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Precio</th>
                <th class="border border-gray-300 px-4 py-2">Descripcion</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>

        <tbody>
            {{-- La directiva `@foreach` permite iterar un array dentro de una vista --}}
            @foreach ($productos as $producto)
                <tr class="hover:bg-gray-200">
                    <td class="border border-gray-300 px-4 py-2">{{ $producto->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $producto->precio }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $producto->descripcion }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="bg-green-500 text-white px-2 py-1 rounded">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 cursor-pointer rounded" onclick="return confirm('¿Estás seguro que deseas eliminar el producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
