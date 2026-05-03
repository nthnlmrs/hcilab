<x-app-layout>
    <div class="pt-6 pb-20">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.quizzes.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">Create Quiz</h1>
        </div>

        <form action="{{ route('admin.quizzes.store') }}" method="POST" id="quiz-form">
            @csrf
            
            <div class="mb-6 bg-white rounded-2xl p-5 shadow-sm border-t-8 border-museum-green">
                <input type="text" name="title" placeholder="Quiz Title" required class="w-full text-2xl font-serif font-bold border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-museum-green px-0 py-2 mb-3">
                <textarea name="description" placeholder="Quiz Description (optional)" rows="2" class="w-full text-sm text-gray-600 border-0 border-b border-gray-200 focus:ring-0 focus:border-museum-green px-0 py-1"></textarea>
            </div>

            <div id="questions-container" class="space-y-6 mb-6">
                <!-- Question 1 (Default) -->
                <div class="bg-white rounded-2xl p-5 shadow-sm question-block" data-index="0">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold text-gray-700">Question 1</h3>
                    </div>
                    
                    <input type="text" name="questions[0][text]" placeholder="Question Text" required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green bg-gray-50 mb-3">
                    
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <input type="url" name="questions[0][image]" placeholder="Image URL (Opt)" class="rounded-xl border-gray-300 text-sm">
                        <input type="text" name="questions[0][desc]" placeholder="Explanation (Opt)" class="rounded-xl border-gray-300 text-sm">
                    </div>

                    <div class="space-y-2 choices-container">
                        <!-- Choices -->
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[0][correct_choice]" value="0" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[0][choices][0][text]" placeholder="Option 1" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[0][correct_choice]" value="1" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[0][choices][1][text]" placeholder="Option 2" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[0][correct_choice]" value="2" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[0][choices][2][text]" placeholder="Option 3" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[0][correct_choice]" value="3" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[0][choices][3][text]" placeholder="Option 4" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mb-8">
                <button type="button" onclick="addQuestion()" class="flex-1 py-3 bg-white text-museum-green border border-museum-green rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Add Question
                </button>
            </div>

            <button type="submit" class="w-full block text-center py-3 bg-museum-green text-white rounded-xl font-semibold hover:bg-museum-lightGreen transition-colors shadow-md">
                Save Quiz
            </button>
        </form>
    </div>

    <script>
        let qIndex = 1;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const qHtml = `
                <div class="bg-white rounded-2xl p-5 shadow-sm question-block relative" data-index="${qIndex}">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold text-gray-700">Question ${qIndex + 1}</h3>
                        <button type="button" onclick="this.closest('.question-block').remove()" class="text-red-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                    </div>
                    
                    <input type="text" name="questions[${qIndex}][text]" placeholder="Question Text" required class="w-full rounded-xl border-gray-300 focus:border-museum-green focus:ring-museum-green bg-gray-50 mb-3">
                    
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <input type="url" name="questions[${qIndex}][image]" placeholder="Image URL (Opt)" class="rounded-xl border-gray-300 text-sm">
                        <input type="text" name="questions[${qIndex}][desc]" placeholder="Explanation (Opt)" class="rounded-xl border-gray-300 text-sm">
                    </div>

                    <div class="space-y-2 choices-container">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[${qIndex}][correct_choice]" value="0" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[${qIndex}][choices][0][text]" placeholder="Option 1" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[${qIndex}][correct_choice]" value="1" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[${qIndex}][choices][1][text]" placeholder="Option 2" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[${qIndex}][correct_choice]" value="2" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[${qIndex}][choices][2][text]" placeholder="Option 3" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[${qIndex}][correct_choice]" value="3" required class="text-museum-green focus:ring-museum-green w-5 h-5">
                            <input type="text" name="questions[${qIndex}][choices][3][text]" placeholder="Option 4" required class="w-full border-0 border-b border-gray-300 focus:ring-0 focus:border-museum-green py-1">
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', qHtml);
            qIndex++;
        }
    </script>
</x-app-layout>
