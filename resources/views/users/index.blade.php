<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

        

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- ALERTA -->
            @if(session('success'))

                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>

            @endif

            <!-- TOP BAR -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <!-- TITULO -->
                    <div>

                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Lista de Usuarios
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Usuarios registrados en la plataforma
                        </p>

                    </div>

                    <!-- BOTON -->
                    <div>

                        <a href="{{ route('users.create') }}"
                           class="inline-flex items-center justify-center gap-2
                                  bg-indigo-600 hover:bg-indigo-700
                                  text-white font-semibold
                                  px-5 py-3
                                  rounded-xl
                                  shadow-md
                                  transition duration-200 hover:-translate-y-0.5">

                            <span class="text-lg font-bold">+</span>

                            Nuevo Usuario

                        </a>

                    </div>

                </div>

            </div>

            <!-- TABLA DESKTOP -->
            <div class="hidden lg:block bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm text-left">

                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-xs">

                            <tr>

                                <th class="px-6 py-4">
                                    Nombre
                                </th>

                                <th class="px-6 py-4">
                                    Correo
                                </th>

                                <th class="px-6 py-4">
                                    Rol
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($users as $user)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                    <!-- NOMBRE -->
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-800 dark:text-white">
                                                    {{ $user->name }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <!-- EMAIL -->
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">

                                        {{ $user->email }}

                                    </td>

                                    <!-- ROL -->
                                    <td class="px-6 py-4">

                                        @php
                                            $rol = $user->getRoleNames()->first();
                                        @endphp

                                        @if($rol === 'admin')

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $rol }}
                                            </span>

                                        @elseif($rol === 'almacen')

                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $rol }}
                                            </span>

                                        @else

                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $rol }}
                                            </span>

                                        @endif

                                    </td>

                                    <!-- ACCIONES -->
                                    <td class="px-6 py-4">

                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-xs shadow transition">

                                                Editar

                                            </a>

                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Eliminar usuario?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-xs shadow transition">

                                                    Eliminar

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center py-10 text-gray-500">

                                        No hay usuarios registrados

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- MOBILE -->
            <div class="grid grid-cols-1 gap-4 lg:hidden">

                @forelse($users as $user)

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 space-y-4">

                        <!-- HEADER -->
                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-lg">

                                {{ strtoupper(substr($user->name, 0, 1)) }}

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-800 dark:text-white">
                                    {{ $user->name }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $user->email }}
                                </p>

                            </div>

                        </div>

                        <!-- ROL -->
                        <div>

                            <span class="text-sm text-gray-500">
                                Rol:
                            </span>

                            @php
                                $rol = $user->getRoleNames()->first();
                            @endphp

                            @if($rol === 'admin')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold ml-2">
                                    {{ $rol }}
                                </span>

                            @elseif($rol === 'almacen')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold ml-2">
                                    {{ $rol }}
                                </span>

                            @else

                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold ml-2">
                                    {{ $rol }}
                                </span>

                            @endif

                        </div>

                        <!-- BOTONES -->
                        <div class="flex gap-2 pt-2">

                            <a href="{{ route('users.edit', $user->id) }}"
                               class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-white text-center py-2 rounded-xl text-sm shadow">

                                Editar

                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('¿Eliminar usuario?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl text-sm shadow">

                                    Eliminar

                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-10 text-center text-gray-500">

                        No hay usuarios registrados

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>