<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.choices' => 'required|array|min:2',
            'questions.*.choices.*.text' => 'required|string',
            'questions.*.correct_choice' => 'required|integer',
        ]);

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        foreach ($request->questions as $qIndex => $qData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'text' => $qData['text'],
                'image_path' => $qData['image'] ?? null,
                'description' => $qData['desc'] ?? null,
            ]);

            foreach ($qData['choices'] as $cIndex => $cData) {
                Choice::create([
                    'question_id' => $question->id,
                    'text' => $cData['text'],
                    'is_correct' => ($cIndex == $qData['correct_choice']),
                ]);
            }
        }

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully.');
    }
}
