<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Nueva Salida
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <!-- ALERTAS -->
                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
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

                                    let entradas = prod.entradas.reduce((t, e) => t + parseFloat(e.cantidad), 0);
                                    let salidas = prod.salidas.reduce((t, s) => t + parseFloat(s.cantidad), 0);
                                    stock = entradas - salidas;
                                } else {
                                    unidad = '';
                                    stock = 0;
                                }
                            })
                        "
                    >

                        <!-- 🔍 BUSCADOR -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium">
                                Buscar Producto (Código o Nombre)
                            </label>

                            <input 
                                type="text"
                                id="buscarProducto"
                                placeholder="Ej. P001 o Tornillo"
                                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm"
                                oninput="this.value = this.value.toUpperCase()"
                            >
                        </div>

                        <!-- SELECT PRODUCTOS -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium">
                                Producto
                            </label>

                            <select 
                                name="producto_id"
                                id="productoSelect"
                                x-model="productoSeleccionado"
                                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm"
                            >
                                <option value="">Selecciona un producto</option>

                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">
                                        {{ $producto->codigo }} - {{ $producto->descripcion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('producto_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- INFO DINÁMICA -->
                        <div x-show="productoSeleccionado" 
                             class="mb-4 p-4 bg-gray-100 rounded-lg">

                            <p class="text-sm">
                                <strong>Unidad:</strong> 
                                <span x-text="unidad"></span>
                            </p>

                            <p class="text-sm font-semibold"
                               :class="stock > 0 ? 'text-green-600' : 'text-red-600'">
                                <strong>Stock disponible:</strong> 
                                <span x-text="stock"></span>
                            </p>

                        </div>

                        <!-- CANTIDAD -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium">
                                Cantidad
                            </label>

                            <input 
                                type="number"
                                name="cantidad"
                                min="1"
                                x-bind:max="stock"
                                value="{{ old('cantidad') }}"
                                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm"
                                placeholder="Ej. 10"
                            >

                            @error('cantidad')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- FECHA -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium">
                                Fecha
                            </label>

                            <input 
                                type="date"
                                name="fecha"
                                value="{{ old('fecha') }}"
                                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm"
                            >

                            @error('fecha')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- BOTONES -->
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('salidas.index') }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded">
                                Cancelar
                            </a>

                            <button 
                                type="submit"
                                :disabled="stock <= 0"
                                class="px-4 py-2 bg-red-600 text-white rounded disabled:bg-gray-400">
                                Guardar
                            </button>
                        </div>

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