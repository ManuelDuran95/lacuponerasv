<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nombre_empresa',
        'nit',
        'direccion',
        'telefono',
        'correo_electronico',
        'usuario',
        'contrasena',
        'estado',
        'porcentaje_comision',
    ];

    // Empresa tiene muchas ofertas
    public function ofertas() {
        return $this->hasMany(Oferta::class, 'empresa_id');
    }

    // Empresa genera compras
    public function compras() {
        return $this->hasMany(Compra::class, 'empresa_id');
    }
}
