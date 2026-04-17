<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Inventario') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Bienvenida -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    Bienvenido, {{ Auth::user()->name }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Sistema de control de inventario - Hilatura
                </p>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Productos -->
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                    <h4 class="text-lg font-semibold">Productos</h4>
                    <p class="text-3xl font-bold mt-2">
                        {{ $totalProductos ?? 0 }}
                    </p>
                </div>

                <!-- Entradas -->
                <div class="bg-green-500 text-white p-6 rounded-lg shadow">
                    <h4 class="text-lg font-semibold">Entradas Hoy</h4>
                    <p class="text-3xl font-bold mt-2">
                        {{ $entradasHoy ?? 0 }}
                    </p>
                </div>

                <!-- Salidas -->
                <div class="bg-red-500 text-white p-6 rounded-lg shadow">
                    <h4 class="text-lg font-semibold">Salidas Hoy</h4>
                    <p class="text-3xl font-bold mt-2">
                        {{ $salidasHoy ?? 0 }}
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>