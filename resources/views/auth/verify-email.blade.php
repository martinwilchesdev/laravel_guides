@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">

            @if (session('message'))
                <div class="bg-green-100 text-green-700 p-2 mb-4 rounded-lg mt-3 text-center">
                    {{ session('message') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold text-center mb-4">Verifica tu correo</h2>
            <p class="text-gray-600 text-center">Se ha enviado un correo de verificación a tu dirección de email. Por favor
                revisa tu bandeja de entrada.</p>

            <form action="{{ route('verification.send') }}" method="POST" class="mt-4 text-center">
                @csrf

                <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-black/85">
                    Reenviar
                </button>
            </form>
        </div>
    </div>
@endsection
