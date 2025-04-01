<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
    <nav class="bg-black p-4">
        <div class="container mx-auto">
            <a class="text-white text-lg font-bold" href="{{ route('productos.index') }}">Laravel</a>
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
