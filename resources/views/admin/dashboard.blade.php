@extends('layouts.app')

@section('titulo', 'Panel de Administración')

@section('contenido')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">Panel de Administración</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('admin.empresas.pendientes') }}"
       class="block bg-white rounded-lg shadow border border-gray-200 p-4 hover:border-indigo-400 transition">
        <div class="text-sm text-gray-500">Empresas</div>
        <div class="text-lg font-semibold text-gray-800">Solicitudes pendientes</div>
    </a>

    <a href="{{ route('admin.reportes.resumen') }}"
       class="block bg-white rounded-lg shadow border border-gray-200 p-4 hover:border-indigo-400 transition">
        <div class="text-sm text-gray-500">Reportes</div>
        <div class="text-lg font-semibold text-gray-800">Ventas y ganancias</div>
    </a>
</div>
@endsection
