@extends('layouts.app')

@section('titulo', 'Recuperar Contraseña')

@section('contenido')
<div class="min-h-[70vh] w-full flex items-center justify-center">
    <div class="w-full max-w-sm bg-white rounded-xl shadow-lg border border-gray-200 p-6 text-left">

        <!-- Encabezado -->
        <div class="text-center mb-6">
            <div class="text-indigo-600 font-bold text-lg tracking-tight">
                La Cuponera SV
            </div>
            <h1 class="mt-2 text-xl font-semibold text-gray-800">
                Recuperar Contraseña
            </h1>
            <p class="text-xs text-gray-500 mt-1">
                Ingresa tu correo electrónico para restablecer tu contraseña
            </p>
        </div>

        <!-- Mensajes de estado -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-md p-3">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Correo Electrónico -->
            <div class="flex flex-col space-y-1">
                <label for="email" class="text-sm font-medium text-gray-700">
                    Correo Electrónico
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                    required
                    autofocus
                    placeholder="ejemplo@correo.com"
                />
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botón -->
            <button
                type="submit"
                class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-white text-sm font-medium hover:bg-indigo-700 transition cursor-pointer"
            >
                Enviar Enlace de Recuperación
            </button>
        </form>

        <!-- Volver al login -->
        <p class="text-[11px] text-gray-500 text-center mt-6">
            ¿Recordaste tu contraseña?
            <a href="{{ route('login.form') }}"
               class="text-indigo-600 hover:text-indigo-700 hover:underline font-medium">
                Iniciar sesión
            </a>
        </p>
    </div>
</div>
@endsection