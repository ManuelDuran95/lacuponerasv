<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function resumen()
    {
        // total de cupones vendidos, total ventas $, total ganancias $
        $stats = DB::table('detalles_compras')
            ->join('compras','detalles_compras.compra_id','=','compras.id')
            ->join('empresas','compras.empresa_id','=','empresas.id')
            ->select(
                'empresas.id as empresa_id',
                'empresas.nombre_empresa',
                DB::raw('COUNT(detalles_compras.id) as total_cupones_vendidos'),
                DB::raw('SUM(detalles_compras.precio_unitario) as total_ventas'),
                DB::raw('SUM(detalles_compras.precio_unitario * (empresas.porcentaje_comision/100)) as total_ganancias')
            )
            ->groupBy('empresas.id','empresas.nombre_empresa','empresas.porcentaje_comision')
            ->get();

        return view('admin.reportes.resumen', compact('stats'));
    }
}
