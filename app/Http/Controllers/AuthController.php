<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // mostrar el formulario de registro
    public function showRegisterForm() {
        return view('auth.register');
    }

    // se procesan los datos del usuario para realizar el registro
    public function register(Request $request) {
        // se validan los datos enviados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255', // `unique:users` valida que no exista mas de un registro con el mismo email en la tabla `users`

            // `confirmed` valida que en el formulario haya un campo con el mismo nombre (password) + `_confirmation`
            // si el usuario ingresa 2 contraseñas disintas en `password` y `password_confirmation`, Laravel generara un error de validacion
            'password' => 'required|min:6|confirmed'
        ]);

        // se crea el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // se almacena la contraseña encriptada
        ]);

        Auth::login($user); // se inicia sesion automaticamente despues de realizado el registro
        return redirect()->route('productos.index'); // se redirige al usuario a la vista `productos.index`
    }

    // mostrar el formulario de inicio de sesion
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // se validan las credenciales enviadas en la request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // `Auth::attemp()` verifica si el usuario existe
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // al autenticarse el usuario, Laravel regenera el ID de sesion, asegurandose que cada usuario tenga un ID de sesion unico tras iniciar sesion
            return redirect()->route('productos.index'); // si el usuario es valido se redirige a la vista `productos.index`
        }

        // si el usuario no existe o las credenciales son invalidas, se mantiene el usuario en la vista actual y se retorna un mensaje de error
        return back()->withErrors(['email' => 'Las credenciales no son correctas']);
    }

    public function logout(Request $request) {
        Auth::logout(); // cierra la sesion del usuario

        // `$request->session()->invalidate()` destruye toda la sesion del usuario, elimina todos los datos almacenados en $_SESSION (nombre de usuario, carrito de compras, etc.)
        // evita que el usuario use la sesion anterior para autenticarse de nuevo sin credenciales
        $request->session()->invalidate();

        // `$request->session()->regenerateToken()` regenera el token CSRF para evitar ataques despues de cerrar la sesion
        $request->session()->regenerateToken();

        return redirect()->route('productos.index');
    }
}
