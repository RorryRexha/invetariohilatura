<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Entradas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Registro de entradas
                </h3>

                <a href="{{ route('entradas.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                    + Nueva Entrada
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
                            <th class="px-6 py-3">Folio</th>
                            <th class="px-6 py-3">Producto</th>
                            <th class="px-6 py-3">Cantidad</th>
                            <th class="px-6 py-3">Orden de Compra</th>
                            <th class="px-6 py-3">Fecha Ingreso</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($entradas as $entrada)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <!-- Folio -->
                                <td class="px-6 py-3">
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
                                        {{ $entrada->folio }}
                                    </span>
                                </td>

                                <!-- Producto -->
                                <td class="px-6 py-3 font-medium">
                                    {{ $entrada->producto->descripcion ?? 'N/A' }}
                                </td>

                                <!-- Cantidad + Unidad -->
                                <td class="px-6 py-3">
                                    {{ $entrada->cantidad }} 
                                    {{ optional($entrada->producto)->unidad_medida }}
                                </td>

                                <!-- Orden -->
                                <td class="px-6 py-3">
                                    {{ $entrada->orden_compra }}
                                </td>

                                <!-- Fecha -->
                                <td class="px-6 py-3">
                                    {{ \Carbon\Carbon::parse($entrada->fecha_ingreso)->format('d/m/Y') }}
                                </td>

                                <!-- Acciones -->
                                <td class="px-6 py-3 text-center space-x-2">

                                    <a href="{{ route('entradas.edit', $entrada->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                        Editar
                                    </a>

                                    <form action="{{ route('entradas.destroy', $entrada->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('¿Eliminar entrada?')">
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
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    No hay entradas registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>