@extends('layouts.app')

@section('titulo', 'Registro de cliente')

@section('contenido')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Crear cuenta cliente</h1>

    <form method="POST" action="{{ route('registro-cliente.guardar') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
            <input type="text" name="usuario" value="{{ old('usuario') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
            <input type="password" name="contrasena"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
            <input type="password" name="contrasena_confirmation"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
            <input type="text" name="nombre_completo" value="{{ old('nombre_completo') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
            <input type="text" name="apellidos" value="{{ old('apellidos') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">DUI</label>
            <input type="text" name="dui" value="{{ old('dui') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
            <p class="text-[11px] text-gray-500 mt-1">Debes ser mayor de 18 años</p>
        </div>

        <div class="md:col-span-2">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700">
                Crear cuenta
            </button>
        </div>
    </form>
     <p class="text-[11px] text-gray-500 text-center mt-6">
           tienes una empresa y  quieres publicar ofertas?
            <a href="{{ route('registro-empresa.form') }}"
               class="text-indigo-600 hover:text-indigo-700 hover:underline font-medium">
                Regístrate
            </a>
        </p>

</div>
@endsection
