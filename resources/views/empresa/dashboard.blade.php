@extends('layouts.app')

@section('titulo', 'Panel de Empresa')

@section('contenido')
<h1 class="text-2xl font-semibold text-gray-800 mb-4">Panel de Empresa</h1>

<div class="mb-6">
    <a href="{{ route('empresa.ofertas.crear') }}"
       class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700">
        + Publicar nueva oferta
    </a>
</div>

@php
    $empresa = auth()->user()->empresa;
    $misOfertas = $empresa ? $empresa->ofertas()->orderBy('created_at','desc')->get() : collect([]);
@endphp

@if($misOfertas->isEmpty())
    <div class="text-sm text-gray-500">
        Aún no has publicado ofertas.
    </div>
@else
    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-50 text-gray-500 uppercase text-[11px]">
                <tr>
                    <th class="px-4 py-3">Título</th>
                    <th class="px-4 py-3">Precio oferta</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Vigencia</th>
                    <th class="px-4 py-3">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($misOfertas as $o)
                    <tr class="border-t border-gray-100">
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $o->titulo_oferta }}
                        </td>
                        <td class="px-4 py-3 text-indigo-600 font-semibold">
                            ${{ number_format($o->precio_oferta,2) }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-[11px] font-medium
                                {{ $o->estado==='DISPONIBLE'
                                    ? 'bg-green-100 text-green-700 border border-green-300'
                                    : 'bg-gray-100 text-gray-600 border border-gray-300' }}">
                                {{ $o->estado }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-600">
                            {{ $o->fecha_inicio }} → {{ $o->fecha_fin }}
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-600">
                            @if($o->cantidad_cupones)
                                {{ $o->cantidad_cupones }}
                            @else
                                Ilimitado
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
