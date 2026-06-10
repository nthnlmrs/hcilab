@section('section_name', 'Edit Event')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.events.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Edit Event</h1>
        </div>

        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl p-6 shadow-sm space-y-4 mb-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Event Title</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full rounded-xl border-gray-300" placeholder="e.g., Cultural Exhibition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Category / Badge</label>
                    <input type="text" name="category" value="{{ old('category', $event->category) }}" class="w-full rounded-xl border-gray-300" placeholder="e.g., Pameran Terbaru, Pengumuman">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Event Date</label>
                        <input type="date" name="event_date" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}" class="w-full rounded-xl border-gray-300">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Location</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full rounded-xl border-gray-300" placeholder="e.g., Galeri Utama">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Duration</label>
                        <input type="text" name="duration" value="{{ old('duration', $event->duration) }}" class="w-full rounded-xl border-gray-300" placeholder="e.g., 3 Bulan">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Cover Image</label>
                    @if($event->image)
                        <div class="mb-2">
                            <img src="{{ $event->image_url }}" class="w-32 h-20 object-cover rounded-xl shadow-sm border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-museum-green file:text-white hover:file:bg-museum-darkGreen">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Description</label>
                    <textarea name="description" rows="6" class="w-full rounded-xl border-gray-300" placeholder="Describe the event...">{{ old('description', $event->description) }}</textarea>
                </div>
            </div>

            <button type="submit" class="w-full block text-center py-4 bg-museum-green text-white rounded-2xl font-bold shadow-lg hover:bg-museum-darkGreen transition-all active:scale-[0.98]">
                UPDATE EVENT
            </button>
        </form>
    </div>
</x-app-layout>
