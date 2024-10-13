<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black w-full dark:text-white/50 min-h-screen">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 w-full min-h-screen">
        <div
            class="relative min-h-funn flex w-full flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full px-6 max-w-7xl">
                @include('components.header') <!-- Header -->
                <main class="mt-6">
                    @yield('content') <!-- Content -->
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
