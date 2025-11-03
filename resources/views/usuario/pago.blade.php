@extends('layouts.app')

@section('titulo', 'Comprar cupón')

@section('contenido')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">
        Comprar: {{ $oferta->titulo_oferta }}
    </h1>

    <div class="mb-4 text-sm text-gray-600">
        <div class="flex items-baseline gap-2">
            <span class="text-gray-400 line-through text-xs">
                ${{ number_format($oferta->precio_regular,2) }}
            </span>
            <span class="text-xl font-bold text-indigo-600">
                ${{ number_format($oferta->precio_oferta,2) }}
            </span>
        </div>
        <p class="text-[12px] text-gray-500 mt-1">
            Máximo 5 cupones por cliente.
        </p>
    </div>

    <form method="POST" action="{{ route('comprar.procesar', $oferta->id) }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad a comprar</label>
            <input type="number" min="1" max="5" name="cantidad" value="{{ old('cantidad',1) }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Número de tarjeta</label>
            <input type="text" name="numero_tarjeta" value="{{ old('numero_tarjeta') }}"
                class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha vencimiento (MM/YY)</label>
                <input type="text" name="fecha_vencimiento" placeholder="09/28" value="{{ old('fecha_vencimiento') }}"
                    class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                <input type="text" name="cvv" value="{{ old('cvv') }}"
                    class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required />
            </div>
        </div>

        <button type="submit"
            class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700 cursor-pointer">
            Confirmar compra
        </button>
    </form>
</div>
@endsection
