<x-app-layout>
    <div class="pt-10 pb-20 px-4 max-w-2xl mx-auto min-h-screen flex flex-col items-center justify-center text-center">
        <div class="mb-8 relative">
             <div class="w-32 h-32 rounded-full bg-museum-green flex items-center justify-center text-white text-5xl font-serif font-bold shadow-2xl animate-bounce">
                {{ $score }}
             </div>
             <div class="absolute -top-2 -right-2 bg-museum-brown text-white text-[10px] font-black px-2 py-1 rounded-full shadow-md">
                SCORE
             </div>
        </div>

        <h1 class="font-serif text-3xl font-bold text-museum-green mb-2">Well Done!</h1>
        <p class="text-gray-500 mb-10 max-w-xs">You've completed the <span class="font-bold text-museum-green">{{ $quiz->title }}</span>. Great effort in exploring Singhasari history!</p>

        @auth
            <div class="bg-green-50 border border-green-100 rounded-2xl p-4 mb-10 w-full max-w-sm">
                <p class="text-xs font-bold text-green-700 flex items-center justify-center gap-2">
                    <i class="fas fa-check-circle"></i> YOUR SCORE HAS BEEN SAVED TO YOUR PROFILE
                </p>
            </div>
        @else
            <div class="bg-museum-brown rounded-3xl p-6 text-white shadow-lg mb-10 w-full max-w-sm">
                <p class="text-sm font-bold mb-4">Login to save your results and see where you rank!</p>
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="flex-1 py-2 bg-white text-museum-brown rounded-full text-xs font-bold uppercase tracking-widest shadow-md">Login</a>
                    <a href="{{ route('register') }}" class="flex-1 py-2 border border-white text-white rounded-full text-xs font-bold uppercase tracking-widest">Register</a>
                </div>
            </div>
        @endauth

        <div class="space-y-3 w-full max-w-sm">
            <a href="{{ route('quiz.index') }}" class="block w-full py-4 bg-museum-green text-white rounded-2xl font-bold shadow-lg hover:bg-museum-darkGreen transition-all">
                PLAY ANOTHER QUIZ
            </a>
            <a href="{{ route('home') }}" class="block w-full py-4 bg-white text-museum-green border border-gray-100 rounded-2xl font-bold shadow-sm hover:bg-gray-50 transition-all">
                BACK TO HOME
            </a>
        </div>
    </div>
</x-app-layout>
