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

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
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
                                            <img src="{{ $story->image }}" class="w-full h-full object-cover">
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
                                <td class="px-6 py-4 text-xs text-gray-500 max-w-xs truncate">
                                    {{ $story->excerpt }}
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
    </div>
</x-app-layout>
