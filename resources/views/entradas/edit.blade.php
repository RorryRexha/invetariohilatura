<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

        

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

                <!-- TOP -->
                <div class="bg-gradient-to-r from-yellow-500 to-amber-500 px-6 py-5">

                    <h3 class="text-xl font-bold text-white">
                        Formulario de edición
                    </h3>

                    <p class="text-yellow-100 text-sm mt-1">
                        Modifica los datos de la entrada de almacén
                    </p>

                </div>

                <!-- FORM -->
                <form action="{{ route('entradas.update', $entrada->id) }}"
                      method="POST"
                      class="p-6 space-y-6">

                    @csrf
                    @method('PUT')

                    <!-- GRID -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- PRODUCTO -->
                        <div class="md:col-span-2">

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Producto
                            </label>

                            <select
                                name="producto_id"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                                <option value="">
                                    Selecciona un producto
                                </option>

                                @foreach($productos as $producto)

                                    <option value="{{ $producto->id }}"
                                        {{ old('producto_id', $entrada->producto_id) == $producto->id ? 'selected' : '' }}>

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

                        <!-- CANTIDAD -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Cantidad
                            </label>

                            <input
                                type="number"
                                name="cantidad"
                                value="{{ old('cantidad', $entrada->cantidad) }}"
                                placeholder="Ej. 100"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                            @error('cantidad')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        <!-- ORDEN -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Orden de Compra
                            </label>

                            <input
                                type="text"
                                name="orden_compra"
                                value="{{ old('orden_compra', $entrada->orden_compra) }}"
                                placeholder="Ej. OC-12345"
                                oninput="this.value = this.value.toUpperCase()"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                            @error('orden_compra')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        <!-- FECHA ORDEN -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Fecha de Orden
                            </label>

                            <input
                                type="date"
                                name="fecha_orden"
                                value="{{ old('fecha_orden', $entrada->fecha_orden) }}"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                            @error('fecha_orden')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        <!-- FECHA INGRESO -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Fecha de Ingreso
                            </label>

                            <input
                                type="date"
                                name="fecha_ingreso"
                                value="{{ old('fecha_ingreso', $entrada->fecha_ingreso) }}"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                            @error('fecha_ingreso')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">

                        <a href="{{ route('entradas.index') }}"
                           class="px-5 py-3 rounded-xl bg-gray-500 hover:bg-gray-600
                                  text-white text-center font-semibold shadow transition">

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="px-5 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600
                                   text-white font-semibold shadow-lg transition
                                   hover:-translate-y-0.5"
                        >

                            Actualizar Entrada

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>