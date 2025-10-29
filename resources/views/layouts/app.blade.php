<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('titulo', 'La Cuponera SV')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-full flex flex-col text-gray-800 antialiased bg-gray-100">

    <!-- NAVBAR -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3">
            <a href="{{ route('ofertas.publicas') }}" class="text-lg font-bold text-indigo-600">
                La Cuponera SV
            </a>

            <nav class="flex items-center gap-4 text-sm">
                <a href="{{ route('ofertas.publicas') }}" class="text-gray-700 hover:text-indigo-600">
                   Cupones
                </a>

                @auth
                    @if(auth()->user()->rol === 'ADMIN')
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-indigo-600">
                            Admin
                        </a>
                    @elseif(auth()->user()->rol === 'EMPRESA')
                        <a href="{{ route('empresa.dashboard') }}" class="text-gray-700 hover:text-indigo-600">
                            Empresa
                        </a>
                    @elseif(auth()->user()->rol === 'USUARIO')
                        <a href="{{ route('mis-compras') }}" class="text-gray-700 hover:text-indigo-600">
                            Mis Compras
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="text-red-600 hover:text-red-800 font-medium cursor-pointer"
                        >
                            Cerrar sesión
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login.form') }}" class="text-gray-700 hover:text-indigo-600">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('registro-cliente.form') }}" class="text-gray-700 hover:text-indigo-600">
                        Crear Cuenta
                    </a>
                @endguest
            </nav>
        </div>
    </header>

    <!-- FLASH -->
    <div class="w-full flex justify-center mt-4 px-4">
        <div class="w-full max-w-7xl">
            @include('components.flash')
        </div>
    </div>

    <!-- CONTENIDO -->
    <main class="flex-1 w-full flex justify-center px-4 py-8 pt-12">
        <div class="w-full max-w-7xl">
            @yield('contenido')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 text-xs text-gray-500">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center">
            © {{ date('Y') }} La Cuponera SV · Todos los derechos reservados
        </div>
    </footer>

</body>
</html>
