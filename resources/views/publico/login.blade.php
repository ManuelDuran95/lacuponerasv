@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('contenido')
<div class="min-h-[70vh] w-full flex items-center justify-center">
    <div class="w-full max-w-sm bg-white rounded-xl shadow-lg border border-gray-200 p-6 text-left">

        <!-- Encabezado -->
        <div class="text-center mb-6">
            <div class="text-indigo-600 font-bold text-lg tracking-tight">
                La Cuponera SV
            </div>
            <h1 class="mt-2 text-xl font-semibold text-gray-800">
                Iniciar sesión
            </h1>
            <p class="text-xs text-gray-500 mt-1">
                Ingresa tus credenciales para continuar
            </p>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login.do') }}" class="space-y-4">
            @csrf

            <!-- Usuario -->
            <div class="flex flex-col space-y-1">
                <label class="text-sm font-medium text-gray-700">
                    Usuario
                </label>
                <input
                    type="text"
                    name="usuario"
                    value="{{ old('usuario') }}"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500"
                    required
                />
            </div>

            <!-- Contraseña -->
            <div class="flex flex-col space-y-1">
                <label class="text-sm font-medium text-gray-700">
                    Contraseña
                </label>
                <input
                    type="password"
                    name="contrasena"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500"
                    required
                />
            </div>

                 <!-- Enlace de recuperación de contraseña -->
            <div class="text-right">
                <a href="{{ route('password.request') }}" 
                   class="text-xs text-indigo-600 hover:text-indigo-700 hover:underline font-medium">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <!-- Botón -->
            <button
                type="submit"
                class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-white text-sm font-medium hover:bg-indigo-700 transition cursor-pointer"
            >
                Entrar
            </button>
        </form>

        <!-- Registro -->
        <p class="text-[11px] text-gray-500 text-center mt-6">
            ¿No tienes cuenta?
            <a href="{{ route('registro-cliente.form') }}"
               class="text-indigo-600 hover:text-indigo-700 hover:underline font-medium">
                Regístrate
            </a>
        </p>
    </div>
</div>
@endsection
