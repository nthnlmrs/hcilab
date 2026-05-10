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
        <div class="min-h-full flex flex-col md:flex-row bg-[#D8C8AD]/30 relative">

            <!-- Desktop Sidebar (Hidden on Mobile) -->
            <aside class="hidden md:flex flex-col w-64 fixed inset-y-0 bg-white shadow-xl z-50">
                <div class="p-6">
                    <h1 class="font-serif text-2xl font-bold text-museum-green">Singhasari<br>Museum</h1>
                </div>
                <nav class="flex-1 px-4 space-y-4 mt-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('home') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                        <i class="fas fa-home text-lg w-6 text-center"></i>
                        <span class="font-bold">Home</span>
                    </a>
                    <a href="{{ route('map') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('map') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                        <i class="fas fa-map-marked-alt text-lg w-6 text-center"></i>
                        <span class="font-bold">Map</span>
                    </a>
                    <a href="{{ route('quiz.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('quiz.*') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                        <i class="fas fa-lightbulb text-lg w-6 text-center"></i>
                        <span class="font-bold">Quiz</span>
                    </a>
                    <a href="{{ route('gallery') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('gallery') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                        <i class="fas fa-images text-lg w-6 text-center"></i>
                        <span class="font-bold">Gallery</span>
                    </a>
                </nav>
                <div class="p-4 mt-auto border-t border-gray-100">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-museum-beige transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden flex-shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=004d40&color=fff" alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <span class="font-bold truncate">{{ Auth::user()->name ?? 'Profile' }}</span>
                    </a>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-h-screen md:ml-64 w-full">
                <!-- Header (Optional for pages) -->
                @if (isset($header))
                    <header class="pt-8 px-6 md:px-10 flex justify-between items-center mb-6">
                        {{ $header }}
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-1 px-6 md:px-10 pb-28 md:pb-10 max-w-7xl mx-auto w-full">
                    {{ $slot }}
                </main>
            </div>

            <!-- Mobile Bottom Navigation (Hidden on Desktop) -->
            <nav class="md:hidden fixed bottom-0 left-0 w-full bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.05)] rounded-t-[40px] px-6 py-4 flex justify-between items-center z-50">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-home text-lg"></i>
                    <span class="text-[10px] sm:text-xs font-bold">Home</span>
                </a>
                <a href="{{ route('map') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('map') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-map-marked-alt text-lg"></i>
                    <span class="text-[10px] sm:text-xs font-bold">Map</span>
                </a>

                <!-- Center Scan Button -->
                <div class="relative -top-10">
                    <a href="{{ route('scan') }}" class="w-14 h-14 sm:w-16 sm:h-16 bg-museum-green rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white active:scale-90 transition-transform duration-200">
                        <i class="fas fa-qrcode text-xl sm:text-2xl"></i>
                    </a>
                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] sm:text-xs font-black text-museum-green uppercase tracking-tighter">Scan</span>
                </div>

                <a href="{{ route('quiz.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('quiz.*') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-lightbulb text-lg"></i>
                    <span class="text-[10px] sm:text-xs font-bold">Quiz</span>
                </a>
                <a href="{{ route('gallery') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('gallery') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-images text-lg"></i>
                    <span class="text-[10px] sm:text-xs font-bold">Gallery</span>
                </a>
            </nav>
        </div>
    </body>
</html>
