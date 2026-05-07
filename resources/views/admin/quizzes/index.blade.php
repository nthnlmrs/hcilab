<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="font-serif text-2xl font-bold text-museum-green">Quizzes</h1>
            <a href="{{ route('admin.quizzes.create') }}" class="px-4 py-2 bg-museum-green text-white rounded-full text-xs font-bold hover:bg-museum-darkGreen transition-colors">
                <i class="fas fa-plus mr-1"></i> ADD QUIZ
            </a>
        </div>

        <div class="space-y-4">
            @forelse($quizzes as $quiz)
                <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center gap-4">
                    <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($quiz->image)
                            <img src="{{ asset('storage/' . $quiz->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-question-circle"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-0.5">
                            <h3 class="font-bold text-museum-green text-sm">{{ $quiz->title }}</h3>
                            <span class="text-[8px] font-bold px-1.5 py-0.5 rounded-full {{ $quiz->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ strtoupper($quiz->status) }}
                            </span>
                        </div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">{{ $quiz->questions_count }} Questions</p>
                    </div>
                    <div class="flex gap-3">
                         <button class="text-gray-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                    <p class="text-gray-400 text-sm">No quizzes created yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
