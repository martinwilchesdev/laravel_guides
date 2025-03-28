<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de productos</title>
</head>
<body>
    <h1>Lista de productos</h1>
    <ul>
        {{-- La directiva `@foreach` permite iterar un array dentro de una vista --}}
        @foreach ($productos as $producto)
            <li>{{ $producto->nombre }} - {{ $producto->precio }}</li>
        @endforeach
    </ul>
</body>
</html>
