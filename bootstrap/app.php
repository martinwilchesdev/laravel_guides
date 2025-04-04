<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // si el usuario no esta autenticado, al acceder a las rutas protegidas con el middleware `auth` seran redirigidos a la ruta `/login`
        $middleware->redirectGuestsTo('login');

        // si el usuario esta autenticado, al acceder a rutas con el middleware `guest`, seran redirigidos a la ruta `/productos`
        $middleware->redirectUsersTo('productos');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
