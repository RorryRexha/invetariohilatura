<x-app-layout>

    <x-slot name="header">

        

    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">

                <!-- HEADER -->
                <div class="bg-gradient-to-r from-red-600 via-red-700 to-red-800 px-8 py-6">

                    <h3 class="text-white text-xl font-bold">
                        Registro de salida
                    </h3>

                    <p class="text-red-100 text-sm mt-1">
                        Completa los campos para registrar el movimiento de almacén
                    </p>

                </div>

                <div class="p-6 sm:p-8">

                    @if(session('error'))

                        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl shadow-sm">
                            {{ session('error') }}
                        </div>

                    @endif

                    <form action="{{ route('salidas.store') }}" method="POST">
                        @csrf

                        <div
                            x-data="{
                                productos: @json($productos->load(['entradas','salidas'])),
                                productoSeleccionado: '',
                                unidad: '',
                                stock: 0
                            }"

                            x-init="
                                $watch('productoSeleccionado', value => {

                                    let prod = productos.find(p => p.id == value);

                                    if (prod) {

                                        unidad = prod.unidad_medida;

                                        let entradas = prod.entradas.reduce((t,e) => t + parseFloat(e.cantidad), 0);
                                        let salidas = prod.salidas.reduce((t,s) => t + parseFloat(s.cantidad), 0);

                                        stock = entradas - salidas;

                                    } else {

                                        unidad = '';
                                        stock = 0;

                                    }

                                });
                            "
                        >

                            <!-- GRID -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                                <!-- CODIGO -->
                                <div>

                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                        Código del Producto
                                    </label>

                                    <input
                                        type="text"
                                        id="buscarProducto"
                                        placeholder="Ej. GO-BAND840-20"
                                        class="w-full rounded-2xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-red-500 focus:border-red-500"
                                        oninput="this.value = this.value.toUpperCase()"
                                    >

                                </div>

                                <!-- FECHA -->
                                <div>

                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha de salida
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha"
                                        value="{{ old('fecha', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                        class="w-full rounded-2xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-red-500 focus:border-red-500"
                                    >

                                </div>

                            </div>

                            <!-- PRODUCTO -->
                            <div class="mt-6">

                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Producto
                                </label>

                                <select
                                    name="producto_id"
                                    id="productoSelect"
                                    x-model="productoSeleccionado"
                                    class="w-full rounded-2xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-red-500 focus:border-red-500"
                                >

                                    <option value="">
                                        Selecciona un producto
                                    </option>

                                    @foreach($productos as $producto)

                                        <option
                                            value="{{ $producto->id }}"
                                            data-codigo="{{ strtolower($producto->codigo) }}"
                                        >

                                            {{ $producto->codigo }} — {{ $producto->descripcion }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <!-- INFO -->
                            <div
                                x-show="productoSeleccionado"
                                x-transition
                                class="mt-6 rounded-3xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 p-6"
                            >

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <!-- UNIDAD -->
                                    <div>

                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Unidad de medida
                                        </p>

                                        <p class="text-xl font-bold text-gray-800 dark:text-white mt-2">
                                            <span x-text="unidad"></span>
                                        </p>

                                    </div>

                                    <!-- STOCK -->
                                    <div>

                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Stock disponible
                                        </p>

                                        <p
                                            class="text-2xl font-extrabold mt-2"
                                            :class="stock > 0 ? 'text-green-600' : 'text-red-600'"
                                        >

                                            <span x-text="stock"></span>

                                        </p>

                                        <div
                                            x-show="stock <= 0"
                                            class="mt-2 text-sm text-red-500 font-semibold"
                                        >
                                            Sin stock disponible
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- CANTIDAD -->
                            <div class="mt-6">

                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Cantidad
                                </label>

                                <input
                                    type="number"
                                    name="cantidad"
                                    min="1"
                                    x-bind:max="stock"
                                    value="{{ old('cantidad') }}"
                                    class="w-full rounded-2xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm text-lg focus:ring-red-500 focus:border-red-500"
                                >

                            </div>

                            <!-- MOTIVO -->
                            <div class="mt-6">

                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Motivo / Justificación
                                </label>

                                <textarea
                                    name="motivo_salida"
                                    rows="5"
                                    placeholder="Ej. Material utilizado para mantenimiento de maquinaria..."
                                    class="w-full rounded-2xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm resize-none focus:ring-red-500 focus:border-red-500"
                                >{{ old('motivo_salida') }}</textarea>

                            </div>

                            <!-- BOTONES -->
                            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-4">

                                <a
                                    href="{{ route('salidas.index') }}"
                                    class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-2xl text-center font-bold shadow-lg transition"
                                >
                                    Cancelar
                                </a>

                                <button
                                    type="submit"
                                    :disabled="stock <= 0"
                                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-bold shadow-xl transition-all duration-200 hover:scale-105 disabled:bg-gray-400 disabled:hover:scale-100"
                                >

                                    Guardar salida

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- AUTO SELECT -->
    <script>

        document.getElementById('buscarProducto').addEventListener('keyup', function () {

            let codigo = this.value.toLowerCase().trim();

            let select = document.getElementById('productoSelect');

            let opciones = select.options;

            select.value = '';

            for (let i = 1; i < opciones.length; i++) {

                let codigoProducto = opciones[i].getAttribute('data-codigo');

                if (codigoProducto === codigo) {

                    select.value = opciones[i].value;

                    select.dispatchEvent(new Event('change'));

                    break;

                }

            }

            if (codigo === '') {

                select.value = '';

                select.dispatchEvent(new Event('change'));

            }

        });

    </script>

</x-app-layout>