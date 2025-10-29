<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminEmpresaController extends Controller
{
    // Lista de empresas pendientes para que el admin las revise
    public function pendientes()
    {
        $pendientes = Empresa::where('estado', 'PENDIENTE')->get();

        return view('admin.empresas.pendientes', compact('pendientes'));
    }

    // Aprobar
    public function aprobar(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $datos = $request->validate([
            'porcentaje_comision' => 'required|numeric|min:0|max:100',
        ]);

        // Marcar empresa como aprobada
        $empresa->estado = 'APROBADA';
        $empresa->porcentaje_comision = $datos['porcentaje_comision'];
        $empresa->save();

        // Crear el usuario que podrá iniciar sesión con rol EMPRESA
        $usuarioEmpresa = Usuario::create([
            'usuario'            => $empresa->usuario,
            'correo_electronico' => $empresa->correo_electronico,
            'contrasena'         => $empresa->contrasena, // ya está hasheada
            'nombre_completo'    => $empresa->nombre_empresa,
            'apellidos'          => '', // la empresa no necesita apellidos
            'dui'                => null,
            'fecha_nacimiento'   => '1900-01-01',
            'rol'                => 'EMPRESA',
            'empresa_id'         => $empresa->id,
        ]);

        return redirect()->back()->with('status', 'Empresa aprobada y usuario creado.');
    }

    // Rechazar
    public function rechazar($id)
    {
        $empresa = Empresa::findOrFail($id);

        $empresa->estado = 'RECHAZADA';
        $empresa->save();

        return redirect()->back()->with('status', 'Empresa rechazada.');
    }
}
