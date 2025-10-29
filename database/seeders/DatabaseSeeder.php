<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Usuario;
use App\Models\Empresa;
use App\Models\Oferta;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. ADMIN
        |--------------------------------------------------------------------------
        */
        $admin = Usuario::create([
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

        /*
        |--------------------------------------------------------------------------
        | 2. CLIENTE (USUARIO normal)
        |--------------------------------------------------------------------------
        */
        $cliente = Usuario::create([
            'usuario'            => 'cliente1',
            'correo_electronico' => 'cliente1@test.com',
            'contrasena'         => Hash::make('Cliente1234!'),
            'nombre_completo'    => 'Juan',
            'apellidos'          => 'Pérez',
            'dui'                => '01234567-8',
            'fecha_nacimiento'   => '1995-05-15',
            'rol'                => 'USUARIO',
            'empresa_id'         => null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. EMPRESA (estado APROBADA)
        |--------------------------------------------------------------------------
        */
        $passwordEmpresaPlano = 'Empresa1234!';
        $passwordEmpresaHash = Hash::make($passwordEmpresaPlano);

        $empresa = Empresa::create([
            'nombre_empresa'      => 'Pupusas La Doña',
            'nit'                 => '0614-123456-001-1',
            'direccion'           => 'Col. Centro, San Salvador',
            'telefono'            => '2222-0000',
            'correo_electronico'  => 'contacto@ladona.test',
            'usuario'             => 'ladona',
            'contrasena'          => $passwordEmpresaHash,
            'estado'              => 'APROBADA',
            'porcentaje_comision' => 20.00,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. USUARIO con rol EMPRESA (creado cuando el admin aprueba la empresa)
        |--------------------------------------------------------------------------
        */
        $empresaUser = Usuario::create([
            'usuario'            => $empresa->usuario,            
            'correo_electronico' => $empresa->correo_electronico,
            'contrasena'         => $empresa->contrasena,
            'nombre_completo'    => $empresa->nombre_empresa,
            'apellidos'          => '',
            'dui'                => null,
            'fecha_nacimiento'   => '1900-01-01', // dummy para cumplir la columna
            'rol'                => 'EMPRESA',
            'empresa_id'         => $empresa->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. OFERTAS (5 cupones/ofertas publicados por la empresa)
        |--------------------------------------------------------------------------
        */
        $hoy = Carbon::today();
        $fin = $hoy->copy()->addDays(30);
        $limiteCanje = $hoy->copy()->addDays(60);

        $titulos = [
            'Combo Pupusas 2x1',
            'Desayuno típico con café',
            'Cena para 2 personas',
            'Promo fin de semana',
            'Bebida gratis con tu orden',
        ];

        foreach ($titulos as $index => $titulo) {

            $precioRegular = 10 + ($index * 2);     
            $precioOferta  = $precioRegular - 3.50; 

            Oferta::create([
                'empresa_id'         => $empresa->id,
                'titulo_oferta'      => $titulo,
                'precio_regular'     => $precioRegular,
                'precio_oferta'      => $precioOferta,
                'fecha_inicio'       => $hoy->toDateString(),
                'fecha_fin'          => $fin->toDateString(),
                'fecha_limite_canje' => $limiteCanje->toDateString(),
                'cantidad_cupones'   => ($index % 2 == 0) ? 50 : null,
                'descripcion'        => 'Delicioso producto promocional de Pupusas La Doña. Canjeable en sucursal principal.',
                'estado'             => 'DISPONIBLE',
            ]);
        }
    }
}
