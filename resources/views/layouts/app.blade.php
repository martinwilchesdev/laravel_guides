<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
    <nav class="flex justify-between items-center bg-black p-4 container">
        <div>
            <a class="text-white text-lg font-bold" href="{{ route('productos.index') }}">Laravel</a>
        </div>
        <div class="flex gap-8 items-center text-white">
            {{-- la directiva `@auth` muestra contenido unicamente a usuarios autenticados --}}
            @auth
                <a href="{{ route('productos.index') }}">Productos</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="cursor-pointer">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login.form') }}">Iniciar sesión</a>
                <a href="{{ route('register.form') }}" class="bg-blue-500 px-3 py-1 rounded">Registrarse</a>
            @endauth
        </div>
    </nav>

    {{-- contenedor principal que se expande `flex-grow` para empujar el footer hacia abajo --}}
    <div class="flex-grow container mx-auto mt-6 p-4">
        {{-- espacio donde cada vista insertara su contenido --}}
        @yield('content')
    </div>

    {{-- el footer queda en la parte de abajo porque el contenido empuja el espacio restante --}}
    <footer class="text-center mt-6 p-4 bg-gray-200 text-gray-600">
        <p>&copy; 2025 - Laravel</p>
    </footer>
</body>

</html>
