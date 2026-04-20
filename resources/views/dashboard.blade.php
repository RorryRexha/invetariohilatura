<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Inventario - Hilatura') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Bienvenida -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    Bienvenido, {{ Auth::user()->name }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Controla entradas, salidas y stock de productos en tiempo real.
                </p>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-blue-600 text-white p-6 rounded-xl shadow hover:scale-105 transition">
                    <h4 class="text-sm uppercase">Productos</h4>
                    <p class="text-3xl font-bold mt-2">{{ $totalProductos ?? 0 }}</p>
                </div>

                <div class="bg-green-600 text-white p-6 rounded-xl shadow hover:scale-105 transition">
                    <h4 class="text-sm uppercase">Entradas Hoy</h4>
                    <p class="text-3xl font-bold mt-2">{{ $entradasHoy ?? 0 }}</p>
                </div>

                <div class="bg-red-600 text-white p-6 rounded-xl shadow hover:scale-105 transition">
                    <h4 class="text-sm uppercase">Salidas Hoy</h4>
                    <p class="text-3xl font-bold mt-2">{{ $salidasHoy ?? 0 }}</p>
                </div>

            </div>

            <!-- Acciones rápidas -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Acciones rápidas
                </h3>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('productos.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                        + Nuevo Producto
                    </a>

                    <a href="{{ route('entradas.create') }}"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                        + Registrar Entrada
                    </a>

                    <a href="{{ route('salidas.create') }}"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">
                        + Registrar Salida
                    </a>
                </div>
            </div>

            <!-- Últimos movimientos -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Últimos movimientos
                </h3>

                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">Tipo</th>
                            <th class="px-4 py-2">Producto</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movimientos ?? [] as $mov)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">
                                    <span class="{{ $mov['tipo'] == 'entrada' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ ucfirst($mov['tipo']) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">{{ $mov['producto'] }}</td>
                                <td class="px-4 py-2">{{ $mov['cantidad'] }}</td>
                                <td class="px-4 py-2">{{ $mov['fecha'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    Sin movimientos recientes
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>