@section('section_name', 'Edit Story Tale')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.stories.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Edit Folklore Story</h1>
        </div>

        <form action="{{ route('admin.stories.update', $story) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl p-6 shadow-sm space-y-4 mb-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Title</label>
                    <input type="text" name="title" required value="{{ old('title', $story->title) }}" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Category</label>
                    <input type="text" name="category" required value="{{ old('category', $story->category) }}" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Excerpt</label>
                    <input type="text" name="excerpt" value="{{ old('excerpt', $story->excerpt) }}" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Full Content</label>
                    <textarea name="content" required rows="6" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">{{ old('content', $story->content) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Current Image</label>
                    @if($story->image)
                        <img src="{{ $story->image_url }}" class="w-32 h-24 object-cover rounded-lg mb-2 shadow-sm border">
                    @endif
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-museum-green file:text-white hover:file:bg-museum-darkGreen">
                </div>
            </div>

            <button type="submit" class="w-full block text-center py-4 bg-museum-green text-white rounded-2xl font-bold shadow-lg hover:bg-museum-darkGreen transition-all active:scale-[0.98]">
                UPDATE STORY TALE
            </button>
        </form>
    </div>
</x-app-layout>
