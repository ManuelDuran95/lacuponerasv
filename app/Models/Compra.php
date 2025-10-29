<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'usuario_id',
        'empresa_id',
        'total',
        'fecha_compra',
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function detalles() {
        return $this->hasMany(DetalleCompra::class, 'compra_id');
    }
}
