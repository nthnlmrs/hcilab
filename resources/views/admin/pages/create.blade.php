<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.pages.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Create Page</h1>
        </div>

        <form action="{{ route('admin.pages.store') }}" method="POST" id="page-form" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-4 mb-6">
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <label for="title" class="block text-xs font-bold text-gray-500 uppercase mb-1">Page Title</label>
                    <input type="text" name="title" id="title" required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green" placeholder="e.g., Arca Dwarapala">
                </div>

                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <label for="description" class="block text-xs font-bold text-gray-500 uppercase mb-1">Short Description</label>
                    <textarea name="description" id="description" rows="2" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green" placeholder="Brief summary of the artifact..."></textarea>
                </div>

                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <label for="cover_image" class="block text-xs font-bold text-gray-500 uppercase mb-1">Cover Image</label>
                    <input type="file" name="cover_image" id="cover_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-museum-green file:text-white hover:file:bg-museum-darkGreen">
                </div>

                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <label for="status" class="block text-xs font-bold text-gray-500 uppercase mb-1">Status</label>
                    <select name="status" id="status" class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>

            <h2 class="text-sm font-bold text-museum-green mb-4 uppercase tracking-wider">Content Blocks</h2>
            <div id="blocks-container" class="space-y-4 mb-6">
                <!-- Blocks will be added here via JS -->
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-sm mb-6">
                <p class="text-center text-xs font-bold text-gray-400 mb-3 uppercase">Add Content Block</p>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="addBlock('title')" class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <i class="fas fa-heading text-museum-green mb-1"></i>
                        <span class="text-[10px] font-bold text-gray-600">TITLE</span>
                    </button>
                    <button type="button" onclick="addBlock('description')" class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <i class="fas fa-align-left text-museum-green mb-1"></i>
                        <span class="text-[10px] font-bold text-gray-600">TEXT</span>
                    </button>
                    <button type="button" onclick="addBlock('image')" class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <i class="fas fa-image text-museum-green mb-1"></i>
                        <span class="text-[10px] font-bold text-gray-600">IMAGE</span>
                    </button>
                    <button type="button" onclick="addBlock('card')" class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <i class="fas fa-id-card text-museum-green mb-1"></i>
                        <span class="text-[10px] font-bold text-gray-600">CARD</span>
                    </button>
                    <button type="button" onclick="addBlock('button')" class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <i class="fas fa-link text-museum-green mb-1"></i>
                        <span class="text-[10px] font-bold text-gray-600">LINK</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full block text-center py-4 bg-museum-green text-white rounded-2xl font-bold shadow-lg hover:bg-museum-darkGreen transition-all active:scale-[0.98]">
                SAVE PAGE & GENERATE QR
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        let blockIndex = 0;
        const container = document.getElementById('blocks-container');

        new Sortable(container, {
            animation: 150,
            handle: '.drag-handle',
            onEnd: function() {
                // Re-index blocks if necessary, but using the order they are in the DOM during POST is easier
                // Laravel will receive them in the order they appear if we don't use indexes in name,
                // but we are using indexes. Let's stick to indexes and handle order in controller by appearance.
            }
        });

        function addBlock(type) {
            let contentHtml = '';
            let title = '';
            let icon = '';

            if (type === 'title') {
                title = 'Title Block';
                icon = 'fa-heading';
                contentHtml = `
                    <div class="grid grid-cols-2 gap-2 mb-2">
                        <select name="blocks[${blockIndex}][data][level]" class="text-xs rounded-lg border-gray-300">
                            <option value="h1">Heading 1</option>
                            <option value="h2" selected>Heading 2</option>
                            <option value="h3">Heading 3</option>
                        </select>
                        <select name="blocks[${blockIndex}][data][align]" class="text-xs rounded-lg border-gray-300">
                            <option value="left">Left</option>
                            <option value="center" selected>Center</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <input type="text" name="blocks[${blockIndex}][content]" placeholder="Enter title..." required class="w-full text-lg font-bold rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green">
                `;
            } else if (type === 'description') {
                title = 'Description Block';
                icon = 'fa-align-left';
                contentHtml = `
                    <select name="blocks[${blockIndex}][data][align]" class="text-xs rounded-lg border-gray-300 mb-2">
                        <option value="left" selected>Left</option>
                        <option value="center">Center</option>
                        <option value="justify">Justify</option>
                    </select>
                    <textarea name="blocks[${blockIndex}][content]" placeholder="Enter description content..." rows="4" required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green"></textarea>
                `;
            } else if (type === 'image') {
                title = 'Image Block';
                icon = 'fa-image';
                contentHtml = `
                    <input type="file" name="blocks[${blockIndex}][image_file]" required class="w-full text-xs text-gray-500 mb-2">
                    <input type="text" name="blocks[${blockIndex}][data][alt]" placeholder="Alt text (for accessibility)" class="w-full text-xs rounded-lg border-gray-300 mb-1">
                    <input type="text" name="blocks[${blockIndex}][data][caption]" placeholder="Optional caption" class="w-full text-xs rounded-lg border-gray-300">
                `;
            } else if (type === 'card') {
                title = 'Card Block';
                icon = 'fa-id-card';
                contentHtml = `
                    <div class="space-y-2">
                        <input type="file" name="blocks[${blockIndex}][image_file]" class="w-full text-xs text-gray-500">
                        <input type="text" name="blocks[${blockIndex}][data][title]" placeholder="Card Title" class="w-full text-sm font-bold rounded-lg border-gray-300">
                        <textarea name="blocks[${blockIndex}][data][desc]" placeholder="Card Description" rows="2" class="w-full text-sm rounded-lg border-gray-300"></textarea>
                        <div class="flex gap-2">
                             <input type="text" name="blocks[${blockIndex}][data][btn_text]" placeholder="Button Text" class="w-1/2 text-xs rounded-lg border-gray-300">
                             <input type="text" name="blocks[${blockIndex}][data][btn_link]" placeholder="Button Link" class="w-1/2 text-xs rounded-lg border-gray-300">
                        </div>
                    </div>
                `;
            } else if (type === 'button') {
                title = 'Button Link Block';
                icon = 'fa-link';
                contentHtml = `
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" name="blocks[${blockIndex}][data][text]" placeholder="Button Label" required class="w-full rounded-lg border-gray-300">
                        <input type="text" name="blocks[${blockIndex}][data][url]" placeholder="URL (e.g., https://...)" required class="w-full rounded-lg border-gray-300">
                    </div>
                    <div class="mt-2">
                        <label class="inline-flex items-center text-xs text-gray-500">
                            <input type="checkbox" name="blocks[${blockIndex}][data][new_tab]" value="1" class="rounded text-museum-green mr-2"> Open in new tab
                        </label>
                    </div>
                `;
            }

            const blockHtml = `
                <div class="bg-white rounded-2xl p-4 shadow-sm relative block-item border-l-4 border-museum-green">
                    <input type="hidden" name="blocks[${blockIndex}][type]" value="${type}">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-2 mb-3">
                        <div class="flex items-center drag-handle cursor-move">
                            <i class="fas fa-grip-vertical text-gray-300 mr-3"></i>
                            <span class="text-[10px] font-black text-museum-green uppercase tracking-widest"><i class="fas ${icon} mr-1"></i> ${title}</span>
                        </div>
                        <button type="button" onclick="this.closest('.block-item').remove()" class="w-6 h-6 flex items-center justify-center rounded-full bg-red-50 text-red-400 hover:bg-red-100 transition-colors"><i class="fas fa-times text-xs"></i></button>
                    </div>
                    ${contentHtml}
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', blockHtml);
            blockIndex++;
        }
    </script>
</x-app-layout>
