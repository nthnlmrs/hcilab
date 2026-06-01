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
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.points' => 'required|integer|min:0',
            'questions.*.choices' => 'required|array|min:2',
            'questions.*.choices.*.text' => 'required|string',
            'questions.*.correct_choice' => 'required|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('quizzes', 'public');
        }

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        foreach ($request->questions as $qIndex => $qData) {
            $qImagePath = null;
            if (isset($qData['image_file'])) {
                $qImagePath = $qData['image_file']->store('questions', 'public');
            }

            $question = Question::create([
                'quiz_id' => $quiz->id,
                'text' => $qData['text'],
                'points' => $qData['points'],
                'image_path' => $qImagePath,
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

    public function edit(Quiz $quiz)
    {
        $quiz->load('questions.choices');
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.points' => 'required|integer|min:0',
            'questions.*.choices' => 'required|array|min:2',
            'questions.*.choices.*.text' => 'required|string',
            'questions.*.correct_choice' => 'required|integer',
        ]);

        $data = $request->only(['title', 'description', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('quizzes', 'public');
        }

        $quiz->update($data);

        // A simple way to handle updates is to delete old questions and insert new ones
        // or sync. Since there might be image uploads, let's keep the existing logic and delete old.
        // For production apps, updating existing questions/choices is better to preserve FKs like scores,
        // but quiz scores in the DB only depend on quiz_id, not question_id.
        $quiz->questions()->delete();

        foreach ($request->questions as $qIndex => $qData) {
            $qImagePath = null;
            if (isset($qData['image_file'])) {
                $qImagePath = $qData['image_file']->store('questions', 'public');
            } elseif (isset($qData['existing_image'])) {
                $qImagePath = $qData['existing_image'];
            }

            $question = Question::create([
                'quiz_id' => $quiz->id,
                'text' => $qData['text'],
                'points' => $qData['points'],
                'image_path' => $qImagePath,
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

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function toggleStatus(Quiz $quiz)
    {
        $quiz->update([
            'status' => $quiz->status === 'published' ? 'draft' : 'published'
        ]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz status updated successfully.');
    }
}
