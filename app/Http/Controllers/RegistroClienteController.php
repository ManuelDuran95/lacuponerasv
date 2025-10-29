<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RegistroClienteController extends Controller
{
    public function formulario()
    {
        return view('publico.registro-cliente');
    }

    public function guardar(Request $request)
    {
        $data = $request->validate([
            'usuario'            => 'required|string|max:50|unique:usuarios,usuario',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico',
            'contrasena'         => 'required|string|min:8|confirmed',
            'nombre_completo'    => 'required|string|max:255',
            'apellidos'          => 'required|string|max:255',
            'dui'                => 'required|string|max:20',
            'fecha_nacimiento'   => 'required|date',
        ]);

        // validar edad >= 18
        $edad = Carbon::parse($data['fecha_nacimiento'])->age;
        if ($edad < 18) {
            return back()->withErrors(['fecha_nacimiento' => 'Debes ser mayor de 18 años.']);
        }

        Usuario::create([
            'usuario'            => $data['usuario'],
            'correo_electronico' => $data['correo_electronico'],
            'contrasena'         => Hash::make($data['contrasena']),
            'nombre_completo'    => $data['nombre_completo'],
            'apellidos'          => $data['apellidos'],
            'dui'                => $data['dui'],
            'fecha_nacimiento'   => $data['fecha_nacimiento'],
            'rol'                => 'USUARIO',
            'empresa_id'         => null,
        ]);

        return redirect()->route('login.form')->with('status','Registro completado, ahora puedes iniciar sesión.');
    }
}
