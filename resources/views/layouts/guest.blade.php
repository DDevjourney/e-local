<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Local') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
        <div class="min-h-screen flex flex-col justify-center items-center px-6 py-12 bg-gray-100 dark:bg-gray-900">
            <a href="/" class="mb-6 flex items-center gap-2.5">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-accent-600 text-white font-semibold text-sm">EL</span>
                <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">E&#8209;Local</span>
            </a>

            <div class="w-full sm:max-w-md bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm px-6 py-8">
                {{ $slot }}
            </div>
        </div>

        <x-toast />
    </body>
</html>
