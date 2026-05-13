<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">

      

    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700">

                <!-- TOP BAR -->
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-5">

                    <h3 class="text-white text-lg font-bold">
                        Actualizar usuario
                    </h3>

                    <p class="text-yellow-100 text-sm mt-1">
                        Edita la información del usuario seleccionado
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

                    <form action="{{ route('users.update', $user->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

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
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Ej. Rodrigo Romero"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
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
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="ejemplo@correo.com"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                                >

                            </div>

                            <!-- ROL -->
                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Rol del usuario
                                </label>

                                <select
                                    name="role"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                                >

                                    @foreach($roles as $role)

                                        <option value="{{ $role->name }}"
                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>

                                            {{ ucfirst($role->name) }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!-- INFO -->
                        <div class="mt-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-2xl p-4">

                            <p class="text-sm text-yellow-700 dark:text-yellow-300">

                                Estás modificando la información de:
                                <span class="font-bold">
                                    {{ $user->name }}
                                </span>

                            </p>

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
                                class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 transition text-white rounded-xl font-semibold shadow-md"
                            >
                                Actualizar Usuario
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>