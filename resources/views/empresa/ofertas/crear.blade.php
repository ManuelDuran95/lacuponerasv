@extends('layouts.app')

@section('titulo', 'Nueva Oferta')

@section('contenido')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Publicar nueva oferta</h1>

    <form method="POST" action="{{ route('empresa.ofertas.guardar') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Título de la oferta</label>
            <input name="titulo_oferta" value="{{ old('titulo_oferta') }}" required
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Precio regular ($)</label>
            <input type="number" step="0.01" min="0" name="precio_regular" value="{{ old('precio_regular') }}" required
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Precio de oferta ($)</label>
            <input type="number" step="0.01" min="0" name="precio_oferta" value="{{ old('precio_oferta') }}" required
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha inicio oferta</label>
            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha fin oferta</label>
            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"/>
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha límite de canje</label>
            <input type="date" name="fecha_limite_canje" value="{{ old('fecha_limite_canje') }}" required
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"/>
        </div>

        <div class="md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad de cupones (opcional)</label>
            <input type="number" min="1" name="cantidad_cupones" value="{{ old('cantidad_cupones') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm"/>
            <p class="text-[11px] text-gray-500 mt-1">Deja vacío = ilimitado.</p>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" rows="3" required
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('descripcion') }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
            <select name="estado"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                <option value="DISPONIBLE" @selected(old('estado')==='DISPONIBLE')>DISPONIBLE</option>
                <option value="NO_DISPONIBLE" @selected(old('estado')==='NO_DISPONIBLE')>NO_DISPONIBLE</option>
            </select>
        </div>

        <div class="md:col-span-2">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700 cursor-pointer">
                Publicar oferta
            </button>
        </div>
    </form>
</div>
@endsection
