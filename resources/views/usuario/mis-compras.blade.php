@extends('layouts.app')

@section('titulo', 'Mis compras')

@section('contenido')
<h1 class="text-2xl font-semibold text-gray-800 mb-4">Mis compras</h1>

@if($compras->isEmpty())
    <div class="text-sm text-gray-500">
        Aún no has realizado compras.
    </div>
@else
    <div class="space-y-6">
        @foreach($compras as $compra)
            <div class="bg-white rounded-lg shadow border border-gray-200 p-4">
                <div class="flex flex-wrap justify-between text-sm">
                    <div>
                        <div class="text-gray-800 font-semibold">
                            Compra #{{ $compra->id }}
                        </div>
                        <div class="text-gray-500 text-xs">
                            Fecha: {{ $compra->fecha_compra }}
                        </div>
                        <div class="text-indigo-600 font-bold">
                            Total: ${{ number_format($compra->total,2) }}
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('factura.ver', $compra->id) }}"
                           class="text-indigo-600 text-sm font-medium hover:text-indigo-800 underline">
                            Ver factura / cupones
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <table class="w-full text-xs text-left text-gray-700">
                        <thead class="bg-gray-50 text-[11px] uppercase text-gray-500">
                            <tr>
                                <th class="px-2 py-2">Oferta</th>
                                <th class="px-2 py-2">Precio</th>
                                <th class="px-2 py-2">Código único</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($compra->detalles as $detalle)
                            <tr class="border-t border-gray-100">
                                <td class="px-2 py-2 font-medium text-gray-800">
                                    {{ $detalle->oferta->titulo_oferta ?? 'Oferta eliminada' }}
                                </td>
                                <td class="px-2 py-2 text-gray-700">
                                    ${{ number_format($detalle->precio_unitario,2) }}
                                </td>
                                <td class="px-2 py-2 font-mono text-[11px] text-gray-900">
                                    {{ $detalle->codigo_unico }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @endforeach
    </div>
@endif
@endsection
