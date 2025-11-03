@extends('layouts.app')

@section('titulo', 'Empresas pendientes')

@section('contenido')
<h1 class="text-2xl font-semibold text-gray-800 mb-4">Empresas pendientes de aprobación</h1>

@if($pendientes->isEmpty())
    <div class="text-sm text-gray-500">No hay solicitudes pendientes.</div>
@else
    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-50 text-gray-500 uppercase text-[11px]">
                <tr>
                    <th class="px-4 py-3">Empresa</th>
                    <th class="px-4 py-3">NIT</th>
                    <th class="px-4 py-3">Contacto</th>
                    <th class="px-4 py-3">Usuario</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendientes as $e)
                    <tr class="border-t border-gray-100 align-top">
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-800">{{ $e->nombre_empresa }}</div>
                            <div class="text-xs text-gray-500">{{ $e->direccion }}</div>
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-700">
                            {{ $e->nit }}
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-700">
                            <div>{{ $e->telefono }}</div>
                            <div class="text-indigo-600">{{ $e->correo_electronico }}</div>
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-700">
                            {{ $e->usuario }}
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-700 w-64 space-y-3">
                            <!-- Form aprobar -->
                            <form method="POST" action="{{ route('admin.empresas.aprobar', $e->id) }}"
                                  class="bg-green-50 border border-green-300 rounded-md p-3 space-y-2">
                                @csrf
                                <label class="block text-[11px] text-gray-700 font-medium mb-1">
                                    % Comisión (0-100)
                                </label>
                                <input type="number" step="0.01" min="0" max="100" name="porcentaje_comision"
                                    class="w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 text-xs"
                                    placeholder="Ej. 20"
                                    required />

                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md bg-green-600 px-3 py-1.5 text-white text-[11px] font-medium hover:bg-green-700 cursor-pointer">
                                    Aprobar y crear acceso
                                </button>
                            </form>

                            <!-- Form rechazar -->
                            <form method="POST" action="{{ route('admin.empresas.rechazar', $e->id) }}"
                                  class="bg-red-50 border border-red-300 rounded-md p-3">
                                @csrf
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md bg-red-600 px-3 py-1.5 text-white text-[11px] font-medium hover:bg-red-700 cursor-pointer">
                                    Rechazar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
