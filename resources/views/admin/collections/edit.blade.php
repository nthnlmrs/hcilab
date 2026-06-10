@section('section_name', 'Edit Collection Item')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.collections.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Edit Collection Item</h1>
        </div>

        <form action="{{ route('admin.collections.update', $collection) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl p-6 shadow-sm space-y-4 mb-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Title</label>
                    <input type="text" name="title" required value="{{ old('title', $collection->title) }}" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Category</label>
                    <select name="category" required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
                        <option value="Arca" {{ $collection->category == 'Arca' ? 'selected' : '' }}>Arca</option>
                        <option value="Diorama" {{ $collection->category == 'Diorama' ? 'selected' : '' }}>Diorama</option>
                        <option value="Maket" {{ $collection->category == 'Maket' ? 'selected' : '' }}>Maket</option>
                        <option value="Penggilesan" {{ $collection->category == 'Penggilesan' ? 'selected' : '' }}>Penggilesan</option>
                        <option value="Topeng" {{ $collection->category == 'Topeng' ? 'selected' : '' }}>Topeng</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">{{ old('description', $collection->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Current Image</label>
                    @if($collection->image)
                        <img src="{{ $collection->image_url }}" class="w-32 h-24 object-cover rounded-lg mb-2 shadow-sm border">
                    @endif
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-museum-green file:text-white hover:file:bg-museum-darkGreen">
                </div>
            </div>

            <button type="submit" class="w-full block text-center py-4 bg-museum-green text-white rounded-2xl font-bold shadow-lg hover:bg-museum-darkGreen transition-all active:scale-[0.98]">
                UPDATE COLLECTION ITEM
            </button>
        </form>
    </div>
</x-app-layout>
