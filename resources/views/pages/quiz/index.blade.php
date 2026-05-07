<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <h1 class="font-serif text-3xl font-bold text-museum-green mb-2">Quizzes</h1>
        <p class="text-sm text-gray-500 mb-8">Test your knowledge about Singhasari Kingdom.</p>

        <div class="bg-museum-green rounded-3xl p-6 text-white mb-10 shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-10 -mt-10"></div>
            <div class="relative z-10">
                <h2 class="font-serif text-2xl font-bold mb-2">Play a Quiz</h2>
                <p class="text-xs text-white/70 mb-6 leading-relaxed">Let's test how well you know Singhasari history and legacy.</p>
                <a href="#quiz-list" class="inline-block px-6 py-2 bg-museum-brown text-white rounded-full text-xs font-bold hover:bg-opacity-90 transition-all uppercase tracking-widest shadow-md">Start Playing</a>
            </div>
        </div>

        <div id="quiz-list" class="space-y-6 mb-12">
            <h3 class="text-sm font-bold text-museum-green uppercase tracking-widest">Available Quizzes</h3>
            @php
                $quizzes = \App\Models\Quiz::where('status', 'published')->withCount('questions')->get();
            @endphp
            @forelse($quizzes as $quiz)
                <a href="{{ route('quiz.show', $quiz) }}" class="block bg-white rounded-3xl p-4 shadow-soft hover:shadow-md transition-shadow flex items-center gap-4">
                    <div class="w-20 h-20 rounded-2xl bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($quiz->image)
                            <img src="{{ asset('storage/' . $quiz->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-museum-brown/20">
                                <i class="fas fa-question-circle text-3xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-museum-green mb-1">{{ $quiz->title }}</h4>
                        <p class="text-[10px] text-gray-400 line-clamp-2 mb-2 leading-tight">{{ $quiz->description }}</p>
                        <span class="text-[10px] font-black text-museum-brown uppercase tracking-tighter bg-museum-brown/10 px-2 py-0.5 rounded">{{ $quiz->questions_count }} QUESTIONS</span>
                    </div>
                    <i class="fas fa-chevron-right text-gray-300"></i>
                </a>
            @empty
                <div class="text-center py-10 bg-white rounded-3xl shadow-sm italic text-gray-400 text-sm">
                    No quizzes available at the moment.
                </div>
            @endforelse
        </div>

        <!-- Leaderboard Section -->
        <div class="bg-museum-green rounded-3xl p-6 text-white shadow-lg mb-8">
            <h3 class="font-serif text-xl font-bold mb-6 flex items-center">
                <i class="fas fa-trophy text-museum-brown mr-3"></i> Top Scorers
            </h3>
            <div class="space-y-4">
                @php
                    $topScores = \App\Models\QuizScore::with('user')
                        ->selectRaw('user_id, MAX(score) as max_score')
                        ->whereNotNull('user_id')
                        ->groupBy('user_id')
                        ->orderByDesc('max_score')
                        ->take(5)
                        ->get();
                @endphp
                @forelse($topScores as $index => $score)
                <div class="flex items-center gap-4 bg-white/5 p-3 rounded-2xl">
                    <span class="w-6 font-serif font-bold text-lg text-museum-brown">{{ $index + 1 }}</span>
                    <div class="w-10 h-10 rounded-full bg-white/20 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($score->user->name) }}&background=8A5A3C&color=fff" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold truncate">{{ $score->user->name }}</p>
                    </div>
                    <span class="font-serif font-bold text-museum-brown text-lg">{{ $score->max_score }}</span>
                </div>
                @empty
                <p class="text-center text-xs text-white/50 italic py-4">Leaderboard is empty.</p>
                @endforelse
            </div>
        </div>

        <!-- Your History (If logged in) -->
        @auth
        <div class="mb-4">
            <h3 class="text-sm font-bold text-museum-green uppercase tracking-widest mb-4">Your Recent Attempts</h3>
            <div class="space-y-3">
                @php
                    $myScores = \App\Models\QuizScore::where('user_id', auth()->id())->with('quiz')->latest()->take(5)->get();
                @endphp
                @forelse($myScores as $score)
                <div class="bg-white rounded-2xl p-4 shadow-sm flex justify-between items-center">
                    <div>
                        <p class="text-sm font-bold text-museum-green">{{ $score->quiz->title }}</p>
                        <p class="text-[10px] text-gray-400">{{ $score->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-serif font-bold text-museum-brown text-lg">{{ $score->score }}</p>
                        <p class="text-[8px] font-bold text-gray-300 uppercase">Points</p>
                    </div>
                </div>
                @empty
                <p class="text-center text-xs text-gray-400 italic">You haven't played any quizzes yet.</p>
                @endforelse
            </div>
        </div>
        @else
        <div class="bg-museum-brown rounded-3xl p-6 text-white shadow-lg text-center">
            <p class="text-sm font-bold mb-4">Login to save your scores and see the leaderboard!</p>
            <a href="{{ route('login') }}" class="inline-block px-8 py-2 bg-white text-museum-brown rounded-full text-xs font-bold uppercase tracking-widest shadow-md">Login / Register</a>
        </div>
        @endauth
    </div>
</x-app-layout>
