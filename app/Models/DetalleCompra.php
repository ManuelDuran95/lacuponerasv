<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalles_compras';

    protected $fillable = [
        'compra_id',
        'oferta_id',
        'usuario_id',
        'codigo_unico',
        'precio_unitario',
        'canjeado',
    ];

    public function compra() {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function oferta() {
        return $this->belongsTo(Oferta::class, 'oferta_id');
    }

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
