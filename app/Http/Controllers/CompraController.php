<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Compra;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    // Formulario de pago para una oferta específica
    public function formularioPago($ofertaId)
    {
        $oferta = Oferta::findOrFail($ofertaId);
        return view('usuario.pago', compact('oferta'));
    }

    // Procesar compra
    public function procesarCompra(Request $request, $ofertaId)
    {
        $usuario = Auth::user();
        if ($usuario->rol !== 'USUARIO') {
            abort(403,'Solo clientes pueden comprar');
        }

        $data = $request->validate([
            'cantidad'           => 'required|integer|min:1|max:5',
            'numero_tarjeta'     => 'required|string|min:13|max:19', // validación simple
            'fecha_vencimiento'  => 'required|string', // formato MM/YY o MM/YYYY
            'cvv'                => 'required|string|min:3|max:4',
        ]);

        $oferta = Oferta::findOrFail($ofertaId);

        // validar vigencia de la oferta
        $hoy = Carbon::today()->toDateString();
        if (
            $oferta->estado !== 'DISPONIBLE' ||
            $oferta->fecha_inicio > $hoy ||
            $oferta->fecha_fin < $hoy
        ) {
            return back()->withErrors('La oferta no está disponible actualmente.');
        }

        // validar límite de 5 cupones por usuario/oferta
        $yaComprados = DetalleCompra::where('usuario_id',$usuario->id)
            ->where('oferta_id',$oferta->id)
            ->count();

        if ($yaComprados + $data['cantidad'] > 5) {
            return back()->withErrors('Máximo 5 cupones por oferta.');
        }

        // validar stock si aplica
        if (!is_null($oferta->cantidad_cupones)) {
            $vendidos = DetalleCompra::where('oferta_id',$oferta->id)->count();
            $restantes = $oferta->cantidad_cupones - $vendidos;

            if ($data['cantidad'] > $restantes) {
                return back()->withErrors("Solo quedan {$restantes} cupones disponibles.");
            }
        }

        // Validar tarjeta no vencida
        // Suponiendo formato MM/YY
        [$mm, $yy] = explode('/', $data['fecha_vencimiento']);
        $mes = (int)$mm;
        $anio = (int)('20'.$yy); // ej. "27" => 2027
        $vencimiento = Carbon::create($anio, $mes, 1)->endOfMonth();
        if ($vencimiento->lt(Carbon::now())) {
            return back()->withErrors('Tarjeta vencida.');
        }

        // Calcular total
        $precioUnit = $oferta->precio_oferta;
        $total = $precioUnit * $data['cantidad'];

        DB::transaction(function () use ($usuario, $oferta, $data, $precioUnit, $total) {
            // Crear compra (cabecera/factura)
            $compra = Compra::create([
                'usuario_id'   => $usuario->id,
                'empresa_id'   => $oferta->empresa_id,
                'total'        => $total,
                'fecha_compra' => Carbon::now(),
            ]);

            // Crear detalle por cada cupón
            for ($i=0; $i < $data['cantidad']; $i++) {
                DetalleCompra::create([
                    'compra_id'      => $compra->id,
                    'oferta_id'      => $oferta->id,
                    'usuario_id'     => $usuario->id,
                    'codigo_unico'   => Str::upper(Str::random(10)),
                    'precio_unitario'=> $precioUnit,
                    'canjeado'       => false,
                ]);
            }
        });

        return redirect()->route('mis-compras')
            ->with('status','Compra realizada. Tu factura y cupones están disponibles.');
    }

    // Historial de compras del cliente
    public function misCompras()
    {
        $usuario = Auth::user();
        $compras = Compra::where('usuario_id',$usuario->id)
            ->with('detalles.oferta')
            ->orderBy('fecha_compra','desc')
            ->get();

        return view('usuario.mis-compras', compact('compras'));
    }

    // Factura específica (con códigos únicos)
    public function factura($compraId)
    {
        $usuario = Auth::user();
        $compra = Compra::where('id',$compraId)
            ->where('usuario_id',$usuario->id)
            ->with(['detalles.oferta','empresa'])
            ->firstOrFail();

        return view('usuario.factura', compact('compra'));
    }
}
