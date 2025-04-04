{{-- la vista hereda de un layout base llamado `app.blade.php` --}}
@extends('layouts.app')

@section('title', 'Crear producto')

{{-- define el contenido especifico dentro del layout `(@yield('content')) en el layout` --}}
@section('content')
    <div class="mx-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Agregar nuevo producto</h2>

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
        <form action="{{ url('/productos') }}" method="POST">

            {{-- @csrf es una directiva de Blade que protege los formularios contra ataques CSRF (Cross-Site Request Forgery) --}}
            {{-- Cuando se envia un formulario en Laravel, se espera que incluya un token CSRF unico  --}}
            {{-- Laravel verifica este token en cada solicitud POST, PUT, PATCH o DELETE para asegurarse que la peticion viene desde la propia aplicacion --}}
            @csrf
            {{-- Laravel genera un token CSRF unico por sesion y lo almacena en una cookie --}}
            {{-- Al enviar el formulario Laravel compara el token del formulario con el que tiene almacenado en la sesion --}}
            {{-- Si los token no coinciden, Laravel rechaza la solicitud con u error 419 Page expired --}}

            <label class="block mb-2 font-semibold" for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="w-full p-2 border-b-2 mb-3 outline-none" autocomplete="off"
                required><br>

            <label class="block mb-2 font-semibold" for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01" class="w-full p-2 border-b-2 mb-3 outline-none"
                required><br>

            <label class="block mb-2 font-semibold" for="descripcion">Descripcion:</label>
            <textarea name="descripcion" class="bg-gray-200 px-4 py-2 w-full outline-none resize-none"></textarea><br>

            <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg cursor-pointer mt-4">Guardar
                producto</button>
        </form>
    </div>
@endsection
