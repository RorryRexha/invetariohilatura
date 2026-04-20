<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Inventario Hilatura</h1>

        <div>
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="mr-2 text-blue-500">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Registrarse
                </a>
            @endauth
        </div>
    </nav>

    <!-- HERO -->
    <section class="flex flex-col items-center justify-center text-center mt-20 px-6">
        <h2 class="text-4xl font-bold mb-4">
            Sistema de Control de Inventario
        </h2>

        <p class="text-gray-600 mb-6 max-w-xl">
            Administra productos, controla entradas y salidas, y lleva un seguimiento en tiempo real de tu inventario.
        </p>

        @auth
            <a href="{{ url('/dashboard') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg text-lg">
                Ir al sistema 
            </a>
        @else
            <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg">
                Iniciar sesión
            </a>
        @endauth
    </section>

    <!-- FEATURES -->
    <section class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 px-10">
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-bold text-lg mb-2">Gestión de Productos</h3>
            <p class="text-gray-600">Agrega, edita y elimina productos fácilmente.</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-bold text-lg mb-2">Control de Stock</h3>
            <p class="text-gray-600">Visualiza el stock en tiempo real.</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-bold text-lg mb-2">Movimientos</h3>
            <p class="text-gray-600">Registra entradas y salidas de inventario.</p>
        </div>

    </section>

    <!-- FOOTER -->
    <footer class="mt-20 text-center text-gray-500 pb-6">
        © {{ date('Y') }} SATEX TEXTIL
    </footer>

</body>
</html>