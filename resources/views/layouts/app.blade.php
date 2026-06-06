<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-museum-beige">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Museum Singhasari') }}</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="font-sans antialiased h-full text-museum-text bg-museum-beige">
        
        <div x-data="{ isCollapsed: false }" class="min-h-full flex flex-col md:flex-row bg-[#D8C8AD]/30 relative">

            <!-- Desktop Sidebar -->
            <aside 
                :class="isCollapsed ? 'w-20' : 'w-64'"
                class="hidden md:flex flex-col fixed inset-y-0 bg-white shadow-2xl z-50 transition-all duration-300 overflow-hidden border-r border-gray-100">
                
                <div class="p-6 flex items-center" :class="isCollapsed ? 'justify-center' : 'justify-between'">
                    <h1 x-show="!isCollapsed" x-transition.opacity class="font-serif text-xl font-bold text-museum-green leading-tight">
                        Singhasari
                    </h1>
                    <button @click="isCollapsed = !isCollapsed" class="p-2 rounded-lg hover:bg-museum-beige text-museum-green transition-colors">
                        <i class="fas" :class="isCollapsed ? 'fa-indent' : 'fa-outdent'"></i>
                    </button>
                </div>
                
                <nav class="flex-1 px-4 space-y-4 mt-4 overflow-y-auto">
                    <!-- Dashboard -->
                    <div class="space-y-1">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('home') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                            <i class="fas fa-chart-line text-lg w-6 text-center"></i>
                            <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Dashboard</span>
                        </a>
                    </div>

                    <!-- User Section -->
                    <div class="space-y-1">
                        <div x-show="!isCollapsed" x-transition.opacity class="px-4 py-1 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest select-none">User Section</div>
                        <a href="{{ route('map') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('map') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                            <i class="fas fa-map-marked-alt text-lg w-6 text-center"></i>
                            <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Map</span>
                        </a>
                        <a href="{{ route('quiz.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('quiz.*') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                            <i class="fas fa-lightbulb text-lg w-6 text-center"></i>
                            <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Quiz</span>
                        </a>
                        <a href="{{ route('collection.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('collection.index') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                            <i class="fas fa-shapes text-lg w-6 text-center"></i>
                            <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Collection</span>
                        </a>
                        <a href="{{ route('stories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('stories.*') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                            <i class="fas fa-book-open text-lg w-6 text-center"></i>
                            <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Stories</span>
                        </a>
                        <a href="{{ route('gallery') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('gallery') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                            <i class="fas fa-images text-lg w-6 text-center"></i>
                            <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Gallery</span>
                        </a>
                    </div>

                    <!-- Admin Control -->
                    @auth
                        @if(Auth::user()->role === 'admin')
                        <div class="space-y-1">
                            <div x-show="!isCollapsed" x-transition.opacity class="px-4 py-1 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest mt-2 select-none">Admin Control</div>
                            
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                                <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                                <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Dashboard</span>
                            </a>
                            <a href="{{ route('admin.pages.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.pages.create') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                                <i class="fas fa-file-medical text-lg w-6 text-center"></i>
                                <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Create Page</span>
                            </a>
                            <a href="{{ route('admin.quizzes.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.quizzes.create') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                                <i class="fas fa-question-circle text-lg w-6 text-center"></i>
                                <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Create Quiz</span>
                            </a>
                            <a href="{{ route('admin.events.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.events.create') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                                <i class="fas fa-calendar-plus text-lg w-6 text-center"></i>
                                <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Create Event</span>
                            </a>
                            <a href="{{ route('admin.collections.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.collections.*') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                                <i class="fas fa-shapes text-lg w-6 text-center"></i>
                                <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Manage Collections</span>
                            </a>
                            <a href="{{ route('admin.stories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.stories.*') ? 'bg-museum-green text-white shadow-md' : 'text-gray-600 hover:bg-museum-beige' }}">
                                <i class="fas fa-book-open text-lg w-6 text-center"></i>
                                <span x-show="!isCollapsed" x-transition.opacity class="font-bold">Manage Stories</span>
                            </a>
                        </div>
                        @endif
                    @endauth
                </nav>
            </aside>

            <!-- Main Content Area -->
            <div 
                :class="isCollapsed ? 'md:ml-20' : 'md:ml-64'"
                class="flex-1 flex flex-col min-h-screen w-full transition-all duration-300">
                
                <!-- Top Navbar -->
                @if(request()->routeIs('home'))
                <header class="flex items-center justify-between bg-white sticky top-0 z-40 px-6 md:px-8 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div>
                            <h2 class="text-sm font-semibold text-museum-green tracking-widest uppercase">
                                @yield('section_name', 'Dashboard')
                            </h2>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        @auth
                            <!-- Jika Sudah Login -->
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                                <div class="text-right hidden md:block">
                                    <p class="text-sm font-bold text-museum-text leading-none group-hover:text-museum-green transition-colors">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium mt-1 uppercase tracking-tighter">Administrator</p>
                                </div>
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full border-2 border-museum-green p-0.5 group-hover:scale-110 transition-transform">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=004d40&color=fff" alt="Profile" class="w-full h-full rounded-full object-cover">
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                            </a>
                        @else
                            <!-- Jika Guest -->
                            <a href="{{ route('login') }}" class="flex items-center gap-2 px-6 py-3.5 rounded-lg bg-museum-green text-white font-bold text-sm shadow-md hover:bg-museum-darkGreen hover:shadow-lg transition-all active:scale-95">
                                <i class="fas fa-sign-in-alt text-xs"></i>
                                <span class="hidden md:inline">Masuk</span>
                            </a>
                        @endauth
                    </div>
                </header>
                @endif

                <main class="flex-1 px-6 md:px-10 py-8 pb-28 md:pb-10 max-w-7xl mx-auto w-full">
                    {{ $slot }}
                </main>
            </div>

            <!-- Mobile Bottom Navigation -->
            <nav class="md:hidden fixed bottom-0 left-0 w-full bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.1)] rounded-t-[40px] px-4 py-4 flex justify-between items-center z-50">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-home text-lg"></i>
                    <span class="text-[10px] font-bold">Home</span>
                </a>
                <a href="{{ route('map') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('map') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-map-marked-alt text-lg"></i>
                    <span class="text-[10px] font-bold">Map</span>
                </a>
                <div class="relative -top-10 px-2">
                    <a href="{{ route('scan') }}" class="w-14 h-14 bg-museum-green rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white active:scale-90 transition-transform">
                        <i class="fas fa-qrcode text-xl"></i>
                    </a>
                </div>
                <a href="{{ route('quiz.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('quiz.*') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-lightbulb text-lg"></i>
                    <span class="text-[10px] font-bold">Quiz</span>
                </a>
                <a href="{{ route('gallery') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('gallery') ? 'text-museum-green' : 'text-gray-500' }}">
                    <i class="fas fa-images text-lg"></i>
                    <span class="text-[10px] font-bold">Gallery</span>
                </a>

                @auth
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.*') ? 'text-museum-green' : 'text-gray-500' }}">
                        <i class="fas fa-shield-alt text-lg"></i>
                        <span class="text-[10px] font-bold">Admin</span>
                    </a>
                    @endif
                @endauth
            </nav>
        </div>
    </body>
</html>