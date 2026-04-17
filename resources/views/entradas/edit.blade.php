<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Entrada') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <form action="{{ route('entradas.update', $entrada->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Producto -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Producto
                        </label>
                        <select 
                            name="producto_id"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">Selecciona un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}"
                                    {{ old('producto_id', $entrada->producto_id) == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->descripcion }}
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
                            value="{{ old('cantidad', $entrada->cantidad) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                            value="{{ old('orden_compra', $entrada->orden_compra) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                            value="{{ old('fecha_orden', $entrada->fecha_orden) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                            value="{{ old('fecha_ingreso', $entrada->fecha_ingreso) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                            class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            Actualizar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>