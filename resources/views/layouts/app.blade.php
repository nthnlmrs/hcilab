<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Museum Singhasari') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700,800|figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-museum-beige text-museum-green min-h-screen pb-20">
        <div class="max-w-md mx-auto bg-museum-beige min-h-screen relative shadow-2xl">
            <!-- Page Heading -->
            @isset($header)
                <header class="pt-6 pb-4 px-6 sticky top-0 bg-museum-beige z-10 flex items-center justify-between">
                    {{ $header }}
                </header>
            @endisset

            <!-- Page Content -->
            <main class="px-6 pb-24">
                {{ $slot }}
            </main>

            <!-- Bottom Navigation -->
            <nav class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] z-50">
                <div class="max-w-md mx-auto flex justify-between items-center px-4 py-3 rounded-t-3xl border-t border-gray-200">
                    <a href="{{ route('home') }}" class="flex flex-col items-center {{ request()->routeIs('home') ? 'text-museum-green font-bold' : 'text-gray-500 hover:text-museum-green' }}">
                        <i class="fas fa-home text-xl mb-1"></i>
                        <span class="text-[10px]">Home</span>
                    </a>
                    <a href="{{ route('map') }}" class="flex flex-col items-center {{ request()->routeIs('map') ? 'text-museum-green font-bold' : 'text-gray-500 hover:text-museum-green' }}">
                        <i class="fas fa-map-marked-alt text-xl mb-1"></i>
                        <span class="text-[10px]">Map</span>
                    </a>
                    
                    <!-- Scan Button - Floating -->
                    <div class="relative -top-5">
                        <a href="{{ route('scan') }}" class="flex flex-col items-center justify-center w-14 h-14 bg-museum-green text-white rounded-full shadow-lg border-4 border-white hover:bg-museum-lightGreen transition-colors">
                            <i class="fas fa-qrcode text-2xl"></i>
                        </a>
                        <span class="text-[10px] text-center block mt-1 font-semibold text-museum-green">Scan</span>
                    </div>

                    <a href="{{ route('quiz.index') }}" class="flex flex-col items-center {{ request()->routeIs('quiz.*') ? 'text-museum-green font-bold' : 'text-gray-500 hover:text-museum-green' }}">
                        <i class="fas fa-clock text-xl mb-1"></i>
                        <span class="text-[10px]">Quiz</span>
                    </a>
                    <a href="{{ route('gallery') }}" class="flex flex-col items-center {{ request()->routeIs('gallery') ? 'text-museum-green font-bold' : 'text-gray-500 hover:text-museum-green' }}">
                        <i class="fas fa-images text-xl mb-1"></i>
                        <span class="text-[10px]">Gallery</span>
                    </a>
                </div>
            </nav>
        </div>
    </body>
</html>
