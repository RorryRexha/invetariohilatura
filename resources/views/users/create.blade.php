<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Crear Usuario</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Nombre -->
                <input type="text" name="name" placeholder="Nombre"
                    class="w-full mb-3 border rounded p-2">

                <!-- Email -->
                <input type="email" name="email" placeholder="Correo"
                    class="w-full mb-3 border rounded p-2">

                <!-- Password -->
                <input type="password" name="password" placeholder="Contraseña"
                    class="w-full mb-3 border rounded p-2">

                <!-- Rol -->
                <select name="role" class="w-full mb-3 border rounded p-2">
                    <option value="">Selecciona rol</option>
                    <option value="admin">Admin</option>
                    <option value="almacen">Almacén</option>
                    <option value="usuario">Usuario</option>
                </select>

                <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Guardar
                </button>

            </form>

        </div>
    </div>
</x-app-layout>