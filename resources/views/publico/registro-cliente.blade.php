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
            <input type="text" name="dui" id="dui" value="{{ old('dui') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                placeholder="00000000-0"
                maxlength="10"
                required />
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const duiInput = document.getElementById('dui');
    
    duiInput.addEventListener('input', function(e) {
        // Remover todo excepto números
        let value = e.target.value.replace(/\D/g, '');
        
        // Aplicar formato 00000000-0
        if (value.length <= 8) {
            e.target.value = value;
        } else if (value.length === 9) {
            e.target.value = value.substring(0, 8) + '-' + value.substring(8, 9);
        }
    });
    
    // También manejar el pegado de texto
    duiInput.addEventListener('paste', function(e) {
        setTimeout(function() {
            let value = duiInput.value.replace(/\D/g, '');
            if (value.length <= 8) {
                duiInput.value = value;
            } else if (value.length === 9) {
                duiInput.value = value.substring(0, 8) + '-' + value.substring(8, 9);
            }
        }, 0);
    });
});
</script>

@endsection
