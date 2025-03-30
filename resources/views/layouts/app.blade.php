<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi tienda</title>
</head>
<body>
    <nav>
        <div>
            <a href="{{ route('productos.index') }}">Mi tienda</a>
        </div>
    </nav>

    <div>
        {{-- espacio donde cada vista insertara su contenido --}}
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2025 - Mi tienda</p>
    </footer>
</body>
</html>
