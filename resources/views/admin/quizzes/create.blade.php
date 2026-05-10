@section('section_name', 'Create Quiz')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.quizzes.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Create Quiz</h1>
        </div>

        <form action="{{ route('admin.quizzes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-4 mb-8">
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Quiz Information</label>
                    <input type="text" name="title" required class="w-full rounded-xl border-gray-300 mb-3" placeholder="Quiz Title">
                    <textarea name="description" rows="2" class="w-full rounded-xl border-gray-300 mb-3" placeholder="Quiz Description"></textarea>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-gray-300 text-sm">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Cover Image</label>
                            <input type="file" name="image" class="w-full text-xs text-gray-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-bold text-museum-green uppercase tracking-wider">Questions</h2>
                <button type="button" onclick="addQuestion()" class="text-xs font-bold bg-museum-green text-white px-3 py-1.5 rounded-full hover:bg-museum-darkGreen transition-colors">
                    <i class="fas fa-plus mr-1"></i> ADD QUESTION
                </button>
            </div>

            <div id="questions-container" class="space-y-6 mb-8">
                <!-- Questions added via JS -->
            </div>

            <button type="submit" class="w-full block text-center py-4 bg-museum-green text-white rounded-2xl font-bold shadow-lg hover:bg-museum-darkGreen transition-all active:scale-[0.98]">
                CREATE QUIZ
            </button>
        </form>
    </div>

    <script>
        let questionIndex = 0;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const qIdx = questionIndex++;

            const qHtml = `
                <div class="bg-white rounded-2xl p-5 shadow-soft relative border-l-4 border-museum-brown question-item">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-museum-brown text-white text-[10px] font-black px-2 py-0.5 rounded uppercase">Question</span>
                        <button type="button" onclick="this.closest('.question-item').remove()" class="text-red-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    
                    <div class="space-y-3 mb-4">
                        <input type="text" name="questions[${qIdx}][text]" required class="w-full rounded-xl border-gray-300 font-bold" placeholder="Question Text?">
                        <textarea name="questions[${qIdx}][desc]" rows="2" class="w-full rounded-xl border-gray-300 text-sm" placeholder="Optional explanation/hint..."></textarea>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Points</label>
                                <input type="number" name="questions[${qIdx}][points]" value="10" class="w-full rounded-xl border-gray-300 text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Image</label>
                                <input type="file" name="questions[${qIdx}][image_file]" class="w-full text-xs text-gray-500">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase">Choices</label>
                        <div id="choices-container-${qIdx}" class="space-y-2">
                            <!-- Choices added here -->
                        </div>
                        <button type="button" onclick="addChoice(${qIdx})" class="text-[10px] font-bold text-museum-green hover:underline"><i class="fas fa-plus-circle mr-1"></i> ADD CHOICE</button>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', qHtml);
            // Add 4 default choices
            for(let i=0; i<4; i++) addChoice(qIdx);
        }

        let choiceCounters = {};

        function addChoice(qIdx) {
            const container = document.getElementById(`choices-container-${qIdx}`);
            if (!choiceCounters[qIdx]) choiceCounters[qIdx] = 0;
            const cIdx = choiceCounters[qIdx]++;

            const cHtml = `
                <div class="flex items-center gap-2 choice-row">
                    <input type="radio" name="questions[${qIdx}][correct_choice]" value="${cIdx}" required ${cIdx === 0 ? 'checked' : ''} class="text-museum-green focus:ring-museum-green">
                    <input type="text" name="questions[${qIdx}][choices][${cIdx}][text]" required class="flex-1 rounded-lg border-gray-300 text-sm py-1" placeholder="Choice text">
                    <button type="button" onclick="if(this.closest('.choice-row').parentElement.children.length > 2) this.closest('.choice-row').remove()" class="text-gray-300 hover:text-red-400"><i class="fas fa-times"></i></button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', cHtml);
        }

        // Initialize with one question
        addQuestion();
    </script>
</x-app-layout>
