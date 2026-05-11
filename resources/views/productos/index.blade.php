<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Productos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- HEADER -->
            <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">

                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Lista de productos
                </h3>

                <!-- CONTROLES -->
                <div class="flex flex-col gap-3 w-full sm:w-auto">

                    <!-- BUSCADOR -->
                    <form method="GET"
                          action="{{ route('productos.index') }}"
                          class="flex flex-col sm:flex-row gap-2">

                        <input 
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Buscar código o descripción..."
                            class="px-4 py-2 border rounded-lg shadow-sm w-full sm:w-72"
                        >

                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            Buscar
                        </button>

                    </form>

                    @role('admin')

                    <!-- IMPORTAR + NUEVO -->
                    <div class="flex flex-col sm:flex-row gap-2">

                        <!-- IMPORTAR EXCEL -->
                        <form action="{{ route('productos.importar') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="flex flex-col sm:flex-row gap-2">

                            @csrf

                            <input type="file"
                                   name="archivo"
                                   required
                                   class="border rounded px-3 py-2 text-sm bg-white">

                            <button type="submit"
                                    class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded shadow">
                                Importar Excel
                            </button>

                        </form>

                        <!-- NUEVO -->
                        <a href="{{ route('productos.create') }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-center">
                            + Nuevo
                        </a>

                    </div>

                    @endrole

                </div>
            </div>

            <!-- ALERTAS -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded shadow">
                    {{ session('error') }}
                </div>
            @endif

            <!-- TABLA -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">

                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">

                    <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3">Código</th>
                            <th class="px-6 py-3">Descripción</th>
                            <th class="px-6 py-3">Unidad</th>
                            <th class="px-6 py-3">Stock</th>

                            @role('admin')
                                <th class="px-6 py-3 text-center">Acciones</th>
                            @endrole
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($productos as $producto)

                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <!-- CODIGO -->
                                <td class="px-6 py-3 font-semibold text-indigo-600">
                                    {{ $producto->codigo }}
                                </td>

                                <!-- DESCRIPCION -->
                                <td class="px-6 py-3">
                                    {{ $producto->descripcion }}
                                </td>

                                <!-- UNIDAD -->
                                <td class="px-6 py-3">
                                    {{ $producto->unidad_medida }}
                                </td>

                                <!-- STOCK -->
                                <td class="px-6 py-3">

                                    @php
                                        $stock =
                                            $producto->entradas->sum('cantidad')
                                            - $producto->salidas->sum('cantidad');
                                    @endphp

                                    @if($stock > 20)

                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">
                                            {{ $stock }}
                                        </span>

                                    @elseif($stock > 0)

                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">
                                            {{ $stock }}
                                        </span>

                                    @else

                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">
                                            {{ $stock }}
                                        </span>

                                    @endif

                                </td>

                                @role('admin')

                                <!-- ACCIONES -->
                                <td class="px-6 py-3 text-center space-x-2">

                                    <a href="{{ route('productos.edit', $producto->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs shadow">
                                        Editar
                                    </a>

                                    <form action="{{ route('productos.destroy', $producto->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('¿Eliminar producto?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow">
                                            Eliminar
                                        </button>

                                    </form>

                                </td>

                                @endrole

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="text-center py-6 text-gray-500">

                                    No hay productos registrados

                                </td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>

            </div>

            <!-- PAGINACION -->
            <div class="mt-4">
                {{ $productos->links() }}
            </div>

        </div>
    </div>
</x-app-layout>