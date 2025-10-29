@extends('layouts.app')

@section('titulo', 'Factura #'.$compra->id)

@section('contenido')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow border border-gray-200 p-6">
    <div class="flex flex-wrap justify-between text-sm mb-6">
        <div>
            <div class="text-lg font-semibold text-gray-800">
                Factura de compra #{{ $compra->id }}
            </div>
            <div class="text-gray-500 text-xs">
                Fecha: {{ $compra->fecha_compra }}
            </div>
            <div class="text-gray-500 text-xs">
                Empresa: {{ $compra->empresa->nombre_empresa ?? 'N/D' }}
            </div>
        </div>

        <div class="text-right">
            <div class="text-xs text-gray-500">Cliente:</div>
            <div class="text-sm font-semibold text-gray-800">
                {{ auth()->user()->nombre_completo }} {{ auth()->user()->apellidos }}
            </div>
            <div class="text-xs text-gray-500">
                DUI: {{ auth()->user()->dui }}
            </div>
        </div>
    </div>

    <table class="w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-50 text-[11px] uppercase text-gray-500">
            <tr>
                <th class="px-3 py-2">Oferta</th>
                <th class="px-3 py-2">Código único</th>
                <th class="px-3 py-2">Precio unitario</th>
            </tr>
        </thead>
        <tbody>
        @foreach($compra->detalles as $d)
            <tr class="border-t border-gray-100">
                <td class="px-3 py-2 font-medium text-gray-800">
                    {{ $d->oferta->titulo_oferta ?? 'Oferta eliminada' }}
                </td>
                <td class="px-3 py-2">
                    <span class="font-mono text-xs text-gray-900 bg-gray-100 rounded px-2 py-1 border border-gray-300">
                        {{ $d->codigo_unico }}
                    </span>
                </td>
                <td class="px-3 py-2 text-gray-800">
                    ${{ number_format($d->precio_unitario,2) }}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot class="bg-gray-50">
            <tr class="border-t border-gray-200">
                <td class="px-3 py-2 text-right text-xs text-gray-600" colspan="2">
                    Total:
                </td>
                <td class="px-3 py-2 font-semibold text-indigo-600">
                    ${{ number_format($compra->total,2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-6 text-[11px] text-gray-500">
        Este documento incluye códigos únicos por cupón. El comercio validará ese código
        al momento del canje antes de la fecha límite establecida en la oferta.
    </div>
</div>
@endsection
