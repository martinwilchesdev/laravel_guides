@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 lg:px-8">
        @if ($errors->any())
            <div class="bg-red-500 text-white text-center font-semibold w-full p-2 my-2 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Iniciar sesión</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Correo electrónico</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-black sm:text-sm/6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Contraseña</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-gray-600 hover:text-gray-500">Olvidaste tu
                                contraseña?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-black sm:text-sm/6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm/6 font-semibold text-white shadow-x cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black hover:bg-black/85">Iniciar sesión</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                ¿Aún no tienes una cuenta?
                <a href="{{ route('register.form') }}" class="font-semibold text-black hover:text-black/85">Crear cuenta</a>
            </p>
        </div>
    </div>
@endsection
