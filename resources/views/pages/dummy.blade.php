<x-app-layout>
    <div class="pt-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">{{ $title }}</h1>
        </div>
        
        <div class="bg-white rounded-3xl p-6 shadow-sm min-h-[60vh] flex items-center justify-center text-center">
            <div>
                <i class="{{ $icon }} text-5xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-bold text-gray-400 mb-2">{{ $title }} Page</h2>
                <p class="text-gray-400 text-sm">This is a dummy page. Content will be added later.</p>
            </div>
        </div>
    </div>
</x-app-layout>
