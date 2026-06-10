@section('section_name', 'Plan Your Visit')
<x-app-layout>
    <div class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-[#FAF6EE]">
        
        <!-- Hero Cover Area -->
        <div class="relative h-[250px] md:h-[350px] w-full overflow-hidden shadow-sm rounded-b-[30px]">
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
                    <a href="{{ route('events.show', $event) }}" class="inline-flex items-center justify-center w-11 h-11 bg-white text-[#1B4A47] hover:bg-[#FAF6EE] rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all select-none">
                        <i class="fas fa-arrow-left text-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="relative z-20 px-6 py-6 pb-32" x-data="{ 
            selectedDate: '{{ $event->schedules->first() ? $event->schedules->first()->date->format('Y-m-d') : null }}', 
            selectedTime: null, 
            participants: 1, 
            maxParticipants: {{ $event->max_participants ?? 15 }} 
        }">
            
            <!-- Event Title and Info -->
            <div class="mb-6">
                <h1 class="font-serif text-2xl md:text-3xl font-extrabold mb-1 text-[#1B4A47]">{{ $event->title }}</h1>
                <p class="font-sans text-xs text-gray-500 mb-4">{{ $event->category }}</p>
                
                <!-- Quick Info -->
                <div class="flex items-center gap-4 text-xs font-bold text-gray-700">
                    <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-full shadow-sm border border-gray-100">
                        <i class="far fa-clock text-[#1B4A47]"></i>
                        <span>{{ $event->duration }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-full shadow-sm border border-gray-100">
                        <i class="fas fa-user-friends text-[#1B4A47]"></i>
                        <span>Maks {{ $event->max_participants }} orang</span>
                    </div>
                    <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-full shadow-sm border border-gray-100">
                        <i class="fas fa-child text-[#1B4A47]"></i>
                        <span>{{ $event->target_audience }}</span>
                    </div>
                </div>
            </div>

            <!-- Features Icons -->
            @if($event->features && count($event->features) > 0)
            <div class="flex justify-between items-start mb-8 bg-white p-4 rounded-2xl shadow-sm border border-[#EADFCB]/30">
                @if(in_array('materials', $event->features))
                <div class="flex flex-col items-center gap-2 w-1/4">
                    <div class="w-10 h-10 rounded-full bg-[#f6f4ef] flex items-center justify-center text-[#1b4a47]">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <span class="text-[9px] text-center font-bold text-gray-600 leading-tight">Bahan Tersedia</span>
                </div>
                @endif
                @if(in_array('instructor', $event->features))
                <div class="flex flex-col items-center gap-2 w-1/4">
                    <div class="w-10 h-10 rounded-full bg-[#f6f4ef] flex items-center justify-center text-[#1b4a47]">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <span class="text-[9px] text-center font-bold text-gray-600 leading-tight">Dipandu Instruktur</span>
                </div>
                @endif
                @if(in_array('certificate', $event->features))
                <div class="flex flex-col items-center gap-2 w-1/4">
                    <div class="w-10 h-10 rounded-full bg-[#f6f4ef] flex items-center justify-center text-[#1b4a47]">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <span class="text-[9px] text-center font-bold text-gray-600 leading-tight">Sertifikat Keikutsertaan</span>
                </div>
                @endif
                @if(in_array('drinks', $event->features))
                <div class="flex flex-col items-center gap-2 w-1/4">
                    <div class="w-10 h-10 rounded-full bg-[#f6f4ef] flex items-center justify-center text-[#1b4a47]">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <span class="text-[9px] text-center font-bold text-gray-600 leading-tight">Minuman Gratis</span>
                </div>
                @endif
            </div>
            @endif

            <!-- Tentang Acara -->
            <div class="mb-8">
                <h2 class="font-serif text-lg font-bold text-[#1b4a47] mb-3">Tentang Acara</h2>
                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ \Illuminate\Support\Str::limit($event->description, 300, '...') }}
                </p>
            </div>

            <!-- Waktu & Tempat -->
            @php
                $groupedSchedules = $event->schedules->groupBy(function($schedule) {
                    return $schedule->date->format('Y-m-d');
                });
            @endphp
            
            @if($groupedSchedules->isNotEmpty())
            <div class="mb-8 bg-white p-5 rounded-3xl shadow-sm border border-[#EADFCB]/30">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-serif text-lg font-bold text-[#1b4a47]">Waktu & Tempat</h2>
                </div>
                
                <!-- Date Selector (Horizontal Scroll) -->
                <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide -mx-1 px-1 mb-5">
                    @foreach($groupedSchedules as $dateString => $schedules)
                    @php
                        $dateObj = \Carbon\Carbon::parse($dateString);
                    @endphp
                    <div @click="selectedDate = '{{ $dateString }}'; selectedTime = null" 
                         :class="selectedDate === '{{ $dateString }}' ? 'bg-[#1b4a47] text-white border-[#1b4a47] shadow-md' : 'bg-[#f6f4ef] text-gray-500 border-gray-100 cursor-pointer'"
                         class="flex-shrink-0 w-[60px] py-2.5 rounded-xl text-center border transition-colors">
                        <p class="text-[10px] font-medium mb-0.5">{{ $dateObj->translatedFormat('l') }}</p>
                        <p class="text-xs font-bold">{{ $dateObj->translatedFormat('d M') }}</p>
                    </div>
                    @endforeach
                </div>

                <!-- Time Selector -->
                @foreach($groupedSchedules as $dateString => $schedules)
                <div x-show="selectedDate === '{{ $dateString }}'" style="display: none;" class="grid grid-cols-3 gap-2">
                    @foreach($schedules as $schedule)
                    @php
                        $timeString = \Carbon\Carbon::parse($schedule->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($schedule->end_time)->format('H:i');
                    @endphp
                    <div @click="selectedTime = '{{ $timeString }}'"
                         :class="selectedTime === '{{ $timeString }}' ? 'border-[#1b4a47] bg-[#f2f7f7] text-[#1b4a47]' : 'border-gray-200 bg-white text-gray-500 cursor-pointer hover:bg-gray-50'"
                         class="py-2 text-center rounded-lg border text-[11px] font-bold transition-colors">
                        {{ $timeString }}
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            @endif

            <!-- Peserta -->
            <div class="mb-10 bg-white p-5 rounded-3xl shadow-sm border border-[#EADFCB]/30">
                <h2 class="font-serif text-lg font-bold text-[#1b4a47] mb-4">Peserta</h2>
                
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#f6f4ef] flex items-center justify-center text-[#1b4a47]">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-gray-800">Peserta</p>
                            <p class="text-[10px] text-gray-400">Kuota {{ $event->max_participants }} orang</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 bg-[#f6f4ef] px-3 py-1.5 rounded-full border border-[#EADFCB]/50">
                        <button @click="if(participants > 1) participants--" class="w-6 h-6 flex items-center justify-center text-[#1b4a47] rounded-full hover:bg-white transition-colors">
                            <i class="fas fa-minus text-[10px]"></i>
                        </button>
                        <span x-text="participants" class="font-bold text-sm text-[#1b4a47] w-4 text-center">1</span>
                        <button @click="if(participants < maxParticipants) participants++" class="w-6 h-6 flex items-center justify-center text-[#1b4a47] rounded-full bg-white shadow-sm transition-colors">
                            <i class="fas fa-plus text-[10px]"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-start gap-2 bg-[#f9f9f9] p-2.5 rounded-xl">
                    <i class="fas fa-info-circle text-[#b4853e] mt-0.5 text-xs"></i>
                    <p class="text-[10px] text-gray-500 leading-tight">
                        Hubungi kami apabila ingin daftar lebih dari {{ $event->max_participants }} orang
                    </p>
                </div>
            </div>

        </div>

        <!-- Fixed Bottom Action Bar -->
        <div class="fixed bottom-0 left-0 right-0 md:left-[50%] md:-translate-x-[50%] md:max-w-[480px] bg-white border-t border-gray-100 p-4 md:p-6 z-50 rounded-t-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.05)]">
            <button @click="alert('Booking ' + participants + ' peserta untuk ' + selectedDate + ' jam ' + selectedTime + ' berhasil disubmit!')" 
                    :disabled="!selectedDate || !selectedTime"
                    :class="(!selectedDate || !selectedTime) ? 'opacity-50 cursor-not-allowed' : 'hover:scale-[1.01] active:scale-[0.99] shadow-lg shadow-[#1b4a47]/30 hover:bg-[#123937]'"
                    class="w-full bg-[#1b4a47] text-white flex items-center justify-center gap-2 py-4 rounded-2xl text-sm font-black transition-all">
                <span x-text="selectedTime ? 'Booking acara' : 'Pilih Waktu'">Booking acara</span>
            </button>
        </div>

    </div>
</x-app-layout>
