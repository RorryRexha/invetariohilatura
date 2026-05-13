<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

        

    </x-slot>

    <div class="py-6 sm:py-10">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700">

                <!-- TOP -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">

                    <h3 class="text-white text-lg font-bold">
                        Registro de entrada
                    </h3>

                    <p class="text-blue-100 text-sm mt-1">
                        Completa la información para registrar el movimiento
                    </p>

                </div>

                <!-- FORM -->
                <div class="p-6 sm:p-8">

                    <form action="{{ route('entradas.store') }}" method="POST">

                        @csrf

                        <!-- GRID -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                            <!-- CODIGO -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Código del Producto
                                </label>

                                <input
                                    type="text"
                                    id="buscarProducto"
                                    placeholder="Ej. P001"
                                    autocomplete="off"
                                    oninput="this.value = this.value.toUpperCase()"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >

                            </div>

                            <!-- PRODUCTO -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Producto
                                </label>

                                <input
                                    type="text"
                                    id="nombreProducto"
                                    readonly
                                    placeholder="Se llenará automáticamente"
                                    class="w-full rounded-xl bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm"
                                >

                            </div>

                        </div>

                        <!-- HIDDEN -->
                        <input type="hidden"
                               name="producto_id"
                               id="productoSelect">

                        @error('producto_id')

                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>

                        @enderror

                        <!-- GRID -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

                            <!-- CANTIDAD -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Cantidad
                                </label>

                                <input
                                    type="number"
                                    name="cantidad"
                                    value="{{ old('cantidad') }}"
                                    placeholder="Ej. 100"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >

                                @error('cantidad')

                                    <p class="text-red-500 text-sm mt-1">
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
                                    value="{{ old('orden_compra') }}"
                                    placeholder="Ej. OC-12345"
                                    oninput="this.value = this.value.toUpperCase()"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >

                                @error('orden_compra')

                                    <p class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                        <!-- FECHAS -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

                            <!-- FECHA ORDEN -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Fecha de Orden
                                </label>

                                <input
                                    type="date"
                                    name="fecha_orden"
                                    value="{{ old('fecha_orden') }}"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >

                                @error('fecha_orden')

                                    <p class="text-red-500 text-sm mt-1">
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
                                    value="{{ old('fecha_ingreso', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >

                                @error('fecha_ingreso')

                                    <p class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                        <!-- BOTONES -->
                        <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">

                            <a
                                href="{{ route('entradas.index') }}"
                                class="px-6 py-3 bg-gray-500 hover:bg-gray-600 transition text-white rounded-xl text-center font-semibold shadow-md"
                            >

                                Cancelar

                            </a>

                            <button
                                type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 transition text-white rounded-xl font-semibold shadow-md"
                            >

                                Guardar Entrada

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- SCRIPT -->
    <script>

        const productos = [

            @foreach($productos as $producto)

                {
                    id: "{{ $producto->id }}",
                    codigo: "{{ strtoupper($producto->codigo) }}",
                    nombre: "{{ $producto->descripcion }}"
                },

            @endforeach

        ];

        const inputCodigo = document.getElementById('buscarProducto');
        const inputNombre = document.getElementById('nombreProducto');
        const inputId = document.getElementById('productoSelect');

        inputCodigo.addEventListener('keyup', function () {

            let valor = this.value.toUpperCase().trim();

            let producto = productos.find(p => p.codigo === valor);

            if (producto) {

                inputNombre.value = producto.nombre;
                inputId.value = producto.id;

            } else {

                inputNombre.value = '';
                inputId.value = '';

            }

        });

    </script>

</x-app-layout>