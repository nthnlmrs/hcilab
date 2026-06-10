@section('section_name', 'Admin Events')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="font-serif text-2xl font-bold text-museum-green">Events</h1>
            <a href="{{ route('admin.events.create') }}" class="px-4 py-2 bg-museum-green text-white rounded-full text-xs font-bold hover:bg-museum-darkGreen transition-colors">
                <i class="fas fa-plus mr-1"></i> ADD EVENT
            </a>
        </div>

        <div class="space-y-4">
            @forelse($events as $event)
                <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center gap-4">
                    <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($event->image)
                            <img src="{{ $event->image_url }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            <h3 class="font-bold text-museum-green text-sm">{{ $event->title }}</h3>
                            @if($event->category)
                                <span class="bg-museum-brown/10 text-museum-brown text-[8px] font-bold px-1.5 py-0.5 rounded">
                                    {{ $event->category }}
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 line-clamp-1 mb-1">{{ $event->description }}</p>
                        <div class="flex gap-3 text-[10px] text-gray-400">
                            @if($event->event_date)
                                <span><i class="far fa-calendar-alt mr-1"></i> {{ $event->event_date->format('d M Y') }}</span>
                            @endif
                            @if($event->location)
                                <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $event->location }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.events.edit', $event) }}" class="text-gray-400 hover:text-museum-green"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                    <p class="text-gray-400 text-sm">No events found.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
