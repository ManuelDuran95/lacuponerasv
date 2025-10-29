@extends('layouts.app')

@section('titulo', 'Ofertas disponibles')

@section('contenido')
    <div class="mb-6">
        <h1 class="text-4xl font-bold text-gray-800 text-center items-center">
            Cupones disponibles
        </h1>
        <p class="text-sm text-gray-500 text-center items-center">
            Ahorra hoy. Canjea cuando quieras
        </p>
    </div>

    @if ($ofertas->isEmpty())
        <div class="text-gray-500 text-sm bg-white border border-gray-200 rounded-lg shadow p-6">
            No hay ofertas disponibles en este momento.
        </div>
    @else
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($ofertas as $oferta)
                <div class="bg-white rounded-xl shadow border border-gray-200 flex flex-col text-center">
                    <div class="px-5 py-6 flex-1 flex flex-col">
                        <h2 class="text-lg font-semibold text-gray-800">
                            {{ $oferta->titulo_oferta }}
                        </h2>

                        <p class="text-sm text-gray-600 mt-2">
                            {{ $oferta->descripcion }}
                        </p>

                        <div class="mt-4">
                            <div class="text-gray-400 text-xs line-through">
                                ${{ number_format($oferta->precio_regular, 2) }}
                            </div>

                            <div class="text-2xl font-bold text-indigo-600">
                                ${{ number_format($oferta->precio_oferta, 2) }}
                            </div>

                            <div class="text-[11px] text-gray-400 mt-2">
                                Válida {{ $oferta->fecha_inicio }} → {{ $oferta->fecha_fin }}
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pb-5 pt-2">
                        <a href="{{ route('oferta.detalle', $oferta->id) }}"
                            class="inline-flex mx-auto justify-center rounded-md bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2 text-white text-sm font-semibold tracking-wide hover:from-indigo-700 hover:to-purple-700 transition shadow">
                            Comprar 
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
