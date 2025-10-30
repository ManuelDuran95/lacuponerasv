<?php

use Illuminate\Support\Facades\Route;
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