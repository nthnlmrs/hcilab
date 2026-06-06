@section('section_name', 'Collections')
<x-app-layout>
    <div class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-white">
        
        <!-- Hero Section (Full Width, Sticky) -->
        <div class="sticky top-0 h-[220px] md:h-[280px] w-full overflow-hidden z-0 shadow-sm">
            <!-- Background Hero Photo -->
            <img src="https://images.unsplash.com/photo-1596484552834-6a58f850d0a1?w=1200&h=600&fit=crop" class="absolute inset-0 w-full h-full object-cover object-center select-none" alt="Museum Collections">
            
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
                    <h1 class="font-serif text-3xl font-extrabold mb-1 leading-tight">Museum Collections</h1>
                    <p class="text-xs md:text-sm text-white/80 leading-relaxed font-medium">Discover the beauty and meaning behind the statues from the Singhasari era.</p>
                </div>
            </div>
        </div>

        <!-- Content Section (Full-width white background) -->
        <div class="relative -mt-6 z-20 bg-white rounded-t-[30px] pb-24">
            <div class="max-w-xl mx-auto px-6 py-8">
                
                <!-- Section Header -->
                <div class="border-b border-[#EADFCB]/30 pb-4 mb-6">
                    <h2 class="font-serif text-2xl font-bold text-[#b4853e] mb-1">Collections Highlight</h2>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">Here are some of our most treasured collections. Explore more in the Gallery.</p>
                </div>

                <!-- Statue Collection Cards -->
                <div class="space-y-4">
                    @forelse($collections as $item)
                        <div class="bg-white border border-[#EADFCB]/30 rounded-2xl p-3 flex gap-4 shadow-sm hover:shadow-md transition-shadow">
                            <!-- Image wrapper -->
                            <div class="w-32 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-[#FAF6EE] border border-gray-100 flex items-center justify-center">
                                @if($item->image)
                                    <img src="{{ $item->image }}" class="w-full h-full object-cover" alt="{{ $item->title }}">
                                @else
                                    <i class="fas fa-shapes text-3xl text-gray-300"></i>
                                @endif
                            </div>
                            <!-- Text description wrapper -->
                            <div class="flex flex-col justify-center">
                                <h3 class="font-bold text-[#b4853e] text-base leading-tight mb-1">{{ $item->title }}</h3>
                                <p class="text-[11px] text-gray-500 leading-relaxed font-medium">{{ $item->description }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="bg-[#FAF6EE] border border-[#EADFCB]/20 rounded-2xl p-8 text-center">
                            <p class="text-gray-400 text-sm font-medium">Belum ada koleksi yang ditambahkan oleh admin.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Explore All Footer Card -->
                <div class="mt-8 bg-white border border-[#EADFCB]/30 rounded-2xl p-4 flex items-center justify-between shadow-sm">
                    <div class="max-w-[75%]">
                        <h4 class="font-bold text-sm text-[#b4853e] mb-1">Explore All Collections</h4>
                        <p class="text-[10px] text-gray-500 leading-normal font-medium">Discover the complete range of sculptures, reliefs, dioramas, and more in our Gallery.</p>
                    </div>
                    <div>
                        <a href="{{ route('gallery') }}" class="w-10 h-10 rounded-full bg-[#FAF6EE] text-[#b4853e] flex items-center justify-center hover:scale-105 active:scale-95 transition-all shadow-sm">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
