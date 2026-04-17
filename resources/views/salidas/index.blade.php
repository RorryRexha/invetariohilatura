<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Salidas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Registro de salidas
                </h3>

                <a href="{{ route('salidas.create') }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">
                    + Nueva Salida
                </a>
            </div>

            <!-- Alert -->
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
                            <th class="px-6 py-3">Producto</th>
                            <th class="px-6 py-3">Cantidad</th>
                            <th class="px-6 py-3">Fecha</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($salidas as $salida)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <td class="px-6 py-3 font-medium">
                                    {{ $salida->producto->descripcion ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-3">
                                    {{ $salida->cantidad }}
                                </td>

                                <td class="px-6 py-3">
                                    {{ \Carbon\Carbon::parse($salida->fecha_salida)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-3 text-center space-x-2">

                                    <!-- Editar -->
                                    <a href="{{ route('salidas.edit', $salida->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                        Editar
                                    </a>

                                    <!-- Eliminar -->
                                    <form action="{{ route('salidas.destroy', $salida->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('¿Eliminar salida?')">
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
                                    No hay salidas registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>