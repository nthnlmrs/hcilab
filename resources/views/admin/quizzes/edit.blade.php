@section('section_name', 'Edit Quiz')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.quizzes.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Edit Quiz</h1>
        </div>

        <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4 mb-8">
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Quiz Information</label>
                    <input type="text" name="title" value="{{ old('title', $quiz->title) }}" required class="w-full rounded-xl border-gray-300 mb-3" placeholder="Quiz Title">
                    <textarea name="description" rows="2" class="w-full rounded-xl border-gray-300 mb-3" placeholder="Quiz Description">{{ old('description', $quiz->description) }}</textarea>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-gray-300 text-sm">
                                <option value="draft" {{ (old('status', $quiz->status) == 'draft') ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ (old('status', $quiz->status) == 'published') ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Cover Image</label>
                            <input type="file" name="image" class="w-full text-xs text-gray-500">
                            @if($quiz->image)
                                <div class="mt-2 text-[10px] text-gray-500 flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $quiz->image) }}" class="w-8 h-8 rounded object-cover">
                                    <span>Current Image</span>
                                </div>
                            @endif
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
                UPDATE QUIZ
            </button>
        </form>
    </div>

    <script>
        let questionIndex = 0;
        let choiceCounters = {};

        const existingQuestions = @json($quiz->questions);

        function addQuestion(existingData = null) {
            const container = document.getElementById('questions-container');
            const qIdx = questionIndex++;

            const qText = existingData ? existingData.text : '';
            const qDesc = existingData && existingData.description ? existingData.description : '';
            const qPoints = existingData ? existingData.points : 10;
            const qImagePath = existingData && existingData.image_path ? existingData.image_path : '';

            let existingImageHtml = '';
            if (qImagePath) {
                existingImageHtml = `
                    <input type="hidden" name="questions[${qIdx}][existing_image]" value="${qImagePath}">
                    <div class="mt-2 text-[10px] text-gray-500 flex items-center gap-2">
                        <img src="/storage/${qImagePath}" class="w-8 h-8 rounded object-cover">
                        <span>Current Image</span>
                    </div>
                `;
            }

            const qHtml = `
                <div class="bg-white rounded-2xl p-5 shadow-soft relative border-l-4 border-museum-brown question-item">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-museum-brown text-white text-[10px] font-black px-2 py-0.5 rounded uppercase">Question</span>
                        <button type="button" onclick="this.closest('.question-item').remove()" class="text-red-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </div>

                    <div class="space-y-3 mb-4">
                        <input type="text" name="questions[${qIdx}][text]" value="${qText.replace(/"/g, '&quot;')}" required class="w-full rounded-xl border-gray-300 font-bold" placeholder="Question Text?">
                        <textarea name="questions[${qIdx}][desc]" rows="2" class="w-full rounded-xl border-gray-300 text-sm" placeholder="Optional explanation/hint...">${qDesc}</textarea>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Points</label>
                                <input type="number" name="questions[${qIdx}][points]" value="${qPoints}" class="w-full rounded-xl border-gray-300 text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Image</label>
                                <input type="file" name="questions[${qIdx}][image_file]" class="w-full text-xs text-gray-500">
                                ${existingImageHtml}
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

            if (existingData && existingData.choices) {
                existingData.choices.forEach((choice, idx) => {
                    addChoice(qIdx, choice, idx);
                });
            } else {
                // Add 4 default choices
                for(let i=0; i<4; i++) addChoice(qIdx);
            }
        }

        function addChoice(qIdx, existingChoice = null, idx = null) {
            const container = document.getElementById(`choices-container-${qIdx}`);
            if (!choiceCounters[qIdx]) choiceCounters[qIdx] = 0;
            const cIdx = choiceCounters[qIdx]++;

            const cText = existingChoice ? existingChoice.text : '';
            const isCorrect = existingChoice ? existingChoice.is_correct : (cIdx === 0);

            // Map the value to cIdx so form submission lines up correctly
            const cHtml = `
                <div class="flex items-center gap-2 choice-row">
                    <input type="radio" name="questions[${qIdx}][correct_choice]" value="${cIdx}" required ${isCorrect ? 'checked' : ''} class="text-museum-green focus:ring-museum-green">
                    <input type="text" name="questions[${qIdx}][choices][${cIdx}][text]" value="${cText.replace(/"/g, '&quot;')}" required class="flex-1 rounded-lg border-gray-300 text-sm py-1" placeholder="Choice text">
                    <button type="button" onclick="if(this.closest('.choice-row').parentElement.children.length > 2) this.closest('.choice-row').remove()" class="text-gray-300 hover:text-red-400"><i class="fas fa-times"></i></button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', cHtml);
        }

        // Initialize with existing questions or one default
        if (existingQuestions.length > 0) {
            existingQuestions.forEach(q => addQuestion(q));
        } else {
            addQuestion();
        }
    </script>
</x-app-layout>
