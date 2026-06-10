@section('section_name', 'Stories')
<x-app-layout>
    <div class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-white">
        
        <!-- Hero Section (Full Width, Sticky) -->
        <div class="sticky top-0 h-[220px] md:h-[280px] w-full overflow-hidden z-0 shadow-sm">
            <!-- Background Hero Photo -->
            <img src="https://images.unsplash.com/photo-1518998053401-87891316b25f?w=1200&h=600&fit=crop" class="absolute inset-0 w-full h-full object-cover object-center select-none" alt="Museum Stories">
            
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-tr from-black/85 via-black/45 to-transparent"></div>
            
            <!-- Hero Content -->
            <div class="absolute inset-0 z-10 flex flex-col justify-between p-6 md:p-8">
                <!-- Back Button -->
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-12 h-12 bg-white/95 text-[#1B4A47] hover:bg-[#FAF6EE] rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all select-none">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                </div>
                
                <!-- Hero Titles -->
                <div class="text-white max-w-lg">
                    <h1 class="font-serif text-3xl font-extrabold mb-1 leading-tight">Tales from Singhasari</h1>
                    <p class="text-xs md:text-sm text-white/80 leading-relaxed font-medium">Explore stories and legends that are part of our cultural heritage.</p>
                </div>
            </div>
        </div>

        <!-- Content Section (Full-width white background) -->
        <div class="relative -mt-6 z-20 bg-white rounded-t-[30px] pb-24">
            <div class="max-w-xl mx-auto px-6 py-8">
                
                <!-- Section Header -->
                <div class="border-b border-[#EADFCB]/30 pb-4 mb-6">
                    <h2 class="font-serif text-2xl font-bold text-[#1B4A47] mb-1">Our Stories</h2>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">Discover fascinating stories and legends passed down through generations. Each tale holds wisdom, values, and lessons from the past.</p>
                </div>

                <!-- Story tales List -->
                <div class="space-y-6">
                    @forelse($stories as $story)
                        <div class="bg-[#FAF6EE]/50 border border-[#EADFCB]/30 rounded-2xl overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
                            <!-- Image Cover -->
                            <div class="h-44 md:h-52 w-full overflow-hidden bg-gray-100 relative">
                                @if($story->image)
                                    <img src="{{ $story->image_url }}" class="w-full h-full object-cover" alt="{{ $story->title }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="fas fa-book-open text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Card Body -->
                            <div class="p-5 flex flex-col gap-4">
                                <div class="relative">
                                    <!-- Category Badge -->
                                    <span class="inline-block bg-[#b4853e] text-[#FAF6EE] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-3 shadow-sm">
                                        {{ $story->category }}
                                    </span>
                                    <h3 class="font-serif text-xl font-bold text-[#1b4a47] leading-tight mb-2">{{ $story->title }}</h3>
                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">{{ $story->excerpt }}</p>
                                </div>
                                
                                <!-- Read More button -->
                                <a href="{{ route('stories.show', $story) }}" class="bg-[#1b4a47] hover:bg-[#123937] text-white flex items-center justify-center gap-2 py-3.5 rounded-xl text-xs font-bold shadow-md hover:scale-[1.01] active:scale-[0.99] transition-all">
                                    <span>Read More</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-[#FAF6EE] border border-[#EADFCB]/20 rounded-2xl p-8 text-center">
                            <p class="text-gray-400 text-sm font-medium">Belum ada cerita yang ditambahkan oleh admin.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Info Notice Card at Bottom -->
                <div class="mt-8 bg-[#EEEFEA] border border-[#EADFCB]/20 rounded-2xl p-4 flex gap-4 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-[#1b4a47] text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                        <i class="fas fa-info"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-[#1b4a47] mb-0.5">Note</h4>
                        <p class="text-[10px] text-[#1b4a47]/80 leading-normal font-medium">These stories are part of our cultural heritage and continue to inspire values across generations.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
