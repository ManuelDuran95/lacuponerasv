<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('publico.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'usuario'    => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if (Auth::attempt([
            'usuario'  => $credenciales['usuario'],
            'password' => $credenciales['contrasena'],
        ])) {
            $request->session()->regenerate();

            $rol = Auth::user()->rol;

            if ($rol === 'ADMIN') {
                return redirect()->route('admin.dashboard');
            }

            if ($rol === 'EMPRESA') {
                return redirect()->route('empresa.dashboard');
            }

            // USUARIO normal
            return redirect()->route('ofertas.publicas');
        }

        return back()->withErrors(['login' => 'Credenciales inválidas']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }

   
}
