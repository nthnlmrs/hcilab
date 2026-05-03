<x-app-layout>
    <div class="pt-6 pb-20">
        <div class="flex items-center mb-6">
            <a href="{{ route('quiz.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">{{ Str::limit($quiz->title, 20) }}</h1>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm mb-6 border-t-4 border-museum-green">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $quiz->title }}</h2>
            @if($quiz->description)
                <p class="text-gray-600 text-sm mb-4">{{ $quiz->description }}</p>
            @endif
            <div class="flex items-center text-sm text-gray-500 font-semibold">
                <i class="fas fa-list-ol mr-2 text-museum-green"></i> {{ $quiz->questions->count() }} Questions
            </div>
        </div>

        <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                @foreach($quiz->questions as $index => $question)
                    <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100">
                        <div class="mb-4">
                            <span class="text-xs font-bold text-museum-green bg-museum-beige px-3 py-1 rounded-full mb-3 inline-block">Question {{ $index + 1 }}</span>
                            <h3 class="text-lg font-semibold text-gray-800 leading-tight">{{ $question->text }}</h3>
                            
                            @if($question->description)
                                <p class="text-sm text-gray-500 mt-2 italic">{{ $question->description }}</p>
                            @endif
                            
                            @if($question->image_path)
                                <img src="{{ $question->image_path }}" class="w-full h-40 object-cover rounded-xl mt-3 shadow-sm" alt="Question Image">
                            @endif
                        </div>

                        <div class="space-y-3">
                            @foreach($question->choices as $choice)
                                <label class="flex items-start p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-museum-beige has-[:checked]:border-museum-green has-[:checked]:text-museum-green">
                                    <div class="flex items-center h-5">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" required class="w-4 h-4 text-museum-green border-gray-300 focus:ring-museum-green">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <span class="font-medium">{{ $choice->text }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full py-4 bg-museum-green text-white rounded-2xl font-bold text-lg shadow-lg hover:bg-museum-lightGreen transition-colors">
                    Submit Quiz
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
