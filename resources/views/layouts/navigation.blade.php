<nav x-data="{ open: false }" class="bg-white border-b shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LOGO -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    
                    <img src="/images/logoSatex.png" 
                         alt="Logo" 
                         class="h-12 w-auto object-contain">

                    
                </a>

                <!-- MENÚ -->
                <div class="hidden sm:flex space-x-6 ml-10">

                    <a href="{{ route('dashboard') }}"
                       class="transition px-2 py-1 rounded
                       {{ request()->routeIs('dashboard') 
                            ? 'bg-blue-100 text-blue-600 font-semibold' 
                            : 'text-gray-600 hover:text-blue-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('productos.index') }}"
                       class="transition px-2 py-1 rounded
                       {{ request()->routeIs('productos.*') 
                            ? 'bg-blue-100 text-blue-600 font-semibold' 
                            : 'text-gray-600 hover:text-blue-600' }}">
                        Productos
                    </a>

                    <a href="{{ route('entradas.index') }}"
                       class="transition px-2 py-1 rounded
                       {{ request()->routeIs('entradas.*') 
                            ? 'bg-green-100 text-green-600 font-semibold' 
                            : 'text-gray-600 hover:text-green-600' }}">
                        Entradas
                    </a>

                    <a href="{{ route('salidas.index') }}"
                       class="transition px-2 py-1 rounded
                       {{ request()->routeIs('salidas.*') 
                            ? 'bg-red-100 text-red-600 font-semibold' 
                            : 'text-gray-600 hover:text-red-600' }}">
                        Salidas
                    </a>

                </div>
            </div>

            <!-- USUARIO -->
            <div class="hidden sm:flex items-center space-x-4">

                <span class="text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm shadow">
                        Salir
                    </button>
                </form>

            </div>

            <!-- MOBILE -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="text-gray-600 text-xl">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- RESPONSIVE -->
    <div x-show="open" class="sm:hidden bg-white border-t px-4 py-3 space-y-2">

        <a href="{{ route('dashboard') }}" class="block text-gray-700">Dashboard</a>
        <a href="{{ route('productos.index') }}" class="block text-gray-700">Productos</a>
        <a href="{{ route('entradas.index') }}" class="block text-gray-700">Entradas</a>
        <a href="{{ route('salidas.index') }}" class="block text-gray-700">Salidas</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left text-red-500 mt-2">
                Cerrar sesión
            </button>
        </form>

    </div>

</nav>