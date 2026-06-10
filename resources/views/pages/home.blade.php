@section('section_name', 'Home')
<x-app-layout>
    <div class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-[#d5c6b1]/40 overflow-hidden">
        
        <!-- Decorative Ellipse Blobs in Header Background -->
        <div class="absolute w-64 h-64 rounded-full bg-[#1B4A47]/10 -top-10 -left-10 blur-2xl pointer-events-none"></div>
        <div class="absolute w-80 h-80 rounded-full bg-[#B4853E]/10 top-20 right-10 blur-3xl pointer-events-none"></div>

        <!-- Header Section (Top part of Home) -->
        <div class="px-6 md:px-10 pt-8 pb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 max-w-7xl mx-auto relative z-10">
            <!-- Left Info -->
            <div>
                <p class="font-['Poppins'] font-medium text-lg text-gray-700 leading-tight">Selamat Datang ke</p>
                <h1 class="font-['Poppins'] font-bold text-2xl md:text-3xl text-[#1b4a47] leading-tight mt-1">Museum Singhasari</h1>
            </div>

            <!-- Right Controls: Notification and Avatar -->
            <div class="flex items-center gap-3 self-end md:self-center">
                @auth
                    <!-- Profile Avatar -->
                    <a href="{{ route('profile.edit') }}" class="w-11 h-11 rounded-full border-2 border-white overflow-hidden shadow-md hover:scale-105 active:scale-95 transition-all block">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1B4A47&color=fff&size=96" alt="Profile" class="w-full h-full object-cover">
                    </a>
                @else
                    <!-- Masuk Button -->
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-[#1b4a47] hover:bg-[#123937] text-white font-bold text-sm shadow-md hover:scale-105 active:scale-95 transition-all">
                        <i class="fas fa-sign-in-alt text-xs"></i>
                        <span>Masuk</span>
                    </a>
                @endauth
            </div>
        </div>

        <!-- Search Bar Section -->
        <div class="px-6 md:px-10 pb-8 max-w-7xl mx-auto relative z-10">
            <div class="relative w-full max-w-md">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-[#1b4a47]/60"></i>
                </span>
                <input type="text" placeholder="Cari..." class="w-full bg-white pl-11 pr-4 py-3 border-0 rounded-2xl shadow-sm placeholder-[#1b4a47]/50 text-[#1b4a47] font-medium focus:ring-1 focus:ring-[#1b4a47] focus:outline-none transition-all">
            </div>
        </div>

        <!-- White Portal Section (Overlapping card) -->
        <div class="relative z-10 bg-white rounded-t-[30px] pt-8 pb-32">
            <div class="max-w-4xl mx-auto px-6">
                
                <!-- Section: Kunjungi Museum -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="font-['Poppins'] font-semibold text-[#1b4a47] text-xl leading-tight">Kunjungi Museum</h2>
                            <p class="font-['Poppins'] font-normal text-sm text-gray-500 mt-0.5">Lihat Tentang, Koleksi, Cerita Rakyat</p>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="scrollLeftContainer('kunjungi-container')" class="w-8 h-8 rounded-full border border-[#1b4a47]/20 flex items-center justify-center text-[#1b4a47] hover:bg-[#1b4a47]/5 active:scale-90 transition-all focus:outline-none">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </button>
                            <button onclick="scrollRightContainer('kunjungi-container')" class="w-8 h-8 rounded-full border border-[#1b4a47]/20 flex items-center justify-center text-[#1b4a47] hover:bg-[#1b4a47]/5 active:scale-90 transition-all focus:outline-none">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Horizontal Scroll Row -->
                    <div id="kunjungi-container" class="flex gap-5 overflow-x-auto pb-4 scrollbar-none snap-x snap-mandatory cursor-grab active:cursor-grabbing select-none scroll-smooth">
                        
                        <!-- Card 1: Museum (About Page) -->
                        <a href="{{ route('about') }}" class="snap-start flex-shrink-0 w-64 h-80 rounded-2xl relative overflow-hidden shadow-md group hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer">
                            @php
                                $customMuseumCover = \App\Models\Setting::get('dashboard_museum_image');
                                $museumSrc = $customMuseumCover ? asset('storage/' . $customMuseumCover) : (isset($aboutPage) ? $aboutPage->cover_image_url : asset('images/about_hero.png'));
                            @endphp
                            <img src="{{ $museumSrc }}" class="absolute inset-0 w-full h-full object-cover" alt="Museum">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent z-10"></div>
                            <div class="absolute inset-0 z-20 flex flex-col justify-end p-5 text-white">
                                <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1">{{ isset($aboutPage) ? $aboutPage->title : 'Museum' }}</h3>
                                <p class="font-['Poppins'] font-normal text-xs text-white/80">{{ isset($aboutPage) ? $aboutPage->description : 'Sejarah Museum & Informasi' }}</p>
                            </div>
                        </a>

                        <!-- Card 2: Koleksi (Statue Collections) -->
                        <a href="{{ route('collection.index') }}" class="snap-start flex-shrink-0 w-64 h-80 rounded-2xl relative overflow-hidden shadow-md group hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer">
                            @php
                                $customCollectionsCover = \App\Models\Setting::get('dashboard_collections_image');
                                $collectionsSrc = $customCollectionsCover ? asset('storage/' . $customCollectionsCover) : (isset($koleksi) ? $koleksi->image_url : asset('images/koleksi_card.png'));
                            @endphp
                            <img src="{{ $collectionsSrc }}" class="absolute inset-0 w-full h-full object-cover" alt="Koleksi">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent z-10"></div>
                            <div class="absolute inset-0 z-20 flex flex-col justify-end p-5 text-white">
                                <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1">Koleksi</h3>
                                <p class="font-['Poppins'] font-normal text-xs text-white/80">Patung dan artefak kuno</p>
                            </div>
                        </a>

                        <!-- Card 3: Cerita Rakyat (Folklore Stories) -->
                        <a href="{{ route('stories.index') }}" class="snap-start flex-shrink-0 w-64 h-80 rounded-2xl relative overflow-hidden shadow-md group hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer">
                            @php
                                $customStoriesCover = \App\Models\Setting::get('dashboard_stories_image');
                                $storiesSrc = $customStoriesCover ? asset('storage/' . $customStoriesCover) : (isset($cerita) ? $cerita->image_url : asset('images/cerita_card.png'));
                            @endphp
                            <img src="{{ $storiesSrc }}" class="absolute inset-0 w-full h-full object-cover" alt="Cerita Rakyat">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent z-10"></div>
                            <div class="absolute inset-0 z-20 flex flex-col justify-end p-5 text-white">
                                <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1">Cerita Rakyat</h3>
                                <p class="font-['Poppins'] font-normal text-xs text-white/80">Legenda Kerajaan</p>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- Section: Berita Terbaru (Latest Event) -->
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="font-['Poppins'] font-semibold text-[#1b4a47] text-xl leading-tight">Berita Terbaru</h2>
                            <p class="font-['Poppins'] font-normal text-sm text-gray-500 mt-0.5">Pembaruan, pameran, dan pengumuman</p>
                        </div>
                        @if($events->count() > 1)
                        <div class="flex gap-2">
                            <button onclick="scrollLeftContainer('events-container')" class="w-8 h-8 rounded-full border border-[#1b4a47]/20 flex items-center justify-center text-[#1b4a47] hover:bg-[#1b4a47]/5 active:scale-90 transition-all focus:outline-none">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </button>
                            <button onclick="scrollRightContainer('events-container')" class="w-8 h-8 rounded-full border border-[#1b4a47]/20 flex items-center justify-center text-[#1b4a47] hover:bg-[#1b4a47]/5 active:scale-90 transition-all focus:outline-none">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                        @endif
                    </div>

                    <!-- Horizontal Scroll Row for Events -->
                    <div id="events-container" class="flex gap-5 overflow-x-auto pb-4 scrollbar-none snap-x snap-mandatory cursor-grab active:cursor-grabbing select-none scroll-smooth">
                        @forelse($events as $event)
                            <!-- Event High-Fidelity Card -->
                            <div class="snap-start flex-shrink-0 w-80 rounded-2xl relative overflow-hidden bg-[#f6f4ef] border border-[#EADFCB]/30 flex flex-col justify-between hover:shadow-md transition-shadow">
                                <div>
                                    <!-- Event Cover image -->
                                    <div class="h-44 w-full overflow-hidden bg-gray-100 relative">
                                        @if($event->image)
                                            <img src="{{ $event->image_url }}" class="w-full h-full object-cover pointer-events-none" alt="{{ $event->title }}">
                                        @else
                                            <div class="w-full h-full bg-museum-green/20 flex items-center justify-center text-[#1b4a47]/30">
                                                <i class="fas fa-calendar-alt text-4xl"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content details -->
                                    <div class="p-5 flex flex-col gap-3">
                                        <div>
                                            <!-- Badge -->
                                            <span class="inline-block bg-[#b4853e] text-[#FAF6EE] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-2 shadow-sm select-none">
                                                {{ $event->category ?? 'Pameran Terbaru' }}
                                            </span>
                                            <h3 class="font-['Poppins'] font-bold text-black text-sm leading-snug mb-1 line-clamp-2" title="{{ $event->title }}">{{ $event->title }}</h3>
                                            <p class="font-['Poppins'] font-normal text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $event->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-5 pb-5 pt-0 flex flex-col gap-3">
                                    <!-- Date & Location row -->
                                    <div class="grid grid-cols-2 gap-4 border-t border-gray-200/50 pt-3 text-[10px] font-semibold text-gray-500">
                                        <div class="flex items-center gap-2">
                                            <i class="far fa-calendar-alt text-base text-[#1b4a47]"></i>
                                            <div>
                                                <p class="text-[8px] text-gray-400 font-normal uppercase tracking-wider">Tanggal Pembukaan</p>
                                                <p class="text-[#1b4a47] font-bold">{{ $event->event_date ? $event->event_date->translatedFormat('d F Y') : $event->created_at->translatedFormat('d F Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 border-l border-gray-200/50 pl-3">
                                            <i class="fas fa-map-marker-alt text-base text-[#1b4a47]"></i>
                                            <div>
                                                <p class="text-[8px] text-gray-400 font-normal uppercase tracking-wider">Lokasi</p>
                                                <p class="text-[#1b4a47] font-bold truncate">{{ $event->location ?? 'Galeri Utama' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Read More button -->
                                    <a href="{{ route('events.show', $event) }}" class="bg-[#1b4a47] hover:bg-[#123937] text-white flex items-center justify-center gap-2 py-3 rounded-xl text-xs font-bold shadow-md hover:scale-[1.01] active:scale-[0.99] transition-all">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <!-- Fallback Event card if no events in database -->
                            <div class="snap-start flex-shrink-0 w-80 rounded-2xl relative overflow-hidden bg-[#f6f4ef] border border-[#EADFCB]/30 flex flex-col justify-between hover:shadow-md transition-shadow">
                                <div>
                                    <div class="h-44 w-full overflow-hidden bg-gray-100 relative">
                                        <img src="https://images.unsplash.com/photo-1596484552834-6a58f850d0a1?w=800&h=400&fit=crop" class="w-full h-full object-cover pointer-events-none" alt="Heritage">
                                    </div>
                                    <div class="p-5 flex flex-col gap-3">
                                        <div>
                                            <span class="inline-block bg-[#b4853e] text-[#FAF6EE] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-2 shadow-sm select-none">
                                                Pameran Terbaru
                                            </span>
                                            <h3 class="font-['Poppins'] font-bold text-black text-sm leading-snug mb-1">Temukan Warisan Singhasari</h3>
                                            <p class="font-['Poppins'] font-normal text-xs text-gray-500 leading-relaxed line-clamp-2">Jelajahi artefak dan kisah baru yang mengungkap kejayaan Kerajaan Singhasari.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-5 pb-5 pt-0 flex flex-col gap-3">
                                    <div class="grid grid-cols-2 gap-4 border-t border-gray-200/50 pt-3 text-[10px] font-semibold text-gray-500">
                                        <div class="flex items-center gap-2">
                                            <i class="far fa-calendar-alt text-base text-[#1b4a47]"></i>
                                            <div>
                                                <p class="text-[8px] text-gray-400 font-normal uppercase tracking-wider">Tanggal Pembukaan</p>
                                                <p class="text-[#1b4a47] font-bold">20 Mei 2026</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 border-l border-gray-200/50 pl-3">
                                            <i class="fas fa-map-marker-alt text-base text-[#1b4a47]"></i>
                                            <div>
                                                <p class="text-[8px] text-gray-400 font-normal uppercase tracking-wider">Lokasi</p>
                                                <p class="text-[#1b4a47] font-bold">Galeri Utama</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button onclick="alert('Kisah selengkapnya sedang dipersiapkan oleh tim kurator.')" class="bg-[#1b4a47] hover:bg-[#123937] text-white flex items-center justify-center gap-2 py-3 rounded-xl text-xs font-bold shadow-md hover:scale-[1.01] active:scale-[0.99] transition-all">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section: Kegiatan (Full-width dark green panel) -->
                <div class="bg-[#1b4a47] rounded-3xl p-6 text-white my-8 relative overflow-hidden shadow-lg">
                    <!-- Diagonal Background panels matching Figma design -->
                    <div class="absolute h-[600px] w-[183px] rotate-[147.05deg] right-[-50px] -top-10 opacity-10 pointer-events-none" style="background-image: linear-gradient(180deg, #1B4A47 16%, #0F2F2E 100%)"></div>
                    <div class="absolute h-[670px] w-[166px] rotate-[-32.95deg] -left-10 -bottom-10 opacity-15 pointer-events-none" style="background-image: linear-gradient(180deg, #1B4A47 16%, #123937 100%)"></div>

                    <!-- Header Titles -->
                    <div class="relative z-10 mb-6">
                        <h2 class="font-['Poppins'] font-bold text-xl leading-tight text-white">Kegiatan</h2>
                        <p class="font-['Poppins'] font-normal text-sm text-[#d5c6b1] mt-0.5">Lokakarya, kegiatan, dan suvenir</p>
                    </div>

                    <!-- Activities Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                        @if(isset($activities) && $activities->count() > 0)
                            @foreach($activities as $index => $activity)
                                <div class="bg-[#FAF6EE]/10 border border-white/10 rounded-2xl overflow-hidden flex flex-col justify-between h-[280px] p-5 relative">
                                    <!-- Image overlay back -->
                                    <img src="{{ $activity->image_url }}" class="absolute inset-0 w-full h-full object-cover object-bottom select-none z-0 opacity-20 pointer-events-none">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#0F2F2E] via-[#0F2F2E]/40 to-transparent z-0"></div>

                                    <!-- Header -->
                                    <div class="relative z-10 self-start">
                                        <span class="bg-white text-[#1b4a47] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm">
                                            Kegiatan
                                        </span>
                                    </div>

                                    <!-- Content -->
                                    <div class="relative z-10 mt-auto">
                                        <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1 text-white">{{ $activity->title }}</h3>
                                        <p class="font-['Poppins'] font-normal text-[11px] text-[#d5c6b1] leading-relaxed mb-4">{{ Str::limit($activity->description, 60) }}</p>
                                        <button onclick="alert('Pendaftaran {{ addslashes($activity->title) }} berhasil dibuka! Hubungi admin untuk detail jadwal.')" class="w-full bg-[#b4853e] hover:bg-[#a37735] text-white py-2.5 rounded-xl text-xs font-bold shadow-md active:scale-95 transition-all">
                                            Ikuti Acara!
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback if no activities -->
                            <div class="bg-[#FAF6EE]/10 border border-white/10 rounded-2xl overflow-hidden flex flex-col justify-between h-[280px] p-5 relative col-span-2 text-center items-center justify-center">
                                <p class="text-white">Belum ada kegiatan tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

    <style>
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Prevents user selection during drag */
        .overflow-x-auto.cursor-grabbing {
            user-select: none;
        }
    </style>

    <script>
        // Smooth scrolling for navigation buttons
        function scrollLeftContainer(id) {
            const container = document.getElementById(id);
            if (container) {
                container.scrollBy({ left: -320, behavior: 'smooth' });
            }
        }

        function scrollRightContainer(id) {
            const container = document.getElementById(id);
            if (container) {
                container.scrollBy({ left: 320, behavior: 'smooth' });
            }
        }

        // Drag to scroll functionality for desktop mouse users
        document.addEventListener('DOMContentLoaded', function() {
            const sliders = document.querySelectorAll('.overflow-x-auto');
            
            sliders.forEach(slider => {
                let isDown = false;
                let startX;
                let startY;
                let scrollLeft;
                let hasMoved = false;
                const dragThreshold = 10; // min pixels offset to prevent clicks

                slider.classList.add('cursor-grab');

                slider.addEventListener('mousedown', (e) => {
                    if (e.button !== 0) return; // only left click
                    isDown = true;
                    hasMoved = false;
                    startX = e.pageX - slider.offsetLeft;
                    startY = e.pageY - slider.offsetTop;
                    scrollLeft = slider.scrollLeft;
                    slider.classList.add('cursor-grabbing');
                    slider.classList.remove('cursor-grab');
                });

                slider.addEventListener('mouseleave', () => {
                    if (isDown) {
                        isDown = false;
                        slider.classList.remove('cursor-grabbing');
                        slider.classList.add('cursor-grab');
                    }
                });

                slider.addEventListener('mouseup', () => {
                    if (isDown) {
                        isDown = false;
                        slider.classList.remove('cursor-grabbing');
                        slider.classList.add('cursor-grab');
                    }
                });

                // Capture click events and block them if we actually dragged the content
                slider.addEventListener('click', (e) => {
                    if (hasMoved) {
                        e.preventDefault();
                        e.stopPropagation();
                        hasMoved = false;
                    }
                }, true); // true sets capture phase to block nested clicks

                slider.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    
                    const x = e.pageX - slider.offsetLeft;
                    const y = e.pageY - slider.offsetTop;
                    const distanceX = Math.abs(x - startX);
                    const distanceY = Math.abs(y - startY);

                    // If dragged beyond threshold, mark it as moved
                    if (distanceX > dragThreshold || distanceY > dragThreshold) {
                        hasMoved = true;
                    }

                    if (hasMoved) {
                        e.preventDefault();
                        const walk = (x - startX) * 1.5;
                        slider.scrollLeft = scrollLeft - walk;
                    }
                });
            });
        });
    </script>
</x-app-layout>
