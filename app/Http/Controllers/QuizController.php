<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use App\Models\QuizScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        
        // Get leaderboard (top 5 scores overall)
        $leaderboard = QuizScore::with(['user', 'quiz'])
            ->orderByDesc('score')
            ->take(5)
            ->get();
            
        // Get user's recent scores
        $userScores = auth()->check() 
            ? QuizScore::with('quiz')
                ->where('user_id', auth()->id())
                ->orderByDesc('created_at')
                ->take(5)
                ->get()
            : collect();

        return view('pages.quiz.index', compact('quizzes', 'leaderboard', 'userScores'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.choices');
        return view('pages.quiz.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $answers = $request->input('answers', []);
        $score = 0;
        $totalQuestions = $quiz->questions()->count();

        foreach ($answers as $questionId => $choiceId) {
            $isCorrect = Choice::where('id', $choiceId)
                ->where('question_id', $questionId)
                ->value('is_correct');
                
            if ($isCorrect) {
                $score++;
            }
        }

        // Calculate a score out of 10000 to look like the screenshot (e.g. 6767)
        $finalScore = $totalQuestions > 0 ? round(($score / $totalQuestions) * 10000) : 0;

        if (auth()->check()) {
            QuizScore::create([
                'user_id' => auth()->id(),
                'quiz_id' => $quiz->id,
                'score' => $finalScore,
            ]);
        }

        return redirect()->route('quiz.result', ['quiz' => $quiz->id, 'score' => $finalScore]);
    }
    
    public function result(Quiz $quiz, $score)
    {
        return view('pages.quiz.result', compact('quiz', 'score'));
    }
}
