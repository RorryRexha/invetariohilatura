<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nueva Entrada
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <form action="{{ route('entradas.store') }}" method="POST">
                    @csrf

                    <!-- BUSCAR POR CÓDIGO -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Código del Producto
                        </label>

                        <input 
                            type="text"
                            id="buscarProducto"
                            placeholder="Ej. P001"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                            oninput="this.value = this.value.toUpperCase()"
                            autocomplete="off"
                        >
                    </div>

                    <!-- NOMBRE PRODUCTO AUTO -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Producto
                        </label>

                        <input 
                            type="text"
                            id="nombreProducto"
                            readonly
                            placeholder="Se llenará automáticamente"
                            class="mt-1 w-full rounded-lg bg-gray-100 border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm"
                        >
                    </div>

                    <!-- SELECT OCULTO -->
                    <input type="hidden" name="producto_id" id="productoSelect">

                    @error('producto_id')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    <!-- Cantidad -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Cantidad
                        </label>

                        <input 
                            type="number" 
                            name="cantidad" 
                            value="{{ old('cantidad') }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                            placeholder="Ej. 100"
                        >

                        @error('cantidad')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Orden Compra -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Orden de Compra
                        </label>

                        <input 
                            type="text" 
                            name="orden_compra" 
                            value="{{ old('orden_compra') }}"
                            oninput="this.value = this.value.toUpperCase()"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                            placeholder="Ej. OC-12345"
                        >

                        @error('orden_compra')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha Orden -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Fecha de Orden
                        </label>

                        <input 
                            type="date" 
                            name="fecha_orden" 
                            value="{{ old('fecha_orden') }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                        >

                        @error('fecha_orden')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha Ingreso -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Fecha de Ingreso
                        </label>

                        <input 
                            type="date" 
                            name="fecha_ingreso" 
                            value="{{ old('fecha_ingreso', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                        >

                        @error('fecha_ingreso')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('entradas.index') }}" 
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Cancelar
                        </a>

                        <button 
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    <!-- SCRIPT AUTO PRODUCTO -->
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