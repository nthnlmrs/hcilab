<x-app-layout>
    <div class="pt-6 pb-24 h-full flex flex-col items-center justify-center text-center">
        <div class="w-24 h-24 rounded-full bg-museum-green/10 flex items-center justify-center text-museum-green mb-6">
             <i class="{{ $icon }} text-4xl"></i>
        </div>
        <h1 class="font-serif text-3xl font-bold text-museum-green mb-4">{{ $title }}</h1>
        <p class="text-sm text-gray-500 max-w-xs leading-relaxed">
            This section is currently under development. Soon you'll be able to explore the full {{ strtolower($title) }} of Museum Singhasari here.
        </p>
        
        <div class="mt-10 grid grid-cols-2 gap-4 w-full">
            <div class="h-32 bg-gray-100 rounded-3xl animate-pulse"></div>
            <div class="h-32 bg-gray-100 rounded-3xl animate-pulse"></div>
            <div class="h-32 bg-gray-100 rounded-3xl animate-pulse"></div>
            <div class="h-32 bg-gray-100 rounded-3xl animate-pulse"></div>
        </div>
    </div>
</x-app-layout>
