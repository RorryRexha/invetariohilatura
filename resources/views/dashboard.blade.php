<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            

            

        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- HERO -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 shadow-2xl">

                <div class="absolute inset-0 opacity-10">
                    <img src="{{ asset('images/imagen1.jpg') }}"
                         class="w-full h-full object-cover">
                </div>

                <div class="relative z-10 p-8 md:p-10">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                        <div>

                            <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight">
                                Bienvenido,
                                {{ Auth::user()->name }}
                            </h1>

                            

                            

                        </div>

                        <div class="hidden lg:block">
                            <img src="{{ asset('images/hilatex.png') }}"
                                 class="w-72 opacity-95">
                        </div>

                    </div>

                </div>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                <!-- PRODUCTOS -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Productos
                            </p>

                            <h3 class="text-4xl font-bold mt-3 text-blue-600">
                                {{ $totalProductos ?? 0 }}
                            </h3>

                        </div>

                        <div class="bg-blue-100 dark:bg-blue-900/30 p-4 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-8 h-8 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />

                            </svg>
                        </div>

                    </div>

                </div>

                <!-- ENTRADAS -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Entradas Hoy
                            </p>

                            <h3 class="text-4xl font-bold mt-3 text-green-600">
                                {{ $entradasHoy ?? 0 }}
                            </h3>

                        </div>

                        <div class="bg-green-100 dark:bg-green-900/30 p-4 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-8 h-8 text-green-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 10l7-7m0 0l7 7m-7-7v18" />

                            </svg>
                        </div>

                    </div>

                </div>

                <!-- SALIDAS -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Salidas Hoy
                            </p>

                            <h3 class="text-4xl font-bold mt-3 text-red-600">
                                {{ $salidasHoy ?? 0 }}
                            </h3>

                        </div>

                        <div class="bg-red-100 dark:bg-red-900/30 p-4 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-8 h-8 text-red-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 14l-7 7m0 0l-7-7m7 7V3" />

                            </svg>
                        </div>

                    </div>

                </div>

                <!-- MOVIMIENTOS -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Movimientos
                            </p>

                            <h3 class="text-4xl font-bold mt-3 text-purple-600">
                                {{ count($movimientos ?? []) }}
                            </h3>

                        </div>

                        <div class="bg-purple-100 dark:bg-purple-900/30 p-4 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-8 h-8 text-purple-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 17v-2m3 2v-4m3 4v-6m2 10H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z" />

                            </svg>
                        </div>

                    </div>

                </div>

            </div>

            <!-- QUICK ACTIONS -->
            @if(Auth::user()->role == 'admin')

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 p-8">

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            Acciones rápidas
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Gestiona el inventario rápidamente
                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <a href="{{ route('productos.create') }}"
                       class="group bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-2xl p-6 shadow-lg transition duration-300 hover:scale-105">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm opacity-80">
                                    Crear nuevo
                                </p>

                                <h4 class="text-2xl font-bold mt-2">
                                    Producto
                                </h4>

                            </div>

                            <div class="bg-white/20 p-4 rounded-2xl">
                                +
                            </div>

                        </div>

                    </a>

                    <a href="{{ route('entradas.create') }}"
                       class="group bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-2xl p-6 shadow-lg transition duration-300 hover:scale-105">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm opacity-80">
                                    Registrar
                                </p>

                                <h4 class="text-2xl font-bold mt-2">
                                    Entrada
                                </h4>

                            </div>

                            <div class="bg-white/20 p-4 rounded-2xl">
                                ↑
                            </div>

                        </div>

                    </a>

                    <a href="{{ route('salidas.create') }}"
                       class="group bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-2xl p-6 shadow-lg transition duration-300 hover:scale-105">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm opacity-80">
                                    Registrar
                                </p>

                                <h4 class="text-2xl font-bold mt-2">
                                    Salida
                                </h4>

                            </div>

                            <div class="bg-white/20 p-4 rounded-2xl">
                                ↓
                            </div>

                        </div>

                    </a>

                </div>

            </div>

            @endif

            <!-- MOVIMIENTOS -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">

                    <div>

                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            Últimos movimientos
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Historial reciente del almacén
                        </p>

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-50 dark:bg-gray-700/50">

                            <tr>

                                <th class="px-6 py-4 text-left font-semibold text-gray-600 dark:text-gray-300">
                                    Tipo
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-gray-600 dark:text-gray-300">
                                    Producto
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-gray-600 dark:text-gray-300">
                                    Cantidad
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-gray-600 dark:text-gray-300">
                                    Fecha
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($movimientos ?? [] as $mov)

                                <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">

                                    <td class="px-6 py-4">

                                        @if($mov['tipo'] == 'entrada')

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                Entrada
                                            </span>

                                        @else

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                Salida
                                            </span>

                                        @endif

                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-800 dark:text-white">
                                        {{ $mov['producto'] }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $mov['cantidad'] }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                        {{ $mov['fecha'] }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-10 text-gray-500 dark:text-gray-400">

                                        Sin movimientos recientes

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>