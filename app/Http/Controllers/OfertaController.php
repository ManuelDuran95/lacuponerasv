<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OfertaController extends Controller
{
    // Lista pública (home del sitio)
    public function indexPublico()
    {
        $hoy = Carbon::today()->toDateString();

        $ofertas = Oferta::where('estado','DISPONIBLE')
            ->where('fecha_inicio','<=',$hoy)
            ->where('fecha_fin','>=',$hoy)
            ->get();

        return view('publico.ofertas', compact('ofertas'));
    }

    // Formulario para EMPRESA crear oferta
    public function crear()
    {
        // solo EMPRESA
        return view('empresa.ofertas.crear');
    }

    public function guardar(Request $request)
    {
        $empresa = Auth::user()->empresa; // usuario rol EMPRESA tiene empresa_id
        if (!$empresa) {
            abort(403,'Solo empresas aprobadas pueden publicar');
        }

        $data = $request->validate([
            'titulo_oferta'        => 'required|string|max:255',
            'precio_regular'       => 'required|numeric|min:0',
            'precio_oferta'        => 'required|numeric|min:0|lt:precio_regular',
            'fecha_inicio'         => 'required|date',
            'fecha_fin'            => 'required|date|after_or_equal:fecha_inicio',
            'fecha_limite_canje'   => 'required|date|after_or_equal:fecha_fin',
            'cantidad_cupones'     => 'nullable|integer|min:1',
            'descripcion'          => 'required|string',
            'estado'               => 'required|in:DISPONIBLE,NO_DISPONIBLE',
        ]);

        Oferta::create([
            'empresa_id'          => $empresa->id,
            'titulo_oferta'       => $data['titulo_oferta'],
            'precio_regular'      => $data['precio_regular'],
            'precio_oferta'       => $data['precio_oferta'],
            'fecha_inicio'        => $data['fecha_inicio'],
            'fecha_fin'           => $data['fecha_fin'],
            'fecha_limite_canje'  => $data['fecha_limite_canje'],
            'cantidad_cupones'    => $data['cantidad_cupones'] ?? null,
            'descripcion'         => $data['descripcion'],
            'estado'              => $data['estado'],
        ]);

        return redirect()->route('empresa.dashboard')
            ->with('status','Oferta creada');
    }

    public function detallePublico($id)
    {
        $oferta = Oferta::findOrFail($id);
        return view('publico.detalle-oferta', compact('oferta'));
    }
}
