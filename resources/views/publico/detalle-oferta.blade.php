@extends('layouts.app')

@section('titulo', $oferta->titulo_oferta)

@section('contenido')
<div class="bg-white rounded-lg shadow border border-gray-200 p-6 max-w-3xl mx-auto ">
    <h1 class="text-2xl font-bold text-gray-800">{{ $oferta->titulo_oferta }}</h1>

    <div class="mt-2 text-sm text-gray-600">
        {{ $oferta->descripcion }}
    </div>

    <div class="mt-4 flex flex-wrap items-end gap-4">
        <div>
            <div class="text-gray-500 text-xs line-through">
                ${{ number_format($oferta->precio_regular,2) }}
            </div>
            <div class="text-3xl font-bold text-indigo-600">
                ${{ number_format($oferta->precio_oferta,2) }}
            </div>
        </div>

        <div class="text-[12px] text-gray-500">
            Oferta válida del <b>{{ $oferta->fecha_inicio }}</b>
            al <b>{{ $oferta->fecha_fin }}</b><br/>
            Límite de canje: <b>{{ $oferta->fecha_limite_canje }}</b>
        </div>
    </div>

    <div class="mt-4 text-xs text-gray-500">
        @if($oferta->cantidad_cupones)
            Stock disponible (aprox.): 
            <span class="font-semibold text-gray-700">
                {{ $oferta->cantidad_cupones }} cupones
            </span>
        @else
            Stock: <span class="font-semibold text-gray-700">Ilimitado</span>
        @endif
    </div>

    <div class="mt-6">
        @auth
            @if(auth()->user()->rol === 'USUARIO')
                <a href="{{ route('comprar.form', $oferta->id) }}"
                    class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Comprar cupón
                </a>
            @else
                <p class="text-xs text-gray-500">
                    Solo los clientes con rol USUARIO pueden comprar cupones.
                </p>
            @endif
        @endauth

        @guest
            <p class="text-sm text-gray-600">
                Debes iniciar sesión como cliente para comprar.
            </p>
            <a href="{{ route('login.form') }}"
                class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700 mt-2">
                Iniciar sesión
            </a>
        @endguest
    </div>
</div>
@endsection
