@extends('layouts.app')

@section('titulo', 'Restablecer Contraseña')

@section('contenido')
<div class="min-h-[70vh] w-full flex items-center justify-center">
    <div class="w-full max-w-sm bg-white rounded-xl shadow-lg border border-gray-200 p-6 text-left">

        <div class="text-center mb-6">
            <div class="text-indigo-600 font-bold text-lg tracking-tight">La Cuponera SV</div>
            <h1 class="mt-2 text-xl font-semibold text-gray-800">Definir nueva contraseña</h1>
            <p class="text-xs text-gray-500 mt-1">Ingresa y confirma tu nueva contraseña</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-md p-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}" />

            <div class="flex flex-col space-y-1">
                <label for="email" class="text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $email) }}"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                    required
                    autocomplete="email"
                />
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col space-y-1">
                <label for="password" class="text-sm font-medium text-gray-700">Nueva contraseña</label>
                <input id="password" name="password" type="password" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 @error('password') border-red-500 @enderror" required autocomplete="new-password" />
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col space-y-1">
                <label for="password_confirmation" class="text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500" required autocomplete="new-password" />
            </div>

            <button type="submit" class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-white text-sm font-medium hover:bg-indigo-700 transition cursor-pointer">
                Guardar nueva contraseña
            </button>
        </form>

        <p class="text-[11px] text-gray-500 text-center mt-6">
            ¿Recordaste tu contraseña?
            <a href="{{ route('login.form') }}" class="text-indigo-600 hover:text-indigo-700 hover:underline font-medium">Iniciar sesión</a>
        </p>
    </div>
    </div>
@endsection

