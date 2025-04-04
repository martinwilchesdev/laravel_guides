{{-- la vista hereda de un layout base llamado `app.blade.php` --}}
@extends('layouts.app')

@section('title', 'Editar producto')

{{-- define el contenido especifico dentro del layout `(@yield('content')) en el layout` --}}
@section('content')
    <div class="mx-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Editar producto</h2>

        {{-- Se muestra un mensaje de error si hay problemas con la validacion --}}
        @if ($errors->any())
            <div class="bg-red-500 text-white text-center font-semibold w-full p-4 my-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Al enviar el formulario, los datos se mandan a store() --}}
        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
            @csrf

            {{-- Laravel no permite metodos PUT en formularios HTML asi que usa la siguiente directiva --}}
            @method('PUT')

            <label class="block mb-2 font-semibold" for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="w-full p-2 border-b-2 mb-3 outline-none" autocomplete="off"
                value="{{ $producto->nombre }}" required><br>

            <label class="block mb-2 font-semibold" for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01" class="w-full p-2 border-b-2 mb-3 outline-none"
                value="{{ $producto->precio }}" required><br>

            <label class="block mb-2 font-semibold" for="descripcion">Descripcion:</label>
            <textarea name="descripcion" class="bg-gray-200 px-4 py-2 w-full outline-none resize-none">{{ $producto->descripcion }}</textarea><br>

            <button type="submit"
                class="bg-black text-white px-4 py-2 rounded-lg cursor-pointer mt-4 hover:bg-opacity-25">Actualizar</button>
        </form>
    </div>
@endsection
