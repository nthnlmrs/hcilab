<x-app-layout>
    <div class="pt-6 pb-20">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.pages.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Create Page</h1>
        </div>

        <form action="{{ route('admin.pages.store') }}" method="POST" id="page-form">
            @csrf
            
            <div class="mb-6 bg-white rounded-2xl p-4 shadow-sm">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Page Title</label>
                <input type="text" name="title" id="title" required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
            </div>

            <div id="blocks-container" class="space-y-4 mb-6">
                <!-- Blocks will be added here via JS -->
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-sm mb-6 flex flex-wrap gap-2 justify-center">
                <p class="w-full text-center text-xs text-gray-500 mb-2">Add Content Blocks</p>
                <button type="button" onclick="addBlock('title')" class="px-3 py-1 bg-gray-100 text-museum-green rounded-full text-xs font-semibold hover:bg-gray-200"><i class="fas fa-heading"></i> Title</button>
                <button type="button" onclick="addBlock('desc')" class="px-3 py-1 bg-gray-100 text-museum-green rounded-full text-xs font-semibold hover:bg-gray-200"><i class="fas fa-align-left"></i> Desc</button>
                <button type="button" onclick="addBlock('image')" class="px-3 py-1 bg-gray-100 text-museum-green rounded-full text-xs font-semibold hover:bg-gray-200"><i class="fas fa-image"></i> Image</button>
                <button type="button" onclick="addBlock('button')" class="px-3 py-1 bg-gray-100 text-museum-green rounded-full text-xs font-semibold hover:bg-gray-200"><i class="fas fa-link"></i> Button</button>
                <button type="button" onclick="addBlock('card')" class="px-3 py-1 bg-gray-100 text-museum-green rounded-full text-xs font-semibold hover:bg-gray-200"><i class="fas fa-id-card"></i> Card</button>
            </div>

            <button type="submit" class="w-full block text-center py-3 bg-museum-green text-white rounded-xl font-semibold hover:bg-museum-lightGreen transition-colors">
                Save Page & Generate QR
            </button>
        </form>
    </div>

    <script>
        let blockIndex = 0;

        function addBlock(type) {
            const container = document.getElementById('blocks-container');
            let contentHtml = '';
            let title = '';

            if (type === 'title') {
                title = 'Title Block';
                contentHtml = `<input type="text" name="blocks[${blockIndex}][content]" placeholder="Enter title..." required class="w-full text-lg font-bold rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green mt-2">`;
            } else if (type === 'desc') {
                title = 'Description Block';
                contentHtml = `<textarea name="blocks[${blockIndex}][content]" placeholder="Enter description..." rows="3" required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green mt-2"></textarea>`;
            } else if (type === 'image') {
                title = 'Image URL Block';
                contentHtml = `<input type="url" name="blocks[${blockIndex}][content]" placeholder="Enter image URL..." required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green mt-2">`;
            } else if (type === 'button') {
                title = 'Button Link Block';
                contentHtml = `
                    <div class="flex gap-2 mt-2">
                        <input type="text" name="blocks[${blockIndex}][content][text]" placeholder="Button Text" required class="w-1/2 rounded-xl border-gray-300">
                        <input type="url" name="blocks[${blockIndex}][content][url]" placeholder="Button URL" required class="w-1/2 rounded-xl border-gray-300">
                    </div>`;
            } else if (type === 'card') {
                title = 'Card (Img + Title + Desc)';
                contentHtml = `
                    <div class="space-y-2 mt-2">
                        <input type="url" name="blocks[${blockIndex}][content][image]" placeholder="Image URL" required class="w-full rounded-xl border-gray-300">
                        <input type="text" name="blocks[${blockIndex}][content][title]" placeholder="Card Title" required class="w-full rounded-xl border-gray-300">
                        <textarea name="blocks[${blockIndex}][content][desc]" placeholder="Card Description" rows="2" required class="w-full rounded-xl border-gray-300"></textarea>
                    </div>`;
            }

            const blockHtml = `
                <div class="bg-white rounded-2xl p-4 shadow-sm relative block-item">
                    <input type="hidden" name="blocks[${blockIndex}][type]" value="${type}">
                    <div class="flex justify-between items-center border-b pb-2 mb-2">
                        <span class="text-xs font-bold text-gray-500 uppercase"><i class="fas fa-arrows-alt text-gray-300 mr-2 cursor-move"></i>${title}</span>
                        <button type="button" onclick="this.closest('.block-item').remove()" class="text-red-400 hover:text-red-600"><i class="fas fa-times"></i></button>
                    </div>
                    ${contentHtml}
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', blockHtml);
            blockIndex++;
        }
    </script>
</x-app-layout>
