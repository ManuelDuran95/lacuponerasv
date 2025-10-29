<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'usuario'            => 'admin',
            'correo_electronico' => 'admin@cuponera.test',
            'contrasena'         => Hash::make('Admin1234!'),
            'nombre_completo'    => 'Administrador',
            'apellidos'          => 'General',
            'dui'                => null,
            'fecha_nacimiento'   => '1990-01-01',
            'rol'                => 'ADMIN',
            'empresa_id'         => null,
        ]);
    }
}
