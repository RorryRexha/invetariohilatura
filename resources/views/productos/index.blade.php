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

                <div class="flex flex-col xl:flex-row gap-4 xl:items-center xl:justify-between">

                    <!-- BUSCADOR -->
                    <form method="GET"
                          action="{{ route('productos.index') }}"
                          class="flex flex-col md:flex-row gap-3 w-full xl:w-auto">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Buscar código o descripción..."
                            class="w-full md:w-80 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >

                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow transition">

                            Buscar

                        </button>

                    </form>

                    <!-- BOTONES -->
                    @role('admin')

                    <div class="flex flex-col sm:flex-row gap-3">

                        <!-- IMPORTAR -->
                        <form action="{{ route('productos.importar') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="flex flex-col sm:flex-row gap-3">

                            @csrf

                            <input type="file"
                                   name="archivo"
                                   required
                                   class="rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm text-sm">

                            <button type="submit"
                                    class="bg-green-700 hover:bg-green-800 text-white px-5 py-3 rounded-xl shadow transition">

                                Importar Excel

                            </button>

                        </form>

                        <!-- NUEVO -->
                        <a href="{{ route('productos.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow text-center transition font-semibold">

                            + Nuevo Producto

                        </a>

                    </div>

                    @endrole

                </div>

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

                                <th class="px-4 py-3">Código</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Unidad</th>
                                <th class="px-4 py-3">Stock</th>

                                @role('admin')
                                <th class="px-4 py-3 text-center">
                                    Acciones
                                </th>
                                @endrole

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($productos as $producto)

                                @php
                                    $stock =
                                        $producto->entradas->sum('cantidad')
                                        - $producto->salidas->sum('cantidad');
                                @endphp

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                    <!-- CODIGO -->
                                    <td class="px-4 py-3 font-semibold text-indigo-600 dark:text-indigo-400">

                                        {{ $producto->codigo }}

                                    </td>

                                    <!-- DESCRIPCION -->
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-white max-w-md">

                                        <p class="truncate">
                                            {{ $producto->descripcion }}
                                        </p>

                                    </td>

                                    <!-- UNIDAD -->
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">

                                        {{ $producto->unidad_medida }}

                                    </td>

                                    <!-- STOCK -->
                                    <td class="px-4 py-3">

                                        @if($stock > 20)

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $stock }}
                                            </span>

                                        @elseif($stock > 0)

                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $stock }}
                                            </span>

                                        @else

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $stock }}
                                            </span>

                                        @endif

                                    </td>

                                    <!-- ACCIONES -->
                                    @role('admin')

                                    <td class="px-4 py-3">

                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('productos.edit', $producto->id) }}"
                                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-lg text-xs shadow transition">

                                                Editar

                                            </a>

                                            <form action="{{ route('productos.destroy', $producto->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Eliminar producto?')">

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

                                    <td colspan="5"
                                        class="text-center py-10 text-gray-500">

                                        No hay productos registrados

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- MOBILE -->
            <div class="grid grid-cols-1 gap-4 lg:hidden">

                @forelse($productos as $producto)

                    @php
                        $stock =
                            $producto->entradas->sum('cantidad')
                            - $producto->salidas->sum('cantidad');
                    @endphp

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 space-y-4">

                        <!-- HEADER -->
                        <div class="flex justify-between items-start gap-3">

                            <div>

                                <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ $producto->codigo }}
                                </p>

                                <h3 class="mt-2 font-bold text-gray-800 dark:text-white">
                                    {{ $producto->descripcion }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Unidad: {{ $producto->unidad_medida }}
                                </p>

                            </div>

                            <div>

                                @if($stock > 20)

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $stock }}
                                    </span>

                                @elseif($stock > 0)

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $stock }}
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $stock }}
                                    </span>

                                @endif

                            </div>

                        </div>

                        <!-- BOTONES -->
                        @role('admin')

                        <div class="flex gap-2 pt-2">

                            <a href="{{ route('productos.edit', $producto->id) }}"
                               class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-white text-center py-2 rounded-xl text-sm shadow">

                                Editar

                            </a>

                            <form action="{{ route('productos.destroy', $producto->id) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('¿Eliminar producto?')">

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

                        No hay productos registrados

                    </div>

                @endforelse

            </div>

            <!-- PAGINACION -->
            <div>

                {{ $productos->links() }}

            </div>

        </div>

    </div>

</x-app-layout>