<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'correo_electronico',
        'contrasena',
        'nombre_completo',
        'apellidos',
        'dui',
        'fecha_nacimiento',
        'rol',
        'empresa_id',
    ];

    protected $hidden = [
        'contrasena',
    ];

    // Para que Auth::attempt use 'contrasena' en vez de 'password'
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function compras() {
        return $this->hasMany(Compra::class, 'usuario_id');
    }
}
