<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\AdminResetPassword;
use App\Notifications\EmpresaResetPassword;

class Usuario extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPasswordTrait;

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

    // Para compatibilidad con el broker de contraseñas, que espera "email"
    public function getEmailForPasswordReset()
    {
        return $this->correo_electronico;
    }

    // Notificaciones por correo (ResetPassword usa Notifications)
    public function routeNotificationForMail($notification = null)
    {
        return $this->correo_electronico;
    }

    // Forzar mailer según rol al enviar la notificación de reseteo
    public function sendPasswordResetNotification($token)
    {
        if ($this->rol === 'ADMIN') {
            $this->notify(new AdminResetPassword($token));
            return;
        }

        if ($this->rol === 'EMPRESA') {
            $this->notify(new EmpresaResetPassword($token));
            return;
        }

        $this->notify(new ResetPasswordNotification($token));
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function compras() {
        return $this->hasMany(Compra::class, 'usuario_id');
    }
}
