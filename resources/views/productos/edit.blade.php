<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Código -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Código
                        </label>
                        <input 
                            type="text" 
                            name="codigo" 
                            value="{{ old('codigo', $producto->codigo) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        @error('codigo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Descripción
                        </label>
                        <input 
                            type="text" 
                            name="descripcion" 
                            value="{{ old('descripcion', $producto->descripcion) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        @error('descripcion')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unidad de medida -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Unidad de Medida
                        </label>
                        <select 
                            name="unidad_medida"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">Selecciona una unidad</option>
                            <option value="Piezas" {{ $producto->unidad_medida == 'Piezas' ? 'selected' : '' }}>Piezas</option>
                            <option value="Litros" {{ $producto->unidad_medida == 'Litros' ? 'selected' : '' }}>Litros</option>
                            <option value="Kg" {{ $producto->unidad_medida == 'Kg' ? 'selected' : '' }}>Kilogramos</option>
                            <option value="Metros" {{ $producto->unidad_medida == 'Metros' ? 'selected' : '' }}>Metros</option>
                        </select>
                        @error('unidad_medida')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('productos.index') }}" 
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