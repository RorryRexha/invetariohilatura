<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

        
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- ALERTAS -->
            @if(session('success'))

                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>

            @endif

            @if(session('error'))

                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('error') }}
                </div>

            @endif

            <!-- FILTROS -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5">

                <form method="GET"
                      action="{{ route('entradas.index') }}">

                    <div class="flex flex-col xl:flex-row gap-4 xl:items-center xl:justify-between">

                        <!-- BUSCADOR -->
                        <div class="flex flex-col md:flex-row gap-3 w-full xl:w-auto">

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Buscar folio, código, producto u orden..."
                                class="w-full md:w-80 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            >

                            <button
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow transition">

                                Buscar

                            </button>

                        </div>

                        <!-- BOTONES -->
                        <div class="flex flex-col sm:flex-row gap-3">

                            <!-- EXCEL -->
                            <a
                                href="{{ route('entradas.excel', ['search' => request('search')]) }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow text-center transition">

                                Excel

                            </a>

                            <!-- PDF -->
                            <a
                                href="{{ route('entradas.pdf', ['search' => request('search')]) }}"
                                class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow text-center transition">

                                PDF

                            </a>

                            <!-- LIMPIAR -->
                            <a
                                href="{{ route('entradas.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow text-center transition">

                                Limpiar

                            </a>

                            <!-- NUEVA -->
                            @role('admin|almacen')

                            <a
                                href="{{ route('entradas.create') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow text-center transition font-semibold">

                                + Nueva Entrada

                            </a>

                            @endrole

                        </div>

                    </div>

                </form>

            </div>

            <!-- RESULTADO -->
            @if(request()->filled('search'))

                <div class="bg-blue-100 border border-blue-300 text-blue-700 px-4 py-3 rounded-xl shadow-sm">

                    Buscando:
                    <strong>{{ request('search') }}</strong>

                </div>

            @endif

            <!-- TABLA DESKTOP -->
            <div class="hidden lg:block bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm text-left">

                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-xs">

                            <tr>

                                <th class="px-4 py-3">Folio</th>
                                <th class="px-4 py-3">Código</th>
                                <th class="px-4 py-3">Producto</th>
                                <th class="px-4 py-3">Cantidad</th>
                                <th class="px-4 py-3">Orden</th>
                                <th class="px-4 py-3">Fecha</th>

                                @role('admin')
                                <th class="px-4 py-3 text-center">
                                    Acciones
                                </th>
                                @endrole

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($entradas as $entrada)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                    <!-- FOLIO -->
                                    <td class="px-4 py-3">

                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $entrada->folio }}
                                        </span>

                                    </td>

                                    <!-- CODIGO -->
                                    <td class="px-4 py-3 font-semibold text-indigo-600 dark:text-indigo-400">
                                        {{ $entrada->producto->codigo ?? 'N/A' }}
                                    </td>

                                    <!-- PRODUCTO -->
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-white max-w-xs">

                                        <p class="truncate">
                                            {{ $entrada->producto->descripcion ?? 'N/A' }}
                                        </p>

                                    </td>

                                    <!-- CANTIDAD -->
                                    <td class="px-4 py-3">

                                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg font-semibold text-xs">

                                            {{ $entrada->cantidad }}
                                            {{ optional($entrada->producto)->unidad_medida }}

                                        </span>

                                    </td>

                                    <!-- ORDEN -->
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                        {{ $entrada->orden_compra }}
                                    </td>

                                    <!-- FECHA -->
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300 whitespace-nowrap">

                                        {{ \Carbon\Carbon::parse($entrada->fecha_ingreso)->format('d/m/Y') }}

                                    </td>

                                    <!-- ACCIONES -->
                                    @role('admin')

                                    <td class="px-4 py-3">

                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('entradas.edit', $entrada->id) }}"
                                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-lg text-xs shadow transition">

                                                Editar

                                            </a>

                                            <form action="{{ route('entradas.destroy', $entrada->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Eliminar entrada?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs shadow transition">

                                                    Eliminar

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                    @endrole

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7"
                                        class="text-center py-10 text-gray-500">

                                        No se encontraron registros

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- MOBILE -->
            <div class="grid grid-cols-1 gap-4 lg:hidden">

                @forelse($entradas as $entrada)

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 space-y-4">

                        <!-- HEADER -->
                        <div class="flex justify-between items-start gap-3">

                            <div>

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $entrada->folio }}
                                </span>

                                <h3 class="mt-3 font-bold text-gray-800 dark:text-white">
                                    {{ $entrada->producto->descripcion ?? 'N/A' }}
                                </h3>

                                <p class="text-sm text-indigo-600 dark:text-indigo-400">
                                    {{ $entrada->producto->codigo ?? 'N/A' }}
                                </p>

                            </div>

                        </div>

                        <!-- INFO -->
                        <div class="space-y-2 text-sm">

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Cantidad:
                                </span>

                                <span class="font-semibold text-blue-600">

                                    {{ $entrada->cantidad }}
                                    {{ optional($entrada->producto)->unidad_medida }}

                                </span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Orden:
                                </span>

                                <span class="font-medium text-gray-700 dark:text-gray-200">
                                    {{ $entrada->orden_compra }}
                                </span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Fecha:
                                </span>

                                <span class="font-medium text-gray-700 dark:text-gray-200">

                                    {{ \Carbon\Carbon::parse($entrada->fecha_ingreso)->format('d/m/Y') }}

                                </span>

                            </div>

                        </div>

                        <!-- BOTONES -->
                        @role('admin')

                        <div class="flex gap-2 pt-2">

                            <a href="{{ route('entradas.edit', $entrada->id) }}"
                               class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-white text-center py-2 rounded-xl text-sm shadow">

                                Editar

                            </a>

                            <form action="{{ route('entradas.destroy', $entrada->id) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('¿Eliminar entrada?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl text-sm shadow">

                                    Eliminar

                                </button>

                            </form>

                        </div>

                        @endrole

                    </div>

                @empty

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-10 text-center text-gray-500">

                        No se encontraron registros

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>