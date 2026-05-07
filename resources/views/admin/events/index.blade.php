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
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-museum-green text-sm">{{ $event->title }}</h3>
                        <p class="text-xs text-gray-400 line-clamp-1">{{ $event->description }}</p>
                    </div>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                    <p class="text-gray-400 text-sm">No events found.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
