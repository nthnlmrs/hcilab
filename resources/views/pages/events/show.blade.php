@section('section_name', 'Event Detail')
<x-app-layout>
    <div class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-[#FAF6EE]">
        
        <!-- Hero Cover Area -->
        <div class="relative h-[300px] md:h-[400px] w-full overflow-hidden shadow-sm">
            @if($event->image)
                <img src="{{ $event->image_url }}" class="absolute inset-0 w-full h-full object-cover object-center select-none" alt="{{ $event->title }}">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-[#1b4a47] to-[#0f2f2e]"></div>
            @endif
            
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            
            <!-- Back Button and Title -->
            <div class="absolute inset-0 z-10 flex flex-col justify-between p-6 md:p-8">
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-11 h-11 bg-white text-[#1B4A47] hover:bg-[#FAF6EE] rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all select-none">
                        <i class="fas fa-arrow-left text-base"></i>
                    </a>
                </div>
                
                <div class="text-white max-w-2xl">
                    <span class="inline-block bg-[#b4853e] text-[#FAF6EE] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-3 shadow-sm">
                        {{ $event->category ?? 'Pameran Terbaru' }}
                    </span>
                    <h1 class="font-serif text-2xl md:text-3xl font-extrabold mb-2 leading-tight">{{ $event->title }}</h1>
                    <p class="font-sans text-xs md:text-sm text-white/80 leading-relaxed font-medium">{{ Str::limit($event->description, 120) }}</p>
                </div>
            </div>
        </div>

        <!-- Read Content Area (Pops over the cover image) -->
        <div class="relative -mt-6 z-20 bg-white rounded-t-[30px] shadow-2xl border-t border-[#EADFCB]/10 pb-32">
            <div class="max-w-2xl mx-auto px-6 py-8">
                
                <!-- Date, Location & Duration row -->
                <div class="grid grid-cols-3 gap-4 border-b border-gray-200/50 pb-6 mb-6">
                    <div class="flex items-start gap-2">
                        <i class="far fa-calendar-alt text-base text-[#1b4a47] mt-0.5"></i>
                        <div>
                            <p class="text-[8px] text-gray-400 font-bold uppercase tracking-wider">Tanggal Pembukaan</p>
                            <p class="text-[#1b4a47] font-extrabold text-[10px] md:text-xs mt-0.5 leading-tight">
                                {{ $event->event_date ? $event->event_date->translatedFormat('d F Y') : $event->created_at->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 border-l border-gray-200/50 pl-4">
                        <i class="fas fa-map-marker-alt text-base text-[#1b4a47] mt-0.5"></i>
                        <div>
                            <p class="text-[8px] text-gray-400 font-bold uppercase tracking-wider">Lokasi</p>
                            <p class="text-[#1b4a47] font-extrabold text-[10px] md:text-xs mt-0.5 leading-tight truncate">
                                {{ $event->location ?? 'Galeri Utama' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 border-l border-gray-200/50 pl-4">
                        <i class="far fa-clock text-base text-[#1b4a47] mt-0.5"></i>
                        <div>
                            <p class="text-[8px] text-gray-400 font-bold uppercase tracking-wider">Durasi</p>
                            <p class="text-[#1b4a47] font-extrabold text-[10px] md:text-xs mt-0.5 leading-tight">
                                {{ $event->duration ?? '3 Bulan' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Call to Actions -->
                <div class="flex flex-col gap-3 mb-8">
                    <a href="{{ route('events.plan', $event) }}" class="w-full bg-[#1b4a47] hover:bg-[#123937] text-white flex items-center justify-center gap-2 py-4 rounded-2xl text-xs font-black shadow-md hover:scale-[1.01] active:scale-[0.99] transition-all">
                        <span>Rencanakan Kunjungan Anda</span>
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                    
                    @php
                        $isSaved = auth()->check() && auth()->user()->savedEvents()->where('event_id', $event->id)->exists();
                    @endphp

                    <form action="{{ route('events.save', $event) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full bg-[#f6f4ef] hover:bg-[#eae8e2] text-gray-700 border border-[#EADFCB]/30 flex items-center justify-center gap-2 py-4 rounded-2xl text-xs font-black shadow-sm hover:scale-[1.01] active:scale-[0.99] transition-all">
                            @if($isSaved)
                                <i class="fas fa-bookmark text-xs text-[#b4853e]"></i>
                                <span>Tersimpan</span>
                            @else
                                <i class="far fa-bookmark text-xs text-[#b4853e]"></i>
                                <span>Simpan Acara</span>
                            @endif
                        </button>
                    </form>
                </div>

                <!-- Tentang Pameran -->
                <h2 class="font-serif text-xl font-bold text-museum-green mb-4">
                    {{ $event->category && str_contains(strtolower($event->category), 'pameran') ? 'Tentang Pameran' : 'Tentang Acara' }}
                </h2>

                <div class="text-sm md:text-base text-gray-700 leading-relaxed font-medium space-y-6">
                    {!! nl2br(e($event->description)) !!}
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
