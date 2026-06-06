@section('section_name', 'Quiz')
<x-app-layout>
    <div class="relative pt-6 pb-20 px-4 w-full min-h-screen">
        <!-- Background Statue Graphic (Mockup Style) -->
        <div class="absolute right-0 top-0 w-80 h-96 opacity-[0.25] pointer-events-none bg-cover bg-no-repeat bg-right-top select-none z-0" style="background-image: url('{{ asset('images/quiz_statue.png') }}'); mix-blend-mode: multiply;"></div>

        <div class="relative z-10">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-12 h-12 bg-white text-[#1B4A47] hover:bg-[#FAF6EE] border border-[#EADFCB]/40 rounded-full shadow-soft hover:shadow-md transition-all active:scale-95">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
            </div>

            <!-- Header Title -->
            <h1 class="font-serif text-4xl font-extrabold text-[#0F2F2E] mb-2">Quiz</h1>
            <p class="text-sm text-gray-500 mb-8 font-medium">Test your knowledge about Singhasari Kingdom.</p>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Banner -->
                    <div class="bg-[#123937] rounded-[32px] p-6 md:p-8 text-white shadow-lg relative overflow-hidden flex justify-between items-center min-h-[190px]">
                        <!-- Content Section -->
                        <div class="relative z-10 flex-1 pr-4">
                            <h2 class="font-serif text-3xl font-extrabold mb-2 text-[#FCF9F3]">Play a Quiz</h2>
                            <p class="text-xs text-[#FCF9F3]/80 mb-6 leading-relaxed font-medium">Let's test how much you know about us!</p>
                            <a href="#quiz-list" class="inline-flex items-center gap-2 px-6 py-3 bg-[#E5DCC6] text-[#1B4A47] rounded-full text-xs font-bold hover:bg-[#FAF6EE] hover:scale-105 active:scale-95 transition-all tracking-wider shadow-md transform">
                                Play Quiz
                                <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>

                        <!-- Image Illustration Section -->
                        <div class="absolute right-0 bottom-0 top-0 w-2/5 h-full hidden sm:block pointer-events-none z-10">
                            <img src="{{ asset('images/quiz_temple.png') }}" class="w-full h-full object-cover object-center select-none opacity-95">
                        </div>
                    </div>

                    <!-- Available Quizzes -->
                    <div id="quiz-list" class="space-y-6">
                        <h3 class="text-xs font-black text-[#8A5A3C] uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="inline-block w-1.5 h-3 bg-[#8A5A3C] rounded-full"></span>
                            Available Quizzes
                        </h3>
                        @php
                            $quizzes = \App\Models\Quiz::where('status', 'published')->withCount('questions')->get();
                        @endphp
                        @forelse($quizzes as $quiz)
                            <a href="{{ route('quiz.show', $quiz) }}" class="group block bg-[#FCF9F3] border border-[#EADFCB] rounded-[24px] p-5 shadow-soft hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-5">
                                <div class="w-20 h-20 rounded-2xl bg-[#EADFCB]/30 border border-[#EADFCB]/50 overflow-hidden flex-shrink-0 relative group-hover:scale-105 transition-transform duration-300 shadow-inner">
                                    @if($quiz->image)
                                        <img src="{{ asset('storage/' . $quiz->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[#8A5A3C]/40">
                                            <i class="fas fa-question text-3xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-serif text-lg font-bold text-[#1B4A47] group-hover:text-[#8A5A3C] transition-colors mb-1 truncate">{{ $quiz->title }}</h4>
                                    <p class="text-xs text-gray-500 line-clamp-2 mb-3 leading-relaxed">{{ $quiz->description }}</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[9px] font-black text-[#8A5A3C] uppercase tracking-wider bg-[#8A5A3C]/10 px-2.5 py-1 rounded-full border border-[#8A5A3C]/20 shadow-sm">{{ $quiz->questions_count }} Questions</span>
                                    </div>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-[#FAF6EE] border border-[#EADFCB] flex items-center justify-center text-[#1B4A47] group-hover:bg-[#1B4A47] group-hover:text-white group-hover:border-[#1B4A47] transition-all duration-300 shadow-sm">
                                    <i class="fas fa-chevron-right text-xs transform group-hover:translate-x-0.5 transition-transform"></i>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-16 bg-[#FCF9F3] border border-[#EADFCB] rounded-[32px] shadow-soft text-gray-400 italic text-sm">
                                <div class="w-16 h-16 mx-auto rounded-full bg-[#EADFCB]/30 flex items-center justify-center text-[#8A5A3C]/40 mb-4">
                                    <i class="fas fa-info-circle text-2xl"></i>
                                </div>
                                No quizzes available at the moment. Check back soon!
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Sidebar Area -->
                <div class="space-y-8">
                    <!-- Leaderboard Section -->
                    <div class="bg-[#FCF9F3] border border-[#EADFCB] rounded-[32px] p-6 shadow-soft transition-all hover:shadow-md relative overflow-hidden">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#EADFCB] flex items-center justify-center text-[#8A5A3C] shadow-inner">
                                    <i class="fas fa-ranking-star text-base"></i>
                                </div>
                                <h3 class="font-serif text-xl font-extrabold text-[#1B4A47]">Leaderboard</h3>
                            </div>
                            <a href="#quiz-list" class="px-4 py-1.5 bg-[#FAF6EE] border border-[#EADFCB] hover:bg-[#EADFCB] text-[#1B4A47] hover:text-white rounded-full text-xs font-bold transition-all duration-200">
                                View All <i class="fas fa-chevron-right text-[8px] ml-1"></i>
                            </a>
                        </div>

                        @php
                            $topScores = \App\Models\QuizScore::with('user')
                                ->selectRaw('user_id, MAX(score) as max_score')
                                ->whereNotNull('user_id')
                                ->groupBy('user_id')
                                ->orderByDesc('max_score')
                                ->take(5)
                                ->get();
                        @endphp

                        <!-- Table Header -->
                        <div class="flex items-center bg-[#1B4A47] text-[#FCF9F3] rounded-full py-2.5 px-5 text-[11px] font-bold uppercase tracking-wider mb-3 shadow-sm">
                            <span class="w-12 text-left">Rank</span>
                            <span class="flex-1 text-left">Name</span>
                            <span class="w-20 text-right">Score</span>
                        </div>

                        <!-- Table Rows -->
                        <div class="space-y-1">
                            @forelse($topScores as $index => $score)
                                <div class="flex items-center py-3 px-5 border-b border-[#EADFCB]/30 last:border-b-0 hover:bg-[#FAF6EE]/50 rounded-2xl transition-colors">
                                    <!-- Rank Medal -->
                                    <div class="w-12 flex justify-start">
                                        @if($index === 0)
                                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#F5D76E] to-[#F39C12] text-white flex items-center justify-center font-extrabold text-xs shadow-md border-2 border-white relative" title="Gold Medal">1</span>
                                        @elseif($index === 1)
                                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#E2E8F0] to-[#94A3B8] text-white flex items-center justify-center font-extrabold text-xs shadow-md border-2 border-white relative" title="Silver Medal">2</span>
                                        @elseif($index === 2)
                                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#FDBA74] to-[#C2410C] text-white flex items-center justify-center font-extrabold text-xs shadow-md border-2 border-white relative" title="Bronze Medal">3</span>
                                        @else
                                            <span class="w-7 h-7 rounded-full bg-[#ECE9E2] text-[#8A5A3C] flex items-center justify-center font-bold text-xs border border-[#D5C6B1]" title="Rank {{ $index + 1 }}">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- User Name -->
                                    <div class="flex-1 min-w-0 pr-4">
                                        <p class="text-sm font-bold text-[#0F2F2E] truncate">{{ $score->user->name }}</p>
                                    </div>

                                    <!-- Score -->
                                    <div class="w-20 text-right">
                                        <span class="font-serif font-extrabold text-[#1B4A47] text-base">{{ $score->max_score }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-xs text-gray-400 italic">Leaderboard is empty.</div>
                            @endforelse
                        </div>

                        <!-- Footer Info -->
                        <div class="mt-4 pt-4 border-t border-[#EADFCB]/30 flex items-center text-[10px] text-[#8A5A3C] font-medium">
                            <i class="fas fa-users-line text-xs mr-2 text-[#8A5A3C]/70"></i>
                            <span>Leaderboard shows player who played quiz past 1 year.</span>
                        </div>
                    </div>

                    <!-- Your History (If logged in) -->
                    @auth
                    <div class="bg-[#FCF9F3] border border-[#EADFCB] rounded-[32px] p-6 shadow-soft transition-all hover:shadow-md relative overflow-hidden">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#EADFCB] flex items-center justify-center text-[#8A5A3C] shadow-inner">
                                    <i class="fas fa-chart-line text-lg"></i>
                                </div>
                                <h3 class="font-serif text-xl font-extrabold text-[#1B4A47]">Your Score</h3>
                            </div>
                            <a href="#quiz-list" class="px-4 py-1.5 bg-[#FAF6EE] border border-[#EADFCB] hover:bg-[#EADFCB] text-[#1B4A47] hover:text-white rounded-full text-xs font-bold transition-all duration-200">
                                View All <i class="fas fa-chevron-right text-[8px] ml-1"></i>
                            </a>
                        </div>

                        @php
                            $myScores = \App\Models\QuizScore::where('user_id', auth()->id())->with('quiz')->latest()->take(5)->get();
                        @endphp

                        <!-- Table Header -->
                        <div class="flex items-center bg-[#1B4A47] text-[#FCF9F3] rounded-full py-2.5 px-5 text-[11px] font-bold uppercase tracking-wider mb-3 shadow-sm">
                            <span class="w-12 text-left">Rank</span>
                            <span class="flex-1 text-left">Quiz</span>
                            <span class="w-20 text-right">Score</span>
                        </div>

                        <!-- Table Rows -->
                        <div class="space-y-1">
                            @forelse($myScores as $index => $score)
                                <div class="flex items-center py-3 px-5 border-b border-[#EADFCB]/30 last:border-b-0 hover:bg-[#FAF6EE]/50 rounded-2xl transition-colors">
                                    <!-- Index -->
                                    <div class="w-12 flex justify-start">
                                        <span class="w-7 h-7 rounded-full bg-[#ECE9E2] text-[#8A5A3C] flex items-center justify-center font-bold text-xs border border-[#D5C6B1]" title="Attempt {{ $index + 1 }}">{{ $index + 1 }}</span>
                                    </div>
                                    
                                    <!-- Quiz Name & Date -->
                                    <div class="flex-1 min-w-0 pr-4">
                                        <p class="text-sm font-bold text-[#0F2F2E] truncate leading-snug">{{ $score->quiz->title }}</p>
                                        <p class="text-[9px] text-gray-400 font-semibold">{{ $score->created_at->format('d M Y, H:i') }}</p>
                                    </div>

                                    <!-- Score -->
                                    <div class="w-20 text-right">
                                        <span class="font-serif font-extrabold text-[#1B4A47] text-base">{{ $score->score }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-xs text-gray-400 italic">You haven't played any quizzes yet.</div>
                            @endforelse
                        </div>

                        <!-- Footer Info -->
                        <div class="mt-4 pt-4 border-t border-[#EADFCB]/30 flex items-center text-[10px] text-[#8A5A3C] font-medium">
                            <i class="far fa-clock text-xs mr-2 text-[#8A5A3C]/70"></i>
                            <span>Recent attempts and score</span>
                        </div>
                    </div>
                    @else
                    <div class="bg-[#FCF9F3] border border-[#EADFCB] rounded-[32px] p-6 shadow-soft text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-[#EADFCB]/50 flex items-center justify-center text-[#8A5A3C] mb-4 shadow-inner">
                            <i class="fas fa-lock text-2xl"></i>
                        </div>
                        <h3 class="font-serif text-lg font-bold text-[#1B4A47] mb-2">Want to track your progress?</h3>
                        <p class="text-xs text-gray-500 mb-6 leading-relaxed">Login to save your scores, track your attempts, and compete with other players on the leaderboard!</p>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-[#8A5A3C] text-white hover:bg-[#734A31] rounded-full text-xs font-bold uppercase tracking-widest shadow-md transition-all">
                            Login / Register
                            <i class="fas fa-sign-in-alt text-[10px]"></i>
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
