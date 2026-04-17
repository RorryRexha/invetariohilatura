<nav x-data="{ open: false }" class="bg-gray-900 text-white shadow-lg">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LOGO + NOMBRE -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    
                    
                    <img src="/images/logoSatex.png" alt="Logo" class="h-20 w-20 object-contain">

                    
                </a>

                <!-- MENÚ -->
                <div class="hidden sm:flex space-x-6 ml-10">

                    <a href="{{ route('dashboard') }}"
                       class="hover:text-blue-400 transition {{ request()->routeIs('dashboard') ? 'text-blue-400 font-semibold' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('productos.index') }}"
                       class="hover:text-blue-400 transition {{ request()->routeIs('productos.*') ? 'text-blue-400 font-semibold' : '' }}">
                        Productos
                    </a>

                    <a href="{{ route('entradas.index') }}"
                       class="hover:text-blue-400 transition {{ request()->routeIs('entradas.*') ? 'text-blue-400 font-semibold' : '' }}">
                        Entradas
                    </a>

                    <a href="{{ route('salidas.index') }}"
                       class="hover:text-blue-400 transition {{ request()->routeIs('salidas.*') ? 'text-blue-400 font-semibold' : '' }}">
                        Salidas
                    </a>

                </div>
            </div>

            <!-- 👤 USUARIO -->
            <div class="hidden sm:flex items-center space-x-4">

                <span class="text-sm text-gray-300">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                        Salir
                    </button>
                </form>

            </div>

            <!-- MOBILE BUTTON -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="text-gray-300">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!--  MENÚ RESPONSIVE -->
    <div x-show="open" class="sm:hidden bg-gray-800 px-4 py-3 space-y-2">

        <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
        <a href="{{ route('productos.index') }}" class="block">Productos</a>
        <a href="{{ route('entradas.index') }}" class="block">Entradas</a>
        <a href="{{ route('salidas.index') }}" class="block">Salidas</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left text-red-400 mt-2">
                Cerrar sesión
            </button>
        </form>

    </div>

</nav>