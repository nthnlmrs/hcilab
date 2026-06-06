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
                <!-- Notification Bell -->
                <button onclick="alert('Belum ada notifikasi baru.')" class="w-11 h-11 rounded-full bg-white flex items-center justify-center text-[#1b4a47] shadow-sm hover:scale-105 active:scale-95 transition-all">
                    <i class="far fa-bell text-lg"></i>
                </button>
                <!-- Profile Avatar -->
                <a href="{{ route('profile.edit') }}" class="w-11 h-11 rounded-full border-2 border-white overflow-hidden shadow-md hover:scale-105 active:scale-95 transition-all block">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=1B4A47&color=fff&size=96" alt="Profile" class="w-full h-full object-cover">
                </a>
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
                    <div class="mb-4">
                        <h2 class="font-['Poppins'] font-semibold text-[#1b4a47] text-xl leading-tight">Kunjungi Museum</h2>
                        <p class="font-['Poppins'] font-normal text-sm text-gray-500 mt-0.5">Lihat Tentang, Koleksi, Cerita Rakyat</p>
                    </div>

                    <!-- Horizontal Scroll Row -->
                    <div class="flex gap-5 overflow-x-auto pb-4 scrollbar-none snap-x snap-mandatory">
                        
                        <!-- Card 1: Museum (About Page) -->
                        <a href="{{ route('about') }}" class="snap-start flex-shrink-0 w-64 h-80 rounded-2xl relative overflow-hidden shadow-md group hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer">
                            <img src="{{ asset('images/about_hero.png') }}" class="absolute inset-0 w-full h-full object-cover" alt="Museum">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent z-10"></div>
                            <div class="absolute inset-0 z-20 flex flex-col justify-end p-5 text-white">
                                <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1">Museum</h3>
                                <p class="font-['Poppins'] font-normal text-xs text-white/80">Sejarah Museum & Informasi</p>
                            </div>
                        </a>

                        <!-- Card 2: Koleksi (Statue Collections) -->
                        <a href="{{ route('collection.index') }}" class="snap-start flex-shrink-0 w-64 h-80 rounded-2xl relative overflow-hidden shadow-md group hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1596484552834-6a58f850d0a1?w=600&h=400&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Koleksi">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent z-10"></div>
                            <div class="absolute inset-0 z-20 flex flex-col justify-end p-5 text-white">
                                <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1">Koleksi</h3>
                                <p class="font-['Poppins'] font-normal text-xs text-white/80">Patung dan artefak kuno</p>
                            </div>
                        </a>

                        <!-- Card 3: Cerita Rakyat (Folklore Stories) -->
                        <a href="{{ route('stories.index') }}" class="snap-start flex-shrink-0 w-64 h-80 rounded-2xl relative overflow-hidden shadow-md group hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1518998053401-87891316b25f?w=600&h=400&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Cerita Rakyat">
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
                    <div class="mb-4">
                        <h2 class="font-['Poppins'] font-semibold text-[#1b4a47] text-xl leading-tight">Berita Terbaru</h2>
                        <p class="font-['Poppins'] font-normal text-sm text-gray-500 mt-0.5">Pembaruan, pameran, dan pengumuman</p>
                    </div>

                    @php
                        $latestEvent = \App\Models\Event::latest()->first();
                    @endphp

                    @if($latestEvent)
                        <!-- Event High-Fidelity Card -->
                        <div class="bg-[#f6f4ef] border border-[#EADFCB]/30 rounded-2xl overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
                            <!-- Event Cover image -->
                            <div class="h-48 md:h-56 w-full overflow-hidden bg-gray-100 relative">
                                @if($latestEvent->image)
                                    <img src="{{ asset('storage/' . $latestEvent->image) }}" class="w-full h-full object-cover" alt="{{ $latestEvent->title }}">
                                @else
                                    <div class="w-full h-full bg-museum-green/20 flex items-center justify-center text-[#1b4a47]/30">
                                        <i class="fas fa-calendar-alt text-4xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content details -->
                            <div class="p-5 flex flex-col gap-4">
                                <div>
                                    <!-- Badge -->
                                    <span class="inline-block bg-[#b4853e] text-[#FAF6EE] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-3 shadow-sm select-none">
                                        Pameran Terbaru
                                    </span>
                                    <h3 class="font-['Poppins'] font-bold text-black text-lg leading-snug mb-2">{{ $latestEvent->title }}</h3>
                                    <p class="font-['Poppins'] font-normal text-xs text-gray-500 leading-relaxed">{{ $latestEvent->description }}</p>
                                </div>

                                <!-- Date & Location row -->
                                <div class="grid grid-cols-2 gap-4 border-t border-gray-200/50 pt-4 text-xs font-semibold text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <i class="far fa-calendar-alt text-base text-[#1b4a47]"></i>
                                        <div>
                                            <p class="text-[9px] text-gray-400 font-normal uppercase tracking-wider">Tanggal</p>
                                            <p class="text-[#1b4a47] font-bold text-[11px]">{{ $latestEvent->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 border-l border-gray-200/50 pl-4">
                                        <i class="fas fa-map-marker-alt text-base text-[#1b4a47]"></i>
                                        <div>
                                            <p class="text-[9px] text-gray-400 font-normal uppercase tracking-wider">Lokasi</p>
                                            <p class="text-[#1b4a47] font-bold text-[11px]">Galeri Utama</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Read More button -->
                                <button onclick="alert('Kisah selengkapnya sedang dipersiapkan oleh tim kurator.')" class="bg-[#1b4a47] hover:bg-[#123937] text-white flex items-center justify-center gap-2 py-3.5 rounded-xl text-xs font-bold shadow-md hover:scale-[1.01] active:scale-[0.99] transition-all">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Fallback Event card if no events in database -->
                        <div class="bg-[#f6f4ef] border border-[#EADFCB]/30 rounded-2xl overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
                            <div class="h-48 md:h-56 w-full overflow-hidden bg-gray-100 relative">
                                <img src="https://images.unsplash.com/photo-1596484552834-6a58f850d0a1?w=800&h=400&fit=crop" class="w-full h-full object-cover" alt="Heritage">
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <div>
                                    <span class="inline-block bg-[#b4853e] text-[#FAF6EE] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-3 shadow-sm select-none">
                                        Pameran Terbaru
                                    </span>
                                    <h3 class="font-['Poppins'] font-bold text-black text-lg leading-snug mb-2">Temukan Warisan Singhasari</h3>
                                    <p class="font-['Poppins'] font-normal text-xs text-gray-500 leading-relaxed">Jelajahi artefak dan kisah baru yang mengungkap kejayaan Kerajaan Singhasari.</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4 border-t border-gray-200/50 pt-4 text-xs font-semibold text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <i class="far fa-calendar-alt text-base text-[#1b4a47]"></i>
                                        <div>
                                            <p class="text-[9px] text-gray-400 font-normal uppercase tracking-wider">Tanggal Pembukaan</p>
                                            <p class="text-[#1b4a47] font-bold text-[11px]">20 Mei 2026</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 border-l border-gray-200/50 pl-4">
                                        <i class="fas fa-map-marker-alt text-base text-[#1b4a47]"></i>
                                        <div>
                                            <p class="text-[9px] text-gray-400 font-normal uppercase tracking-wider">Lokasi</p>
                                            <p class="text-[#1b4a47] font-bold text-[11px]">Galeri Utama</p>
                                        </div>
                                    </div>
                                </div>
                                <button onclick="alert('Kisah selengkapnya sedang dipersiapkan oleh tim kurator.')" class="bg-[#1b4a47] hover:bg-[#123937] text-white flex items-center justify-center gap-2 py-3.5 rounded-xl text-xs font-bold shadow-md hover:scale-[1.01] active:scale-[0.99] transition-all">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </button>
                            </div>
                        </div>
                    @endif
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
                        
                        <!-- Activity 1: Mask Painting -->
                        <div class="bg-[#FAF6EE]/10 border border-white/10 rounded-2xl overflow-hidden flex flex-col justify-between h-[280px] p-5 relative">
                            <!-- Image overlay back -->
                            <img src="https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=400&h=300&fit=crop" class="absolute inset-0 w-full h-full object-cover object-bottom select-none z-0 opacity-20 pointer-events-none">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F2F2E] via-[#0F2F2E]/40 to-transparent z-0"></div>

                            <!-- Header -->
                            <div class="relative z-10 self-start">
                                <span class="bg-white text-[#1b4a47] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm">
                                    Acara Lokakarya
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="relative z-10 mt-auto">
                                <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1 text-white">Melukis Topeng</h3>
                                <p class="font-['Poppins'] font-normal text-[11px] text-[#d5c6b1] leading-relaxed mb-4">Lukisan topeng kreatif & pengalaman budaya</p>
                                <button onclick="alert('Pendaftaran lokakarya berhasil dibuka! Hubungi admin untuk detail jadwal.')" class="w-full bg-[#b4853e] hover:bg-[#a37735] text-white py-2.5 rounded-xl text-xs font-bold shadow-md active:scale-95 transition-all">
                                    Ikuti Acara!
                                </button>
                            </div>
                        </div>

                        <!-- Activity 2: Souvenirs -->
                        <div class="bg-[#FAF6EE]/10 border border-white/10 rounded-2xl overflow-hidden flex flex-col justify-between h-[280px] p-5 relative">
                            <!-- Image overlay back -->
                            <img src="https://images.unsplash.com/photo-1518998053401-87891316b25f?w=400&h=300&fit=crop" class="absolute inset-0 w-full h-full object-cover object-bottom select-none z-0 opacity-20 pointer-events-none">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F2F2E] via-[#0F2F2E]/40 to-transparent z-0"></div>

                            <!-- Header -->
                            <div class="relative z-10 self-start">
                                <span class="bg-white text-[#1b4a47] text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm">
                                    Suvenir
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="relative z-10 mt-auto">
                                <h3 class="font-['Poppins'] font-bold text-lg leading-tight mb-1 text-white">Suvenir</h3>
                                <p class="font-['Poppins'] font-normal text-[11px] text-[#d5c6b1] leading-relaxed mb-4">Kerajinan tradisional & suvenir lokal</p>
                                <a href="{{ route('gallery') }}" class="w-full block text-center bg-[#b4853e] hover:bg-[#a37735] text-white py-2.5 rounded-xl text-xs font-bold shadow-md active:scale-95 transition-all">
                                    Lihat Selengkapnya
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
