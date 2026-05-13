<nav x-data="{ open: false }"
     class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 shadow-sm fixed top-0 left-0 w-full z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-16">

            <!-- LEFT -->
            <div class="flex items-center gap-8">

                <!-- LOGO -->
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3">

                    <img src="/images/hilatex.png"
                         alt="Logo"
                         class="h-11 w-auto object-contain">

                    <div class="hidden md:block">

                        <h1 class="text-sm font-bold text-gray-800 dark:text-white">
                            Sistema de Inventario
                        </h1>

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Hilatex
                        </p>

                    </div>

                </a>

                <!-- MENU DESKTOP -->
                <div class="hidden lg:flex items-center gap-2">

                    <!-- DASHBOARD -->
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                       {{ request()->routeIs('dashboard')
                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300 shadow-sm'
                            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-indigo-600' }}">

                        Dashboard

                    </a>

                    <!-- PRODUCTOS -->
                    @hasanyrole('admin|almacen|compras')

                        <a href="{{ route('productos.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                           {{ request()->routeIs('productos.*')
                                ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300 shadow-sm'
                                : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600' }}">

                            Productos

                        </a>

                    @endhasanyrole

                    <!-- ENTRADAS -->
                    @hasanyrole('admin|compras')

                        <a href="{{ route('entradas.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                           {{ request()->routeIs('entradas.*')
                                ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300 shadow-sm'
                                : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-green-600' }}">

                            Entradas

                        </a>

                    @endhasanyrole

                    <!-- SALIDAS -->
                    @hasanyrole('admin|almacen')

                        <a href="{{ route('salidas.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                           {{ request()->routeIs('salidas.*')
                                ? 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300 shadow-sm'
                                : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-600' }}">

                            Salidas

                        </a>

                    @endhasanyrole

                    <!-- USUARIOS -->
                    @role('admin')

                        <a href="{{ route('users.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                           {{ request()->routeIs('users.*')
                                ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300 shadow-sm'
                                : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-purple-600' }}">

                            Usuarios

                        </a>

                    @endrole

                </div>

            </div>

            <!-- RIGHT -->
            <div class="hidden lg:flex items-center gap-4">

                <!-- USER -->
                <div class="flex items-center gap-3 bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-2xl">

                    <!-- AVATAR -->
                    <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold shadow">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                    <!-- INFO -->
                    <div class="leading-tight">

                        <p class="text-sm font-semibold text-gray-800 dark:text-white">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            {{ Auth::user()->getRoleNames()->first() }}
                        </p>

                    </div>

                </div>

                <!-- LOGOUT -->
                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button
                        class="bg-red-500 hover:bg-red-600
                               text-white text-sm font-semibold
                               px-4 py-2 rounded-xl shadow
                               transition duration-200">

                        Salir

                    </button>

                </form>

            </div>

            <!-- MOBILE BUTTON -->
            <div class="lg:hidden flex items-center">

                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-xl
                               text-gray-700 dark:text-white
                               hover:bg-gray-100 dark:hover:bg-gray-800
                               transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-7 w-7"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- MOBILE MENU -->
    <div x-show="open"
         x-transition
         class="lg:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">

        <div class="px-4 py-4 space-y-2">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl text-sm font-medium
               {{ request()->routeIs('dashboard')
                    ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
                    : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                Dashboard

            </a>

            <!-- PRODUCTOS -->
            @hasanyrole('admin|almacen|compras')

                <a href="{{ route('productos.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-medium
                   {{ request()->routeIs('productos.*')
                        ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                    Productos

                </a>

            @endhasanyrole

            <!-- ENTRADAS -->
            @hasanyrole('admin|compras')

                <a href="{{ route('entradas.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-medium
                   {{ request()->routeIs('entradas.*')
                        ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                    Entradas

                </a>

            @endhasanyrole

            <!-- SALIDAS -->
            @hasanyrole('admin|almacen')

                <a href="{{ route('salidas.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-medium
                   {{ request()->routeIs('salidas.*')
                        ? 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                    Salidas

                </a>

            @endhasanyrole

            <!-- USUARIOS -->
            @role('admin')

                <a href="{{ route('users.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-medium
                   {{ request()->routeIs('users.*')
                        ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                    Usuarios

                </a>

            @endrole

            <!-- USER INFO -->
            <div class="mt-4 p-4 rounded-2xl bg-gray-100 dark:bg-gray-800">

                <div class="flex items-center gap-3">

                    <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-gray-800 dark:text-white">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs uppercase text-gray-500 dark:text-gray-400">
                            {{ Auth::user()->getRoleNames()->first() }}
                        </p>

                    </div>

                </div>

                <!-- LOGOUT -->
                <form method="POST"
                      action="{{ route('logout') }}"
                      class="mt-4">

                    @csrf

                    <button
                        class="w-full bg-red-500 hover:bg-red-600
                               text-white py-2 rounded-xl text-sm font-semibold shadow transition">

                        Cerrar sesión

                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>