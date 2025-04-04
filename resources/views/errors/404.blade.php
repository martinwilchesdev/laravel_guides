@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
<div class="text-center py-12">
    <p class="text-6xl font-semibold text-blue-500">404</p>
    <h1 class="mt-4 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">Página no
        encontrada
    </h1>
    <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">Disculpa, no hemos podido encontrar la
        página que buscas.</p>
    <div class="mt-10 flex items-center justify-center gap-x-6">
        <a href="{{ route('productos.index') }}"
            class="rounded-md bg-black px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-black/85 focus-visible:outline-2 focus-visible:outline-offset-2">Volver
            al inicio</a>
    </div>
</div>
@endsection
