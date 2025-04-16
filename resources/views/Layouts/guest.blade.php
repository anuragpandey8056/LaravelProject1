<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white text-white">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">
        
        <!-- Logo -->
        <div class="mb-8">
            <a href="/">
                <x-application-logo class="w-24 h-24 fill-current text-white" />
            </a>
        </div>

        <!-- Larger Form Card -->
        <div class="w-full max-w-2xl bg-gray-900 shadow-2xl rounded-2xl p-10 transition-all duration-300">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
