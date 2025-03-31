{{-- la vista hereda de un layout base llamado `app.blade.php` --}}
@extends('layouts.app')

{{-- define el contenido especifico dentro del layout `(@yield('content')) en el layout` --}}
@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Lista de productos</h2>

    {{-- despues de que el usuario es redirigido al realizar una accion, se puede mostrar el mensaje asociado a dicha accion desde `session()` --}}
    @if (@session('success'))
        <div class="bg-green-500 text-white text-center font-semibold w-full p-4 my-4 rounded">
            {{-- `session()` recibe como parametro el valor definido en `with()` al realizar la redireccion a la vista desde el controlador --}}
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full flex justify-between items-center">
        <form method="GET" class="mb-4">
            <label for="perPage" class="font-semibold">Mostrar:</label>
            {{-- `this.form.submit` permite que cuando el usuario seleccione una opcion, el formulario se envie automaticamente --}}
            <select name="perPage" id="perPage" class="border p-2 rounded" onchange="this.form.submit()">
                {{-- `selected` se utiliza para mantener la opcion seleccionada al recargar la pagina --}}
                {{-- `request()` es un helper global de Laravel que permite acceder a la request desde cualquier parte del codigo --}}
                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
            </select>
        </form>

        <form method="GET" class="flex space-x-2">
            <input type="text" name="search" placeholder="Buscar producto..."
                value="{{ request('search') }}"
                class="border p-2 rounded w-full outline-none">
            {{-- al dar clic en el boton `Buscar` se añade como parametro a la URL el valor de la propiedad `name` del input anterior --}}
            {{-- a traves de este parametro se puede realizar un filtro en la base de datos desde el controlador para obtener productos especificos --}}
            <button class="bg-green-500 text-white font-bold py-2 px-4 cursor-pointer rounded hover:bg-green-600" type="submit">Buscar</button>

            {{-- si se ha proporcionado un termino de busqueda, se muestra un boton que permite reestablecer la vista sin parametros en la URL --}}
            @if (request('search'))
                <a href="{{ route('productos.index') }}" class="bg-gray-500 text-white flex items-center py-2 px-4 cursor-pointer rounded hover:bg-gray-600">
                    Restablecer
                </a>
            @endif
        </form>
    </div>

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

    {{-- enlaces de paginacion --}}
    <div class="mt-4">
        {{-- $productos->links() genera automaticamente los enlaces de paginacion con estilos de tailwind --}}
        {{-- `$productos->appends()` asegura que el parametro `$perPage` se mantenga en la URL al cambiar de pagina --}}
        {{ $productos->appends(['perPage' => $perPage])->links('pagination::tailwind') }}
    </div>
</div>
@endsection
