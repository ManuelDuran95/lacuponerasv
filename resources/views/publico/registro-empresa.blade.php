@extends('layouts.app')

@section('titulo', 'Registro de empresa')

@section('contenido')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Registro de Empresa</h1>
    <p class="text-sm text-gray-600 mb-6">
        Envía tu solicitud para crear una cuenta de empresa.
    </p>

    <form method="POST" action="{{ route('registro-empresa.guardar') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de empresa</label>
            <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">NIT</label>
            <input type="text" name="nit" value="{{ old('nit') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
            <textarea name="direccion" rows="2"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                required>{{ old('direccion') }}</textarea>
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
            <input type="text" name="usuario" value="{{ old('usuario') }}"
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

        <div class="md:col-span-2">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700">
                Enviar solicitud
            </button>
        </div>
    </form>
</div>
@endsection
