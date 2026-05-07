<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="font-serif text-3xl font-bold text-museum-green">Singhasari Museum</h1>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden border-2 border-white shadow-sm flex-shrink-0">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=004d40&color=fff" alt="Profile" class="w-full h-full object-cover">
        </a>
    </x-slot>

    <!-- Search Bar -->
    <div class="mb-6 mt-2 relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-museum-green/30 rounded-full bg-transparent placeholder-museum-green/50 text-museum-green focus:outline-none focus:ring-1 focus:ring-museum-green focus:border-museum-green sm:text-sm" placeholder="Search">
    </div>

    <!-- Welcome Section -->
    <div class="bg-museum-green rounded-3xl p-6 text-white mb-8 shadow-lg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-10 -mt-10"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-8 -mb-8"></div>
        
        <div class="relative z-10 flex flex-col h-48 justify-center">
            <h2 class="font-serif text-3xl font-bold leading-tight mb-2">Welcome to<br>Singhasari<br>Museum</h2>
            <p class="text-xs text-white/80 max-w-[60%] mb-4 leading-tight">Explore the historical heritage of Singhasari kingdom located in Malang, East Java.</p>
            <div>
                <a href="#" class="inline-block px-4 py-1.5 border border-white rounded-full text-xs font-semibold hover:bg-white hover:text-museum-green transition-colors">More About Us</a>
            </div>
        </div>
        
        <div class="flex gap-2 mt-4 relative z-10">
            <div class="h-16 flex-1 rounded-xl bg-white/20 overflow-hidden"><img src="https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=300&h=200&fit=crop" class="w-full h-full object-cover opacity-80" alt="Museum"></div>
            <div class="h-16 flex-1 rounded-xl bg-white/20 overflow-hidden"><img src="https://images.unsplash.com/photo-1518998053401-87891316b25f?w=300&h=200&fit=crop" class="w-full h-full object-cover opacity-80" alt="Museum"></div>
            <div class="h-16 flex-1 rounded-xl bg-white/20 overflow-hidden"><img src="https://images.unsplash.com/photo-1565544760596-f94da68f44ff?w=300&h=200&fit=crop" class="w-full h-full object-cover opacity-80" alt="Museum"></div>
        </div>
    </div>

    <!-- Events Section -->
    <div class="bg-museum-green rounded-3xl p-5 mb-8 shadow-lg">
        <h3 class="text-white text-sm font-semibold mb-4 uppercase tracking-wider">Upcoming Events</h3>
        
        <div class="space-y-4">
            @php
                $events = \App\Models\Event::latest()->take(3)->get();
            @endphp
            @forelse($events as $event)
            <div class="relative h-32 rounded-2xl overflow-hidden group shadow-md">
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-museum-darkGreen flex items-center justify-center">
                         <i class="fas fa-calendar text-white opacity-20 text-4xl"></i>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col items-center justify-center text-center p-4">
                    <h4 class="font-serif text-white text-xl font-bold mb-1">{{ $event->title }}</h4>
                    <a href="#" class="px-4 py-1 border border-white text-white text-[10px] uppercase font-black rounded-full hover:bg-white hover:text-museum-green transition-colors">Learn More</a>
                </div>
            </div>
            @empty
                <div class="text-white/60 text-center py-4 text-xs italic">
                    No events scheduled at the moment.
                </div>
            @endforelse
        </div>
    </div>

    <!-- About Us Section -->
    <div class="mb-4">
        <h3 class="font-serif text-2xl font-bold mb-3 text-museum-green">About Us</h3>
        <div class="flex gap-4">
            <div class="flex-1 text-xs leading-relaxed text-justify text-gray-700">
                <p class="mb-2">Singhasari Museum is a general museum that was inaugurated on May 20, 2015. The land on which the museum was built was a donation from the owner of Singhasari Residence Housing. This museum is under the ownership of the Malang Regency Government and is managed by the Malang Regency Department of Culture and Tourism.</p>
                
                <div class="mt-4 space-y-2">
                    <p class="flex items-center"><i class="fas fa-phone w-5 text-museum-brown"></i> 082137777325</p>
                    <p class="flex items-center"><i class="fab fa-instagram w-5 text-museum-brown"></i> @museumsinghasari</p>
                    <p class="mt-2"><span class="font-bold text-museum-green">OPEN:</span> Senin-Jumat 09.00-15.00</p>
                    <p class="text-red-700 font-bold uppercase tracking-tighter">Closed: Saturday, Sunday, & Public Holidays</p>
                    <p class="mt-2 text-gray-500 italic">Desa Klampok, Kecamatan Singosari, 65153 Malang</p>
                </div>
            </div>
            <div class="w-1/3">
                <img src="https://images.unsplash.com/photo-1596484552834-6a58f850d0a1?w=300&h=400&fit=crop" alt="Museum Building" class="w-full rounded-2xl object-cover h-full shadow-lg">
            </div>
        </div>
    </div>
</x-app-layout>
