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
                
                <!-- Excerpt Box -->
                <div class="border-l-4 border-[#b4853e] bg-[#FAF6EE] rounded-r-2xl p-5 mb-8 shadow-inner">
                    <p class="font-serif italic font-semibold text-[#1b4a47] text-sm md:text-base leading-relaxed">
                        "{{ $story->excerpt }}"
                    </p>
                </div>

                <!-- Story Paragraphs -->
                <div class="text-sm md:text-base text-gray-700 leading-relaxed font-medium space-y-6">
                    {!! nl2br(e($story->content)) !!}
                </div>

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
