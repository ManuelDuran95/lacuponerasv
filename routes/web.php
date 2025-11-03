<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // ensure we type-hint the HTTP Request, not the Facade
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroClienteController;
use App\Http\Controllers\RegistroEmpresaController;
use App\Http\Controllers\AdminEmpresaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ReporteController;

use App\Http\Controllers\Auth\ForgotPasswordController;



// PÚBLICO
Route::get('/', [OfertaController::class, 'indexPublico'])->name('ofertas.publicas');
Route::get('/oferta/{id}', [OfertaController::class, 'detallePublico'])->name('oferta.detalle');

// Registro cliente
Route::get('/registro-cliente', [RegistroClienteController::class, 'formulario'])->name('registro-cliente.form');
Route::post('/registro-cliente', [RegistroClienteController::class, 'guardar'])->name('registro-cliente.guardar');

// Registro empresa
Route::get('/registro-empresa', [RegistroEmpresaController::class, 'formulario'])->name('registro-empresa.form');
Route::post('/registro-empresa', [RegistroEmpresaController::class, 'guardar'])->name('registro-empresa.guardar');
Route::get('/registro-empresa/gracias', [RegistroEmpresaController::class, 'gracias'])->name('registro-empresa.ok');

// AUTH
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.do');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// RUTAS CLIENTE (USUARIO)
Route::middleware(['auth','rol:USUARIO'])->group(function () {
    Route::get('/comprar/{ofertaId}', [CompraController::class, 'formularioPago'])->name('comprar.form');
    Route::post('/comprar/{ofertaId}', [CompraController::class, 'procesarCompra'])->name('comprar.procesar');

    Route::get('/mis-compras', [CompraController::class, 'misCompras'])->name('mis-compras');
    Route::get('/factura/{compraId}', [CompraController::class, 'factura'])->name('factura.ver');   
});

// RESET PASSWORD (real) - rutas adicionales
Route::middleware('guest')->group(function () {
    Route::post('/forgot-password/send', function (Request $request) {
        $request->validate([
            'email' => ['required','email','exists:usuarios,correo_electronico'],
        ], [
            'email.exists' => 'No encontramos un usuario con ese correo.',
        ]);

        $status = Password::broker()->sendResetLink([
            'correo_electronico' => $request->input('email'),
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email.real');

    Route::get('/reset-password/{token}', function (Request $request, $token) {
        return view('publico.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required','email','exists:usuarios,correo_electronico'],
            'password' => ['required','confirmed','min:8'],
        ]);

        $status = Password::reset([
            'token'               => $request->input('token'),
            'correo_electronico'  => $request->input('email'),
            'password'            => $request->input('password'),
        ], function ($user, $password) {
            $user->forceFill([
                'contrasena' => Hash::make($password),
            ]);

            // Evitar error si no existe columna remember_token
            // $user->setRememberToken(Str::random(60));
            $user->save();
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.form')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->name('password.update');
});

// RUTAS EMPRESA
Route::middleware(['auth','rol:EMPRESA'])->group(function () {
    Route::get('/empresa/dashboard', function () {
        return view('empresa.dashboard');
    })->name('empresa.dashboard');

    Route::get('/empresa/ofertas/crear', [OfertaController::class, 'crear'])->name('empresa.ofertas.crear');
    Route::post('/empresa/ofertas', [OfertaController::class, 'guardar'])->name('empresa.ofertas.guardar');

});

// RUTAS ADMIN
Route::middleware(['auth','rol:ADMIN'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // aprobar / rechazar empresas
    Route::get('/admin/empresas/pendientes', [AdminEmpresaController::class, 'pendientes'])
        ->name('admin.empresas.pendientes');

    Route::post('/admin/empresas/{id}/aprobar', [AdminEmpresaController::class, 'aprobar'])
        ->name('admin.empresas.aprobar');

    Route::post('/admin/empresas/{id}/rechazar', [AdminEmpresaController::class, 'rechazar'])
        ->name('admin.empresas.rechazar');

    // reportes
    Route::get('/admin/reportes/resumen', [ReporteController::class, 'resumen'])
        ->name('admin.reportes.resumen');
});

// RESET PASSWORD ROUTES 
Route::middleware('guest')->group(function () {
    // Vista del formulario (GET)
    Route::view('/forgot-password', 'publico.forgot-password')
        ->name('password.request');
    
    // Procesar el formulario (POST)
    Route::post('/forgot-password', function (Request $request) {
        // Validación básica
        $request->validate([
            'email' => 'required|email'
        ]);
        
        // Aquí va tu lógica para enviar el correo de recuperación
        // Por ahora solo redirigimos con un mensaje
        return back()->with('status', 'Se ha enviado un enlace de recuperación a tu correo electrónico.');
    })->name('password.email');
});
