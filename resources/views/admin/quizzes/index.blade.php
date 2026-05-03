<x-app-layout>
    <div class="pt-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.dashboard') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">Manage Quizzes</h1>
        </div>

        <a href="{{ route('admin.quizzes.create') }}" class="mb-6 block text-center py-3 bg-museum-green text-white rounded-xl font-semibold hover:bg-museum-lightGreen transition-colors">
            <i class="fas fa-plus mr-2"></i> Create New Quiz
        </a>

        <div class="space-y-4">
            @foreach($quizzes as $quiz)
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <h3 class="font-bold text-museum-green text-lg">{{ $quiz->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ Str::limit($quiz->description, 50) }}</p>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full"><i class="fas fa-question-circle mr-1"></i> {{ $quiz->questions_count }} Questions</span>
                        <a href="{{ route('quiz.show', $quiz->id) }}" class="text-sm text-museum-lightGreen font-semibold hover:underline">Preview</a>
                    </div>
                </div>
            @endforeach
            @if($quizzes->isEmpty())
                <p class="text-center text-gray-500 mt-8">No quizzes created yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
