<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

        

    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700">

                <!-- TOP BAR -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-5">

                    <h3 class="text-white text-lg font-bold">
                        Nuevo usuario
                    </h3>

                    <p class="text-indigo-100 text-sm mt-1">
                        Completa la información para registrar un usuario
                    </p>

                </div>

                <div class="p-6 sm:p-8">

                    <!-- ERRORES -->
                    @if ($errors->any())

                        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl shadow-sm">

                            <ul class="list-disc pl-5 space-y-1">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form action="{{ route('users.store') }}"
                          method="POST">

                        @csrf

                        <!-- GRID -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- NOMBRE -->
                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Nombre completo
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Ej. Rodrigo Romero"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                >

                            </div>

                            <!-- EMAIL -->
                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="ejemplo@correo.com"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                >

                            </div>

                            <!-- PASSWORD -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Contraseña
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    placeholder="********"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                >

                            </div>

                            <!-- ROL -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Rol del usuario
                                </label>

                                <select
                                    name="role"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                >

                                    <option value="">
                                        Selecciona un rol
                                    </option>

                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="almacen" {{ old('role') == 'almacen' ? 'selected' : '' }}>
                                        Almacén
                                    </option>

                                    <option value="usuario" {{ old('role') == 'usuario' ? 'selected' : '' }}>
                                        Usuario
                                    </option>

                                </select>

                            </div>

                        </div>

                        <!-- BOTONES -->
                        <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">

                            <a
                                href="{{ route('users.index') }}"
                                class="px-6 py-3 bg-gray-500 hover:bg-gray-600 transition text-white rounded-xl text-center font-semibold shadow-md"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 transition text-white rounded-xl font-semibold shadow-md"
                            >
                                Guardar Usuario
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>