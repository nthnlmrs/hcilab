@section('section_name', 'Admin Stories')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="font-serif text-2xl font-bold text-museum-green">Folklore Stories</h1>
            <a href="{{ route('admin.stories.create') }}" class="px-4 py-2 bg-museum-green text-white rounded-full text-xs font-bold hover:bg-museum-darkGreen transition-colors">
                <i class="fas fa-plus mr-1"></i> ADD STORY TALE
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 text-xs font-bold p-4 rounded-xl mb-6 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Excerpt</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($stories as $story)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-16 h-12 rounded-lg bg-gray-100 overflow-hidden">
                                        @if($story->image)
                                            <img src="{{ $story->image_url }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <i class="fas fa-book-open"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-museum-green text-sm">
                                    {{ $story->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-museum-beige text-museum-green">
                                        {{ $story->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 max-w-xs">
                                    <div class="truncate max-w-xs" title="{{ $story->excerpt }}">
                                        {{ $story->excerpt }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                                    <a href="{{ route('admin.stories.edit', $story) }}" class="text-museum-green hover:text-museum-darkGreen"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-sm">
                                    No stories found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card List View -->
        <div class="block md:hidden space-y-4">
            @forelse($stories as $story)
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col gap-3 relative">
                    <div class="flex gap-4">
                        <!-- Image -->
                        <div class="w-20 h-16 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                            @if($story->image)
                                <img src="{{ $story->image_url }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-book-open"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Text description -->
                        <div class="flex-1 min-w-0">
                            <span class="inline-block px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider bg-museum-beige text-museum-green mb-1">
                                {{ $story->category }}
                            </span>
                            <h3 class="font-bold text-museum-green text-sm truncate">{{ $story->title }}</h3>
                            <p class="text-xs text-gray-400 line-clamp-1 mt-0.5">{{ $story->excerpt }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-4 pt-3 border-t border-gray-50">
                        <a href="{{ route('admin.stories.edit', $story) }}" class="flex items-center gap-1.5 text-xs font-bold text-museum-green hover:underline">
                            <i class="fas fa-edit text-xs"></i> Edit
                        </a>
                        <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="flex items-center gap-1.5 text-xs font-bold text-red-400 hover:text-red-600">
                                <i class="fas fa-trash-alt text-xs"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                    <p class="text-gray-400 text-sm">No stories found.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
