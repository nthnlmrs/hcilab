<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizScore;
use App\Models\Choice;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return view('pages.quiz.index');
    }

    public function show(Quiz $quiz)
    {
        if ($quiz->status !== 'published') {
            abort(404);
        }
        $quiz->load('questions.choices');
        return view('pages.quiz.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $score = 0;
        $totalPoints = 0;

        $choices = Choice::whereIn('id', $request->answers ?? [])->get()->keyBy('id');

        foreach ($quiz->questions as $question) {
            $totalPoints += $question->points;
            $userChoiceId = $request->answers[$question->id] ?? null;

            if ($userChoiceId) {
                $choice = $choices->get($userChoiceId);
                if ($choice && $choice->is_correct) {
                    $score += $question->points;
                }
            }
        }

        QuizScore::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
            'score' => $score,
        ]);

        return redirect()->route('quiz.result', [$quiz, $score]);
    }

    public function result(Quiz $quiz, $score)
    {
        return view('pages.quiz.result', compact('quiz', 'score'));
    }
}
