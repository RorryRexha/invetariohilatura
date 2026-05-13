<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans text-gray-900 antialiased">

    <!-- FONDO -->
    <div class="fixed inset-0">

        <img src="{{ asset('images/fondo_hilatex.jpg') }}"
             class="w-full h-full object-cover"
             alt="Fondo">

        <!-- OSCURECER -->
        <div class="absolute inset-0 bg-black/60"></div>

    </div>

    <!-- CONTENIDO -->
    <div class="relative min-h-screen flex flex-col items-center justify-center px-4">

        {{ $slot }}

    </div>

</body>
</html>