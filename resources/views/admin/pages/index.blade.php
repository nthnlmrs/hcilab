<x-app-layout>
    <div class="pt-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.dashboard') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">Manage Pages</h1>
        </div>

        <a href="{{ route('admin.pages.create') }}" class="mb-6 block text-center py-3 bg-museum-green text-white rounded-xl font-semibold hover:bg-museum-lightGreen transition-colors">
            <i class="fas fa-plus mr-2"></i> Create New Page
        </a>

        <div class="space-y-4">
            @foreach($pages as $page)
                <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-museum-green">{{ $page->title }}</h3>
                        <a href="{{ url('/p/'.$page->slug) }}" class="text-xs text-blue-500 hover:underline" target="_blank">{{ url('/p/'.$page->slug) }}</a>
                    </div>
                    <a href="{{ asset($page->qr_code_path) }}" download class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-museum-green hover:bg-gray-200" title="Download QR">
                        <i class="fas fa-qrcode"></i>
                    </a>
                </div>
            @endforeach
            @if($pages->isEmpty())
                <p class="text-center text-gray-500 mt-8">No pages created yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
