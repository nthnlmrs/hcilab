<x-app-layout>
    <div class="pt-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">Quiz</h1>
        </div>

        <!-- Main Quiz Banner -->
        <div class="bg-museum-green rounded-3xl p-6 text-white mb-6 shadow-lg relative overflow-hidden">
            <!-- Decorative image in background -->
            <div class="absolute right-0 top-0 bottom-0 w-1/2 opacity-30">
                <img src="https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=300&h=200&fit=crop" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-museum-green to-transparent"></div>
            </div>
            
            <div class="relative z-10">
                <h2 class="font-serif text-3xl font-bold mb-2">Play a Quiz</h2>
                <p class="text-sm text-white/80 mb-6 max-w-[60%]">Let's test how do you know us well</p>
                
                @if($quizzes->isNotEmpty())
                    <a href="{{ route('quiz.show', $quizzes->first()->id) }}" class="inline-block px-6 py-2 border border-white rounded-full text-xs font-semibold hover:bg-white hover:text-museum-green transition-colors">Play Quiz</a>
                @else
                    <span class="inline-block px-6 py-2 border border-white/50 text-white/50 rounded-full text-xs font-semibold">No Quizzes</span>
                @endif
            </div>
        </div>

        <!-- Leaderboard Section -->
        <div class="bg-museum-green rounded-3xl p-6 mb-6 shadow-lg">
            <h2 class="font-serif text-2xl font-bold text-white mb-4 text-center">Leaderboard</h2>
            
            <table class="w-full text-white text-sm">
                <thead>
                    <tr class="border-b border-white/20">
                        <th class="text-left pb-2 font-normal">Rank</th>
                        <th class="text-left pb-2 font-normal">Name</th>
                        <th class="text-right pb-2 font-normal">Score</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaderboard as $index => $score)
                        <tr class="border-b border-white/10 last:border-0">
                            <td class="py-2">{{ $index + 1 }}</td>
                            <td class="py-2">{{ $score->user->name ?? 'Anonymous' }}</td>
                            <td class="py-2 text-right">{{ $score->score }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-white/60">No scores yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <p class="text-[10px] text-white/60 mt-4 text-center">Leaderboard shows player who played quiz past 1 year</p>
        </div>

        <!-- Your Score Section -->
        @auth
        <div class="bg-museum-green rounded-3xl p-6 shadow-lg mb-6">
            <h2 class="font-serif text-2xl font-bold text-white mb-4 text-center">Your Score</h2>
            
            <table class="w-full text-white text-sm">
                <thead>
                    <tr class="border-b border-white/20">
                        <th class="text-left pb-2 font-normal">Attempt</th>
                        <th class="text-left pb-2 font-normal">Quiz</th>
                        <th class="text-right pb-2 font-normal">Score</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($userScores as $index => $score)
                        <tr class="border-b border-white/10 last:border-0">
                            <td class="py-2">{{ $index + 1 }}</td>
                            <td class="py-2">{{ Str::limit($score->quiz->title ?? 'Unknown', 15) }}</td>
                            <td class="py-2 text-right">{{ $score->score }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-white/60">You haven't played yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <p class="text-[10px] text-white/60 mt-4 text-center">Recent attempts and score</p>
        </div>
        @endauth
        
        <!-- Other Quizzes List -->
        @if($quizzes->count() > 1)
        <div class="mb-4">
            <h3 class="font-serif text-xl font-bold text-museum-green mb-3">Other Quizzes</h3>
            <div class="space-y-3">
                @foreach($quizzes->skip(1) as $quiz)
                    <a href="{{ route('quiz.show', $quiz->id) }}" class="block bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <h4 class="font-bold text-gray-700">{{ $quiz->title }}</h4>
                            <p class="text-xs text-gray-500">{{ Str::limit($quiz->description, 40) }}</p>
                        </div>
                        <i class="fas fa-play-circle text-museum-green text-2xl"></i>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
