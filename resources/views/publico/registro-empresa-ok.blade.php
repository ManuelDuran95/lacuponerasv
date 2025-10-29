@extends('layouts.app')

@section('titulo', 'Solicitud enviada')

@section('contenido')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-6 text-center">
    <h1 class="text-xl font-semibold text-gray-800 mb-2">¡Solicitud enviada!</h1>
    <p class="text-sm text-gray-600">
        Hemos recibido los datos de tu empresa. Un administrador revisará tu información
        y, si es aprobada, activaremos tu acceso al panel de empresa.
    </p>

    <a href="{{ route('ofertas.publicas') }}"
       class="mt-6 inline-block text-sm font-medium text-indigo-600 hover:text-indigo-800">
        Volver a las ofertas
    </a>
</div>
@endsection
