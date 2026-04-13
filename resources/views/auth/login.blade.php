<x-guest-layout>

    <div class="flex flex-col items-center mb-6">
        <!-- LOGO -->
        <img src="{{ asset('images/logoSatex.png') }}" alt="Satex Textil" class="w-40 mb-4">

       
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember -->
        <div class="block mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                <span class="ml-2 text-sm text-gray-600">
                    Recordarme
                </span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 hover:text-gray-700"
                   href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                Iniciar sesión
            </button>

        </div>
    </form>

</x-guest-layout>