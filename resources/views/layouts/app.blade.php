<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-museum-beige">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Museum Singhasari') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
            .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        </style>
    </head>
    <body class="font-sans antialiased h-full text-museum-darkGreen bg-museum-beige">
        <div class="min-h-full flex flex-col max-w-md mx-auto bg-[#D8C8AD]/30 relative shadow-2xl">
            <!-- Header (Optional for pages) -->
            @if (isset($header))
                <header class="pt-8 px-6 flex justify-between items-center mb-6">
                    {{ $header }}
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 px-6">
                {{ $slot }}
            </main>

            <!-- Bottom Navigation -->
            <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.05)] rounded-t-[40px] px-6 py-4 flex justify-between items-center z-50">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-home text-lg"></i>
                    <span class="text-xs font-bold">Home</span>
                </a>
                <a href="{{ route('map') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('map') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-map-marked-alt text-lg"></i>
                    <span class="text-xs font-bold">Map</span>
                </a>

                <!-- Center Scan Button -->
                <div class="relative -top-10">
                    <a href="{{ route('scan') }}" class="w-16 h-16 bg-museum-green rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white active:scale-90 transition-transform duration-200">
                        <i class="fas fa-qrcode text-2xl"></i>
                    </a>
                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-xs font-black text-museum-green uppercase tracking-tighter">Scan</span>
                </div>

                <a href="{{ route('quiz.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('quiz.*') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-lightbulb text-lg"></i>
                    <span class="text-xs font-bold">Quiz</span>
                </a>
                <a href="{{ route('gallery') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('gallery') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-images text-lg"></i>
                    <span class="text-xs font-bold">Gallery</span>
                </a>
            </nav>
        </div>
    </body>
</html>
