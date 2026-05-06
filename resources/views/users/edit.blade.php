<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Editar Usuario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label class="block text-sm">Nombre</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm">Correo</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <!-- Rol -->
                <div class="mb-4">
                    <label class="block text-sm">Rol</label>
                    <select name="role" class="w-full border rounded px-3 py-2">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('users.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>

                    <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>