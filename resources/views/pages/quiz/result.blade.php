<x-app-layout>
    <div class="pt-10 pb-20 flex flex-col items-center justify-center min-h-[80vh]">
        <div class="bg-white rounded-3xl p-8 shadow-xl text-center w-full max-w-sm border-t-8 border-museum-green relative">
            
            <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                <div class="w-20 h-20 bg-museum-green rounded-full flex items-center justify-center border-4 border-white shadow-lg text-white">
                    <i class="fas fa-trophy text-3xl"></i>
                </div>
            </div>

            <div class="mt-10 mb-6">
                <h2 class="font-serif text-xl font-bold text-gray-700 mb-1">Quiz Completed!</h2>
                <p class="text-sm text-gray-500">{{ $quiz->title }}</p>
            </div>

            <div class="bg-museum-beige rounded-2xl p-6 mb-8 shadow-inner">
                <p class="text-xs text-gray-600 font-semibold uppercase tracking-wider mb-2">Your Score</p>
                <div class="text-5xl font-bold text-museum-green font-serif">
                    {{ $score }}
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('quiz.index') }}" class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                    Back to Quizzes
                </a>
                <a href="{{ route('home') }}" class="flex-1 py-3 bg-museum-green text-white rounded-xl font-semibold hover:bg-museum-lightGreen transition-colors">
                    Home
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
