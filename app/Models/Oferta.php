<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $table = 'ofertas';

    protected $fillable = [
        'empresa_id',
        'titulo_oferta',
        'precio_regular',
        'precio_oferta',
        'fecha_inicio',
        'fecha_fin',
        'fecha_limite_canje',
        'cantidad_cupones',
        'descripcion',
        'estado',
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function detallesCompras() {
        return $this->hasMany(DetalleCompra::class, 'oferta_id');
    }
}
