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
            <input type="text" name="nit" id="nit" value="{{ old('nit') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                 placeholder="0000-000000-000-0"
                    maxlength="17"
                    required />
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nitInput = document.getElementById('nit');
    
    nitInput.addEventListener('input', function(e) {
        // Remover todo excepto números
        let value = e.target.value.replace(/\D/g, '');
        
        // Aplicar formato 0000-000000-000-0
        if (value.length > 0) {
            let formatted = value.substring(0, 4);
            if (value.length > 4) formatted += '-' + value.substring(4, 10);
            if (value.length > 10) formatted += '-' + value.substring(10, 13);
            if (value.length > 13) formatted += '-' + value.substring(13, 14);
            e.target.value = formatted;
        }
    });
});
</script>
@endsection
