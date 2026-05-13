<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

       

    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">

                <!-- TOP -->
                <div class="bg-gradient-to-r from-yellow-500 to-amber-500 px-6 py-5">

                    <h3 class="text-lg font-bold text-white">
                        Información del Producto
                    </h3>

                    <p class="text-sm text-yellow-100 mt-1">
                        Modifica los datos necesarios del producto
                    </p>

                </div>

                <!-- FORM -->
                <div class="p-6 md:p-8">

                    <form action="{{ route('productos.update', $producto->id) }}"
                          method="POST"
                          class="space-y-6">

                        @csrf
                        @method('PUT')

                        <!-- CODIGO -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Código
                            </label>

                            <input
                                type="text"
                                name="codigo"
                                value="{{ old('codigo', $producto->codigo) }}"
                                oninput="this.value = this.value.toUpperCase()"
                                placeholder="EJ. PROD-001"
                                class="w-full uppercase rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                            @error('codigo')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        <!-- DESCRIPCION -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Descripción
                            </label>

                            <input
                                type="text"
                                name="descripcion"
                                value="{{ old('descripcion', $producto->descripcion) }}"
                                oninput="this.value = this.value.toUpperCase()"
                                placeholder="NOMBRE DEL PRODUCTO"
                                class="w-full uppercase rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                            @error('descripcion')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        <!-- UNIDAD -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Unidad de Medida
                            </label>

                            <select
                                name="unidad_medida"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-600
                                       dark:bg-gray-900 dark:text-white
                                       shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            >

                                <option value="">
                                    SELECCIONA UNA UNIDAD
                                </option>

                                <option value="PIEZAS"
                                    {{ old('unidad_medida', strtoupper($producto->unidad_medida)) == 'PIEZAS' ? 'selected' : '' }}>
                                    PIEZAS
                                </option>

                                <option value="LITROS"
                                    {{ old('unidad_medida', strtoupper($producto->unidad_medida)) == 'LITROS' ? 'selected' : '' }}>
                                    LITROS
                                </option>

                                <option value="KG"
                                    {{ old('unidad_medida', strtoupper($producto->unidad_medida)) == 'KG' ? 'selected' : '' }}>
                                    KILOGRAMOS
                                </option>

                                <option value="METROS"
                                    {{ old('unidad_medida', strtoupper($producto->unidad_medida)) == 'METROS' ? 'selected' : '' }}>
                                    METROS
                                </option>

                            </select>

                            @error('unidad_medida')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        <!-- BOTONES -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">

                            <a href="{{ route('productos.index') }}"
                               class="px-5 py-3 bg-gray-500 hover:bg-gray-600
                                      text-white rounded-xl shadow transition text-center">

                                Cancelar

                            </a>

                            <button
                                type="submit"
                                class="px-5 py-3 bg-yellow-500 hover:bg-yellow-600
                                       text-white rounded-xl shadow-lg
                                       transition font-semibold">

                                Actualizar Producto

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>