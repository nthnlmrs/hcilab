@section('section_name', 'About')
<x-app-layout>
    <div class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-[#f6f4ef] pb-12">
        
        <!-- Hero Section -->
        <div class="relative h-[250px] md:h-[350px] w-full overflow-hidden shadow-md">
            <!-- Background Hero Photo -->
            <img src="{{ asset('images/about_hero.png') }}" class="absolute inset-0 w-full h-full object-cover object-center select-none" alt="Museum Singhasari Building">
            
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-tr from-black/85 via-black/40 to-transparent"></div>
            
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
                    <h1 class="font-serif text-3xl md:text-4xl font-extrabold mb-2 leading-tight">About Museum</h1>
                    <p class="text-xs md:text-sm text-white/80 leading-relaxed font-medium">Discover the history, mission, and values of Museum Singhasari.</p>
                </div>
            </div>
        </div>

        <!-- Content Card Section -->
        <div class="relative -mt-6 z-20 mx-auto max-w-4xl bg-white rounded-t-[30px] md:rounded-[32px] p-6 md:p-10 shadow-xl border-t border-x border-gray-100/50 md:border mb-12">
            
            <!-- Section 1: About Description -->
            <div class="border-b border-[#EADFCB]/30 pb-8 mb-8">
                <h2 class="font-serif text-2xl font-bold text-[#1B4A47] mb-4">About Museum Singhasari</h2>
                <div class="text-sm text-gray-600 leading-relaxed space-y-4">
                    <p>
                        Museum Singhasari is a cultural institution dedicated to preserving and showcasing the rich history of the Singhasari Kingdom and East Java’s heritage.
                    </p>
                    <p>
                        Through its collections, exhibitions, and educational programs, the museum aims to inspire, educate, and foster a deeper appreciation of our cultural roots.
                    </p>
                </div>
            </div>

            <!-- Section 2: Our Mission -->
            <div class="border-b border-[#EADFCB]/30 pb-8 mb-8">
                <h3 class="font-serif text-lg font-bold text-[#1B4A47] mb-6">Our Mission</h3>
                
                <div class="space-y-6">
                    <!-- Preserve Heritage -->
                    <div class="flex items-center gap-4 border-b border-[#EADFCB]/20 pb-4 last:border-b-0 last:pb-0">
                        <div class="w-14 h-14 bg-[#FAF6EE] rounded-2xl flex items-center justify-center text-[#1B4A47] flex-shrink-0 shadow-inner">
                            <i class="fas fa-landmark text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1B4A47] text-base mb-0.5">Preserve Heritage</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">To preserve and protect historical artifacts and cultural heritage.</p>
                        </div>
                    </div>

                    <!-- Educate & Inspire -->
                    <div class="flex items-center gap-4 border-b border-[#EADFCB]/20 pb-4 last:border-b-0 last:pb-0">
                        <div class="w-14 h-14 bg-[#FAF6EE] rounded-2xl flex items-center justify-center text-[#1B4A47] flex-shrink-0 shadow-inner">
                            <i class="fas fa-book-open text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1B4A47] text-base mb-0.5">Educate & Inspire</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">To educate and inspire the community through knowledge and experience.</p>
                        </div>
                    </div>

                    <!-- Engage Community -->
                    <div class="flex items-center gap-4 border-b border-[#EADFCB]/20 pb-4 last:border-b-0 last:pb-0">
                        <div class="w-14 h-14 bg-[#FAF6EE] rounded-2xl flex items-center justify-center text-[#1B4A47] flex-shrink-0 shadow-inner">
                            <i class="fas fa-people-group text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1B4A47] text-base mb-0.5">Engage Community</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">To engage the community in appreciating and sustaining our cultural legacy.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: What You Can Explore -->
            <div class="border-b border-[#EADFCB]/30 pb-8 mb-8">
                <h3 class="font-serif text-lg font-bold text-[#1B4A47] mb-6">What You Can Explore</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Collections -->
                    <div class="bg-[#FAF6EE] border border-[#EADFCB]/20 rounded-2xl p-5 flex flex-col items-center text-center shadow-soft hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 rounded-full bg-[#1B4A47]/10 flex items-center justify-center text-[#1B4A47] mb-4">
                            <i class="fas fa-map-location-dot text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-sm text-[#1B4A47] mb-2">Collections</h4>
                        <p class="text-[11px] text-gray-500 leading-relaxed font-medium">Historical artifacts from the Singhasari Kingdom era.</p>
                    </div>

                    <!-- Exhibitions -->
                    <div class="bg-[#FAF6EE] border border-[#EADFCB]/20 rounded-2xl p-5 flex flex-col items-center text-center shadow-soft hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 rounded-full bg-[#1B4A47]/10 flex items-center justify-center text-[#1B4A47] mb-4">
                            <i class="fas fa-images text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-sm text-[#1B4A47] mb-2">Exhibitions</h4>
                        <p class="text-[11px] text-gray-500 leading-relaxed font-medium">Permanent and temporary exhibitions for all ages.</p>
                    </div>

                    <!-- Education -->
                    <div class="bg-[#FAF6EE] border border-[#EADFCB]/20 rounded-2xl p-5 flex flex-col items-center text-center shadow-soft hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 rounded-full bg-[#1B4A47]/10 flex items-center justify-center text-[#1B4A47] mb-4">
                            <i class="fas fa-graduation-cap text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-sm text-[#1B4A47] mb-2">Education</h4>
                        <p class="text-[11px] text-gray-500 leading-relaxed font-medium">Learning programs and activities about history and culture.</p>
                    </div>
                </div>
            </div>

            <!-- Section 4: Quote Box -->
            <div class="bg-[#FAF6EE]/75 border-l-4 border-[#1B4A47] rounded-r-2xl p-5 relative overflow-hidden flex items-center justify-between shadow-soft">
                <div class="flex items-start gap-4">
                    <!-- Left Quote Mark -->
                    <div class="text-[#1B4A47] opacity-25 mt-1 flex-shrink-0">
                        <i class="fas fa-quote-left text-2xl"></i>
                    </div>
                    <div>
                        <p class="font-serif italic font-bold text-sm md:text-base text-[#1B4A47] mb-1 leading-relaxed">
                            Preserving the past, inspiring the future.
                        </p>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            Museum Singhasari
                        </p>
                    </div>
                </div>
                <!-- Right Quote Mark decoration -->
                <div class="text-[#1B4A47] opacity-5 absolute right-4 bottom-2 scale-150">
                    <i class="fas fa-quote-right text-6xl"></i>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
