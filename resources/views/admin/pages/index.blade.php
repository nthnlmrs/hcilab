@section('section_name', 'Admin Pages')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="font-serif text-2xl font-bold text-museum-green">Museum Pages</h1>
            <a href="{{ route('admin.pages.create') }}" class="px-4 py-2 bg-museum-green text-white rounded-full text-xs font-bold hover:bg-museum-darkGreen transition-colors">
                <i class="fas fa-plus mr-1"></i> ADD PAGE
            </a>
        </div>

        <div class="space-y-4">
            @forelse($pages as $page)
                <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center gap-4">
                    <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($page->cover_image)
                            <img src="{{ asset('storage/' . $page->cover_image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-0.5">
                            <h3 class="font-bold text-museum-green text-sm">{{ $page->title }}</h3>
                            <span class="text-[8px] font-bold px-1.5 py-0.5 rounded-full {{ $page->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ strtoupper($page->status) }}
                            </span>
                        </div>
                        <p class="text-[10px] text-gray-400">/p/{{ $page->slug }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ asset('storage/' . $page->qr_code_path) }}" download class="text-museum-brown hover:text-museum-green">
                            <i class="fas fa-qrcode text-lg"></i>
                        </a>
                        <button class="text-gray-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                    <p class="text-gray-400 text-sm">No museum pages created yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
