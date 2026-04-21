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

                    <!-- 🔍 BUSCADOR -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Buscar Producto (Código o Nombre)
                        </label>

                        <input 
                            type="text"
                            id="buscarProducto"
                            placeholder="Ej. P001 o Tornillo"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                            oninput="this.value = this.value.toUpperCase()"
                        >
                    </div>

                    <!-- SELECT PRODUCTOS -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Producto
                        </label>

                        <select 
                            name="producto_id"
                            id="productoSelect"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm"
                        >
                            <option value="">Selecciona un producto</option>

                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">
                                    {{ $producto->codigo }} - {{ $producto->descripcion }}
                                </option>
                            @endforeach
                        </select>

                        @error('producto_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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

                    <!-- Orden de compra -->
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

                    <!-- Fecha orden -->
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

                    <!-- Fecha ingreso -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Fecha de Ingreso
                        </label>

                        <input 
                            type="date" 
                            name="fecha_ingreso" 
                            value="{{ old('fecha_ingreso') }}"
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

    <!-- 🔥 SCRIPT BUSCADOR -->
    <script>
        document.getElementById('buscarProducto').addEventListener('keyup', function () {
            let filtro = this.value.toLowerCase();
            let opciones = document.getElementById('productoSelect').options;

            for (let i = 0; i < opciones.length; i++) {
                let texto = opciones[i].text.toLowerCase();
                opciones[i].style.display = texto.includes(filtro) ? '' : 'none';
            }
        });
    </script>

</x-app-layout>