@section('section_name', 'Quiz')
<x-app-layout>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>

    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto min-h-screen flex flex-col justify-between">
        <!-- Top Nav & Timer Row -->
        <div class="flex items-center justify-between mb-6">
            <!-- Back Button -->
            <a href="{{ route('quiz.index') }}" class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#1B4A47] hover:bg-[#FAF6EE] border border-[#EADFCB]/40 shadow-soft hover:shadow-md transition-all active:scale-95 select-none">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            
            <!-- Timer -->
            <div class="border border-[#C6A57B] bg-white flex gap-2 items-center justify-center px-4 py-2.5 rounded-2xl shadow-sm">
                <i class="far fa-clock text-[#1B4A47] text-sm"></i>
                <span id="timer-display" class="font-bold text-[#0F2F2E] text-xs tracking-wider">00:00</span>
            </div>
        </div>

        <!-- Quiz Form -->
        <form action="{{ route('quiz.submit', $quiz) }}" method="POST" id="quiz-form" class="flex-1 flex flex-col justify-between">
            @csrf

            <!-- Progress Indicator Section -->
            <div class="mb-6">
                <div class="flex items-center justify-between text-xs font-semibold text-gray-500 mb-2">
                    <p class="tracking-wide">Pertanyaan <span class="font-bold text-[#1B4A47] text-sm" id="progress-current">1</span> dari <span class="font-bold text-[#0F2F2E]">{{ $quiz->questions->count() }}</span></p>
                    <span class="text-[#8A5A3C] font-black" id="progress-percent">0%</span>
                </div>
                <div class="w-full bg-[#EADFCB]/30 h-2.5 rounded-full overflow-hidden shadow-inner">
                    <div id="progress-bar" class="bg-[#1B4A47] h-full rounded-full transition-all duration-300 shadow-sm" style="width: 0%;"></div>
                </div>
            </div>
            
            <!-- Questions Wrapper -->
            <div id="questions-wrapper" class="flex-1 flex flex-col justify-center">
                @foreach($quiz->questions as $index => $question)
                <div class="question-step {{ $index === 0 ? '' : 'hidden' }} space-y-6 animate-fade-in" data-index="{{ $index }}">
                    <!-- Question Card -->
                    <div class="bg-white border border-[#B4853E]/20 drop-shadow-[0_4px_10px_rgba(0,0,0,0.03)] rounded-[32px] px-5 py-6 md:p-8 relative overflow-hidden">
                        <!-- Subtitle Badge -->
                        <div class="text-center mb-4">
                            <span class="text-[10px] font-black text-[#B4853E] uppercase tracking-widest bg-[#B4853E]/10 px-3 py-1 rounded-full border border-[#B4853E]/20">PERTANYAAN</span>
                        </div>
                        
                        <!-- Question Text -->
                        <h2 class="font-serif text-xl md:text-2xl font-bold text-[#1B4A47] text-center mb-6 leading-snug">{{ $question->text }}</h2>
                        
                        <!-- Question Image (If available) -->
                        @if($question->image_path)
                            <div class="w-full h-48 md:h-64 rounded-2xl overflow-hidden mb-6 border border-gray-100/50 shadow-inner">
                                <img src="{{ asset('storage/' . $question->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <!-- Choice Options -->
                        <div class="space-y-3">
                            @foreach($question->choices as $choice)
                                <label class="flex items-center gap-4 px-4 py-4 rounded-[14px] bg-white border border-[#EADFCB] hover:border-[#8A5A3C] hover:bg-[#FAF6EE]/30 transition-all cursor-pointer group has-[:checked]:border-[#1B4A47] has-[:checked]:bg-[#1B4A47]/5">
                                    <div class="relative flex-shrink-0 w-5 h-5 rounded-full border border-[#8A5A3C]/70 group-hover:border-[#8A5A3C] flex items-center justify-center group-has-[:checked]:border-[#1B4A47] group-has-[:checked]:bg-white transition-all">
                                        <div class="w-2.5 h-2.5 rounded-full bg-transparent group-has-[:checked]:bg-[#1B4A47] transition-all"></div>
                                    </div>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" required class="sr-only">
                                    <span class="text-sm font-bold text-[#0F2F2E] group-has-[:checked]:text-[#1B4A47] transition-colors leading-snug">{{ $choice->text }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Did You Know Card -->
                    @if($question->description)
                    <div class="bg-[#ECE9E2]/40 border border-[#EADFCB]/30 drop-shadow-[0_2px_4px_rgba(0,0,0,0.01)] rounded-[20px] p-4 transition-all">
                        <div class="flex gap-3 items-start">
                            <div class="bg-[#1B4A47] w-8 h-8 rounded-[12px] flex items-center justify-center text-white flex-shrink-0 shadow-sm">
                                <i class="fas fa-info text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-[#1B4A47] text-xs uppercase tracking-wider mb-0.5">Did You Know?</p>
                                <p class="text-[11px] text-gray-500 leading-relaxed font-medium">{{ $question->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Navigation Buttons Row -->
            <div class="flex items-center justify-between gap-4 mt-6">
                <!-- Sebelumnya (Prev) -->
                <button type="button" id="prev-btn" class="flex items-center justify-center gap-2 px-6 py-3.5 border border-[#606060] hover:border-[#1B4A47] text-[#606060] hover:text-[#1B4A47] rounded-full text-xs font-bold transition-all w-1/2 select-none shadow-sm hover:bg-white/50 active:scale-95 invisible">
                    <i class="fas fa-chevron-left text-[10px]"></i>
                    Sebelumnya
                </button>
                
                <!-- Selanjutnya (Next) -->
                <button type="button" id="next-btn" class="flex items-center justify-center gap-2 px-6 py-3.5 bg-[#1B4A47] hover:bg-[#123937] text-white rounded-full text-xs font-bold transition-all w-1/2 select-none shadow-md hover:shadow-lg active:scale-95">
                    Selanjutnya
                    <i class="fas fa-chevron-right text-[10px]"></i>
                </button>
                
                <!-- Kirim (Submit) -->
                <button type="submit" id="submit-btn" class="hidden flex items-center justify-center gap-2 px-6 py-3.5 bg-[#8A5A3C] hover:bg-[#734A31] text-white rounded-full text-xs font-bold transition-all w-1/2 select-none shadow-md hover:shadow-lg active:scale-95">
                    Kirim Jawaban
                    <i class="fas fa-check-circle text-[10px]"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Scripting for Timer & Navigation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.question-step');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            const progressCurrent = document.getElementById('progress-current');
            const progressPercent = document.getElementById('progress-percent');
            const progressBar = document.getElementById('progress-bar');
            let currentStep = 0;

            // Timer Initialization
            let timeSpent = 0;
            const timerInterval = setInterval(() => {
                timeSpent++;
                const minutes = Math.floor(timeSpent / 60).toString().padStart(2, '0');
                const seconds = (timeSpent % 60).toString().padStart(2, '0');
                document.getElementById('timer-display').textContent = `${minutes}:${seconds}`;
            }, 1000);

            // Stop timer on form submit
            document.getElementById('quiz-form').addEventListener('submit', function() {
                clearInterval(timerInterval);
            });

            function updateProgress() {
                const total = steps.length;
                const current = currentStep + 1;
                const percent = Math.round((current / total) * 100);

                progressCurrent.textContent = current;
                progressPercent.textContent = percent + '%';
                progressBar.style.width = percent + '%';
            }

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

            // Initialize views
            updateProgress();
            updateButtons();

            nextBtn.addEventListener('click', function() {
                const currentQuestion = steps[currentStep];
                const selected = currentQuestion.querySelector('input[type="radio"]:checked');

                if (!selected) {
                    alert('Silakan pilih salah satu jawaban!');
                    return;
                }

                steps[currentStep].classList.add('hidden');
                currentStep++;
                steps[currentStep].classList.remove('hidden');
                updateProgress();
                updateButtons();
            });

            prevBtn.addEventListener('click', function() {
                steps[currentStep].classList.add('hidden');
                currentStep--;
                steps[currentStep].classList.remove('hidden');
                updateProgress();
                updateButtons();
            });
        });
    </script>
</x-app-layout>
