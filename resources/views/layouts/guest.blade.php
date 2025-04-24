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
<body class="font-sans antialiased bg-gray-900 text-white">
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('loginbg.png')">
        <div class="w-full max-w-md bg-black bg-opacity-70 rounded-lg shadow-lg p-8 backdrop-blur-sm">
            <div class="flex flex-col items-center mb-6">
                <!-- Ganti src sesuai logo kamu -->
                <a href="/">
                    <img src="logoSMK.png" alt="Logo" class="w-20 h-20 mb-4">
                </a>
                <a href="/" class="text-white font-semibold text-lg">Beranda</a>
            </div>

            {{ $slot }}

        </div>
    </div>
</body>
</html>
