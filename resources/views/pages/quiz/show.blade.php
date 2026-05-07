<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto min-h-screen flex flex-col">
        <div class="flex items-center mb-6">
            <a href="{{ route('quiz.index') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-xl font-bold text-museum-green">{{ $quiz->title }}</h1>
        </div>

        <form action="{{ route('quiz.submit', $quiz) }}" method="POST" id="quiz-form" class="flex-1 flex flex-col">
            @csrf
            
            <div id="questions-wrapper" class="flex-1">
                @foreach($quiz->questions as $index => $question)
                <div class="question-step {{ $index === 0 ? '' : 'hidden' }}" data-index="{{ $index }}">
                    <div class="mb-4">
                        <span class="text-[10px] font-black text-museum-brown uppercase tracking-widest bg-museum-brown/10 px-2 py-0.5 rounded">Question {{ $index + 1 }} of {{ $quiz->questions->count() }}</span>
                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-soft mb-6">
                        @if($question->image_path)
                            <img src="{{ asset('storage/' . $question->image_path) }}" class="w-full h-48 object-cover rounded-2xl mb-6 shadow-md">
                        @endif

                        <h2 class="font-serif text-xl font-bold text-museum-green mb-4 leading-tight">{{ $question->text }}</h2>

                        @if($question->description)
                            <p class="text-sm text-gray-500 mb-6 italic">{{ $question->description }}</p>
                        @endif

                        <div class="space-y-3">
                            @foreach($question->choices as $choice)
                            <label class="flex items-center gap-4 p-4 rounded-2xl border-2 border-gray-50 hover:border-museum-brown/30 transition-all cursor-pointer group has-[:checked]:border-museum-brown has-[:checked]:bg-museum-brown/5">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" required class="text-museum-brown focus:ring-museum-brown">
                                <span class="text-sm font-bold text-gray-600 group-has-[:checked]:text-museum-green">{{ $choice->text }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="button" id="prev-btn" class="px-6 py-3 text-sm font-bold text-gray-400 invisible transition-all">
                    <i class="fas fa-arrow-left mr-2"></i> PREV
                </button>

                <button type="button" id="next-btn" class="px-8 py-3 bg-museum-green text-white rounded-2xl font-bold shadow-lg hover:bg-museum-darkGreen transition-all active:scale-95">
                    NEXT <i class="fas fa-arrow-right ml-2"></i>
                </button>

                <button type="submit" id="submit-btn" class="hidden px-8 py-3 bg-museum-brown text-white rounded-2xl font-bold shadow-lg hover:bg-opacity-90 transition-all active:scale-95">
                    SUBMIT <i class="fas fa-check-circle ml-2"></i>
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.question-step');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            let currentStep = 0;

            function updateButtons() {
                if (currentStep === 0) {
                    prevBtn.classList.add('invisible');
                } else {
                    prevBtn.classList.remove('invisible');
                }

                if (currentStep === steps.length - 1) {
                    nextBtn.classList.add('hidden');
                    submitBtn.classList.remove('hidden');
                } else {
                    nextBtn.classList.remove('hidden');
                    submitBtn.classList.add('hidden');
                }
            }

            nextBtn.addEventListener('click', function() {
                const currentQuestion = steps[currentStep];
                const selected = currentQuestion.querySelector('input[type="radio"]:checked');

                if (!selected) {
                    alert('Please select an answer!');
                    return;
                }

                steps[currentStep].classList.add('hidden');
                currentStep++;
                steps[currentStep].classList.remove('hidden');
                updateButtons();
            });

            prevBtn.addEventListener('click', function() {
                steps[currentStep].classList.add('hidden');
                currentStep--;
                steps[currentStep].classList.remove('hidden');
                updateButtons();
            });
        });
    </script>
</x-app-layout>
