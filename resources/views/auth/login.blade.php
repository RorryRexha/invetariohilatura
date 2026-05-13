<x-guest-layout>

    <!-- FONDO -->
    <div class="fixed inset-0 -z-10">

        <!-- IMAGEN -->
        <img src="{{ asset('images/cotton.jpg') }}"
             alt="Fondo"
             class="w-full h-full object-cover">

        <!-- OVERLAY -->
        <div class="absolute inset-0 bg-black/50"></div>

    </div>

    <!-- CONTENEDOR -->
    <div class="w-full max-w-md px-4 sm:px-0">

        <!-- CARD -->
        <div class="
            bg-white/10
            backdrop-blur-xl
            border border-white/20
            rounded-2xl
            shadow-2xl
            p-5 sm:p-8
        ">

            <!-- LOGO -->
            <div class="flex flex-col items-center mb-6">

                <img src="{{ asset('images/hilatex.png') }}"
                     alt="HilaTex Stock"
                     class="w-52 sm:w-64 md:w-72 mb-4">

            </div>

            <!-- STATUS -->
            <x-auth-session-status
                class="mb-4 text-white"
                :status="session('status')"
            />

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div>

                    <x-input-label
                        for="email"
                        value="Correo electrónico"
                        class="text-white text-sm sm:text-base"
                    />

                    <x-text-input
                        id="email"
                        class="
                            block mt-1 w-full
                            rounded-lg
                            bg-white/20
                            border-white/20
                            text-white
                            placeholder-gray-300
                            focus:border-blue-400
                            focus:ring-blue-400
                            text-sm sm:text-base
                        "
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                    />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2"
                    />

                </div>

                <!-- PASSWORD -->
                <div class="mt-4">

                    <x-input-label
                        for="password"
                        value="Contraseña"
                        class="text-white text-sm sm:text-base"
                    />

                    <x-text-input
                        id="password"
                        class="
                            block mt-1 w-full
                            rounded-lg
                            bg-white/20
                            border-white/20
                            text-white
                            placeholder-gray-300
                            focus:border-blue-400
                            focus:ring-blue-400
                            text-sm sm:text-base
                        "
                        type="password"
                        name="password"
                        required
                    />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />

                </div>

                <!-- REMEMBER -->
                <div class="flex items-center mt-4">

                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-blue-600 shadow-sm"
                    >

                    <span class="ml-2 text-sm text-gray-200">
                        Recordarme
                    </span>

                </div>

                <!-- ACTIONS -->
                <div class="
                    flex flex-col sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4
                    mt-6
                ">

                    @if (Route::has('password.request'))

                        <a
                            class="text-sm text-gray-200 hover:text-white transition text-center sm:text-left"
                            href="{{ route('password.request') }}"
                        >
                            ¿Olvidaste tu contraseña?
                        </a>

                    @endif

                    <button
                        type="submit"
                        class="
                            w-full sm:w-auto
                            bg-blue-700
                            hover:bg-blue-800
                            transition
                            text-white
                            px-6 py-2.5
                            rounded-lg
                            shadow-lg
                            text-sm sm:text-base
                        "
                    >

                        Iniciar sesión

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>