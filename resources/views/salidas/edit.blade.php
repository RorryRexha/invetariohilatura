<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ✏️ Editar Salida
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <form action="{{ route('salidas.update', $salida->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div 
                        x-data="{
                            productos: @json($productos->map(fn($p) => [
                                'id' => $p->id,
                                'descripcion' => $p->descripcion,
                                'unidad_medida' => $p->unidad_medida,
                                'stock' => $p->entradas->sum('cantidad') - $p->salidas->sum('cantidad')
                            ])),
                            productoSeleccionado: '{{ old('producto_id', $salida->producto_id) }}',
                            unidad: '',
                            stock: 0
                        }"
                        x-init="
                            let prod = productos.find(p => p.id == productoSeleccionado);
                            if (prod) {
                                unidad = prod.unidad_medida;
                                stock = prod.stock;
                            }

                            $watch('productoSeleccionado', value => {
                                let prod = productos.find(p => p.id == value);
                                if (prod) {
                                    unidad = prod.unidad_medida;
                                    stock = prod.stock;
                                } else {
                                    unidad = '';
                                    stock = 0;
                                }
                            });
                        "
                    >

                        <!-- Producto -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Producto
                            </label>

                            <select 
                                name="producto_id"
                                x-model="productoSeleccionado"
                                class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                            >
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">
                                        {{ $producto->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Info dinámica -->
                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">

                            <p class="text-sm text-gray-700 dark:text-gray-200">
                                <strong>Unidad:</strong> 
                                <span x-text="unidad"></span>
                            </p>

                            <p class="text-sm"
                               :class="stock > 0 ? 'text-green-600' : 'text-red-500'">
                                <strong>Stock actual:</strong> 
                                <span x-text="stock"></span>
                            </p>

                        </div>

                        <!-- Cantidad -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cantidad
                            </label>

                            <input 
                                type="number" 
                                name="cantidad" 
                                min="1"
                                x-bind:max="stock + {{ $salida->cantidad }}"
                                value="{{ old('cantidad', $salida->cantidad) }}"
                                class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                            >
                        </div>

                        <!-- Fecha -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fecha
                            </label>

                            <input 
                                type="date" 
                                name="fecha" 
                                value="{{ old('fecha', $salida->fecha) }}"
                                class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                            >
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('salidas.index') }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                Cancelar
                            </a>

                            <button 
                                type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                Actualizar
                            </button>
                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>