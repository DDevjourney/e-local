<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'E-Local') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">

            {{-- Cabecera --}}
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                    <a href="/" class="flex items-center gap-2.5">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-accent-600 text-white font-semibold text-sm">EL</span>
                        <span class="text-lg font-semibold tracking-tight">E&#8209;Local</span>
                    </a>

                    @if (Route::has('login'))
                        <nav class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium transition-colors">Panel</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">Iniciar sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium transition-colors">Registrarse</a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </header>

            {{-- Hero --}}
            <main class="flex-1">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
                    <div class="max-w-2xl">
                        <p class="text-sm font-medium uppercase tracking-wider text-accent-700 dark:text-accent-400">Gestión para tu comercio local</p>
                        <h1 class="mt-4 text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                            Tu negocio, bajo control.
                        </h1>
                        <p class="mt-6 text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                            Administra productos, clientes, pedidos y categorías desde un único panel claro y sin distracciones. Hecho para el día a día del comercio de barrio.
                        </p>
                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-2.5 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium transition-colors">Ir al panel</a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium transition-colors">Empezar ahora</a>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 rounded-md border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 transition-colors">Iniciar sesión</a>
                            @endauth
                        </div>
                    </div>

                    {{-- Secciones --}}
                    <div class="mt-20 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                            <p class="font-semibold text-gray-900 dark:text-gray-100">Inventario</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Controla stock y precios de un vistazo.</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                            <p class="font-semibold text-gray-900 dark:text-gray-100">Pedidos</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Registra y sigue cada pedido por estado.</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                            <p class="font-semibold text-gray-900 dark:text-gray-100">Clientes</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Tu cartera de clientes, siempre a mano.</p>
                        </div>
                    </div>
                </div>
            </main>

            {{-- Pie --}}
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-gray-500 dark:text-gray-400">
                    <p>© {{ date('Y') }} E&#8209;Local</p>
                    <p>Laravel v{{ app()->version() }}</p>
                </div>
            </footer>

        </div>
    </body>
</html>
