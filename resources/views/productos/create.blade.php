<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear producto</title>
</head>
<body>
    <h1>Agregar nuevo producto</h1>

    {{-- Se muestra un mensaje de error si hay problemas con la validacion --}}
    @if ($errors->any())
        <div style="color: red;">
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

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required><br>

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion"></textarea><br>

        <button type="submit">Guardar producto</button>
    </form>

    <a href="{{ url('/productos') }}">Volver a la lista</a>
</body>
</html>
