<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    ✏️ Editar Salida
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Actualiza la información de la salida seleccionada
                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- CARD -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

                <!-- HEADER CARD -->
                <div class="bg-red-600 px-6 py-5">

                    <h3 class="text-lg font-semibold text-white">
                        Información de la salida
                    </h3>

                    <p class="text-red-100 text-sm mt-1">
                        Modifica los datos necesarios
                    </p>

                </div>

                <!-- FORM -->
                <div class="p-6">

                    <form action="{{ route('salidas.update', $salida->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div
                            x-data="{
                                productos: @js(
                                    $productos->map(fn($p) => [
                                        'id' => $p->id,
                                        'descripcion' => $p->descripcion,
                                        'unidad_medida' => $p->unidad_medida,
                                        'stock' => $p->entradas->sum('cantidad') - $p->salidas->sum('cantidad')
                                    ])
                                ),
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

                            <!-- GRID -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- PRODUCTO -->
                                <div class="md:col-span-2">

                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Producto
                                    </label>

                                    <select
                                        name="producto_id"
                                        x-model="productoSeleccionado"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-red-500 focus:border-red-500"
                                    >

                                        <option value="">
                                            Selecciona un producto
                                        </option>

                                        @foreach($productos as $producto)

                                            <option
                                                value="{{ $producto->id }}"
                                                {{ old('producto_id', $salida->producto_id) == $producto->id ? 'selected' : '' }}
                                            >
                                                {{ $producto->descripcion }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('producto_id')

                                        <p class="text-red-500 text-sm mt-2">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>

                                <!-- INFO -->
                                <div class="md:col-span-2">

                                    <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl p-5">

                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                            <!-- UNIDAD -->
                                            <div>

                                                <p class="text-sm text-gray-500 dark:text-gray-300">
                                                    Unidad de medida
                                                </p>

                                                <p class="font-bold text-lg text-gray-800 dark:text-white"
                                                   x-text="unidad">
                                                </p>

                                            </div>

                                            <!-- STOCK -->
                                            <div>

                                                <p class="text-sm text-gray-500 dark:text-gray-300">
                                                    Stock disponible
                                                </p>

                                                <p class="font-bold text-lg"
                                                   :class="stock > 0 ? 'text-green-600' : 'text-red-500'"
                                                   x-text="stock">
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- CANTIDAD -->
                                <div>

                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Cantidad
                                    </label>

                                    <input
                                        type="number"
                                        name="cantidad"
                                        min="1"
                                        :max="stock + {{ $salida->cantidad }}"
                                        value="{{ old('cantidad', $salida->cantidad) }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-red-500 focus:border-red-500"
                                    >

                                    @error('cantidad')

                                        <p class="text-red-500 text-sm mt-2">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>

                                <!-- FECHA -->
                                <div>

                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha"
                                        value="{{ old('fecha', $salida->fecha) }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-red-500 focus:border-red-500"
                                    >

                                    @error('fecha')

                                        <p class="text-red-500 text-sm mt-2">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>

                            </div>

                            <!-- BOTONES -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8">

                                <a href="{{ route('salidas.index') }}"
                                   class="px-5 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl shadow text-center transition">

                                    Cancelar

                                </a>

                                <button
                                    type="submit"
                                    class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow transition font-semibold"
                                >

                                    Actualizar Salida

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>