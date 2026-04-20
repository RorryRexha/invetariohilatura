<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Productos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Botón -->
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Lista de productos
                </h3>

                <a href="{{ route('productos.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    + Nuevo Producto
                </a>
            </div>

            <!-- Mensaje -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">

                    <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3">Código</th>
                            <th class="px-6 py-3">Descripción</th>
                            <th class="px-6 py-3">Unidad</th>
                            <th class="px-6 py-3">Stock</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($productos as $producto)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <td class="px-6 py-3 font-medium">
                                    {{ $producto->codigo }}
                                </td>

                                <td class="px-6 py-3">
                                    {{ $producto->descripcion }}
                                </td>

                                <td class="px-6 py-3">
                                    {{ $producto->unidad_medida }}
                                </td>

                                <td class="px-6 py-3 font-semibold">
                                     {{
                                        $producto->entradas->sum('cantidad')
                                         - $producto->salidas->sum('cantidad')
                                       }}
                                 </td>

                                <td class="px-6 py-3 text-center space-x-2">

                                    <!-- Editar -->
                                    <a href="{{ route('productos.edit', $producto->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                        Editar
                                    </a>

                                    <!-- Eliminar -->
                                    <form action="{{ route('productos.destroy', $producto->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('¿Eliminar producto?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                            Eliminar
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    No hay productos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>