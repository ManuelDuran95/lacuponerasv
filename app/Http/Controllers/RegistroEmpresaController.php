<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistroEmpresaController extends Controller
{
    public function formulario()
    {
        return view('publico.registro-empresa'); // Blade con Tailwind
    }

    public function guardar(Request $request)
    {
        $data = $request->validate([
            'nombre_empresa'     => 'required|string|max:255',
            'nit'                => 'required|string|max:50|unique:empresas,nit',
            'direccion'          => 'required|string',
            'telefono'           => 'required|string|max:20',
            'correo_electronico' => 'required|email|unique:empresas,correo_electronico',
            'usuario'            => 'required|string|max:50|unique:empresas,usuario',
            'contrasena'         => 'required|string|min:8|confirmed',
        ]);

        Empresa::create([
            'nombre_empresa'     => $data['nombre_empresa'],
            'nit'                => $data['nit'],
            'direccion'          => $data['direccion'],
            'telefono'           => $data['telefono'],
            'correo_electronico' => $data['correo_electronico'],
            'usuario'            => $data['usuario'],
            'contrasena'         => Hash::make($data['contrasena']),
            'estado'             => 'PENDIENTE',
            'porcentaje_comision'=> null,
        ]);

        return redirect()->route('registro-empresa.ok');
    }

    public function gracias()
    {
        return view('publico.registro-empresa-ok');
    }
}
