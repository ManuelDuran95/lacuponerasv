@extends('layouts.app')

@section('titulo', 'Reporte de ventas y ganancias')

@section('contenido')
<h1 class="text-2xl font-semibold text-gray-800 mb-4">Reporte de ventas y ganancias por empresa</h1>

<div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-50 text-[11px] uppercase text-gray-500">
            <tr>
                <th class="px-4 py-3">Empresa</th>
                <th class="px-4 py-3">Cupones vendidos</th>
                <th class="px-4 py-3">Total ventas ($)</th>
                <th class="px-4 py-3">Ganancia (comisión)</th>
            </tr>
        </thead>
        <tbody>
        @forelse($stats as $row)
            <tr class="border-t border-gray-100">
                <td class="px-4 py-3 text-gray-800 font-medium">
                    {{ $row->nombre_empresa }}
                </td>
                <td class="px-4 py-3 text-gray-700">
                    {{ $row->total_cupones_vendidos }}
                </td>
                <td class="px-4 py-3 font-semibold text-indigo-600">
                    ${{ number_format($row->total_ventas,2) }}
                </td>
                <td class="px-4 py-3 font-semibold text-green-600">
                    ${{ number_format($row->total_ganancias,2) }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">
                    No hay datos de ventas aún.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<p class="text-[11px] text-gray-500 mt-4">
    Nota: "Ganancia (comisión)" = total de ventas * porcentaje_comision / 100.
</p>
@endsection
