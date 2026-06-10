@section('section_name', 'Read Story')
<x-app-layout>
    <div class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-[#FAF6EE]">
        
        <!-- Hero Cover Area -->
        <div class="sticky top-0 h-[260px] md:h-[360px] w-full overflow-hidden z-0 shadow-sm">
            @if($story->image)
                <img src="{{ $story->image_url }}" class="absolute inset-0 w-full h-full object-cover object-center select-none" alt="{{ $story->title }}">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-[#1b4a47] to-[#0f2f2e]"></div>
            @endif
            
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
            
            <!-- Back Button and Title -->
            <div class="absolute inset-0 z-10 flex flex-col justify-between p-6 md:p-8">
                <div>
                    <a href="{{ route('stories.index') }}" class="inline-flex items-center justify-center w-12 h-12 bg-white/95 text-[#1B4A47] hover:bg-[#FAF6EE] rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all select-none">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                </div>
                
                <div class="text-white max-w-2xl">
                    <span class="inline-block bg-[#b4853e] text-[#FAF6EE] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-2.5 shadow-sm">
                        {{ $story->category }}
                    </span>
                    <h1 class="font-serif text-3xl md:text-4xl font-extrabold mb-1 leading-tight">{{ $story->title }}</h1>
                </div>
            </div>
        </div>

        <!-- Read Content Area (Pops over the cover image) -->
        <div class="relative -mt-6 z-20 bg-white rounded-t-[30px] shadow-2xl border-t border-[#EADFCB]/10 pb-32">
            <div class="max-w-2xl mx-auto px-6 py-10">
                
                @if($story->excerpt)
                <!-- Excerpt Box -->
                <div class="border-l-4 border-[#b4853e] bg-[#FAF6EE] rounded-r-2xl p-5 mb-8 shadow-inner">
                    <p class="font-serif italic font-semibold text-[#1b4a47] text-sm md:text-base leading-relaxed">
                        "{{ $story->excerpt }}"
                    </p>
                </div>
                @endif

                <!-- Story Paragraphs / Legenda -->
                @if($story->content)
                <div class="mb-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#b4853e]/20 text-[#b4853e] flex items-center justify-center">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h2 class="font-serif text-lg font-bold text-[#b4853e]">Legenda</h2>
                    </div>
                    <div class="p-5 text-sm text-gray-600 leading-relaxed">
                        {!! nl2br(e($story->content)) !!}
                    </div>
                </div>
                @endif

                <!-- Characters -->
                @if($story->characters && count($story->characters) > 0)
                <div class="mb-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#b4853e]/20 text-[#b4853e] flex items-center justify-center">
                            <i class="fas fa-monument"></i>
                        </div>
                        <h2 class="font-serif text-lg font-bold text-[#b4853e]">Karakter</h2>
                    </div>
                    <div class="p-5 flex flex-col gap-4">
                        @foreach($story->characters as $char)
                        <div class="flex items-center gap-4 bg-gray-50 rounded-xl p-3 border border-gray-100">
                            <img src="{{ $char['image'] ?? '' }}" alt="{{ $char['name'] ?? '' }}" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                            <h3 class="font-serif font-bold text-[#b4853e] text-lg">{{ $char['name'] ?? '' }}</h3>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Themes / Koleksi, Pameran, Edukasi -->
                @if($story->themes && count($story->themes) > 0)
                <div class="mb-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#b4853e]/20 text-[#b4853e] flex items-center justify-center">
                            <i class="fas fa-fan"></i>
                        </div>
                        <h2 class="font-serif text-lg font-bold text-[#b4853e]">Tema</h2>
                    </div>
                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($story->themes as $theme)
                        <div class="flex flex-col gap-2 p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <i class="{{ $theme['icon'] ?? 'fas fa-info-circle' }} text-[#b4853e] text-xl mb-1"></i>
                            <h3 class="font-bold text-gray-800 text-sm">{{ $theme['title'] ?? '' }}</h3>
                            <p class="text-xs text-gray-500 leading-tight">{{ $theme['description'] ?? '' }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Historical Significance -->
                @if($story->historical_significance)
                <div class="mb-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#b4853e]/20 text-[#b4853e] flex items-center justify-center">
                            <i class="fas fa-chess-rook"></i>
                        </div>
                        <h2 class="font-serif text-lg font-bold text-[#b4853e]">Signifikasi Sejarah</h2>
                    </div>
                    <div class="p-5 text-sm text-gray-600 leading-relaxed">
                        {{ $story->historical_significance }}
                    </div>
                </div>
                @endif

                <!-- Did You Know -->
                @if($story->did_you_know)
                <div class="mb-8 bg-[#f2f7f7] rounded-2xl border border-[#1b4a47]/10 p-5 flex gap-4 items-start shadow-sm">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-[#1b4a47] text-white flex items-center justify-center mt-0.5">
                        <i class="fas fa-info text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#1b4a47] text-sm mb-1">Apakah Kamu Tau?</h3>
                        <p class="text-xs text-[#1b4a47]/80 leading-relaxed">{{ $story->did_you_know }}</p>
                    </div>
                </div>
                @endif

                <!-- Footer Flourish -->
                <div class="mt-12 pt-8 border-t border-[#EADFCB]/30 flex items-center justify-between text-gray-400">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-feather-alt text-[#b4853e]"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#1b4a47]/50 select-none">Hikayat Singhasari</span>
                    </div>
                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="text-xs font-bold hover:text-[#1b4a47] transition-colors flex items-center gap-1.5">
                        <span>Back to top</span>
                        <i class="fas fa-chevron-up"></i>
                    </button>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
