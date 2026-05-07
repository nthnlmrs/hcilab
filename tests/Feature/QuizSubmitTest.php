<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use App\Models\User;

class QuizSubmitTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_submit_quiz_and_score_is_saved()
    {
        $quiz = Quiz::create(['title' => 'Test Quiz', 'status' => 'published']);
        $question = Question::create(['quiz_id' => $quiz->id, 'text' => 'Q1', 'points' => 10]);
        $choiceCorrect = Choice::create(['question_id' => $question->id, 'text' => 'Correct', 'is_correct' => true]);
        $choiceWrong = Choice::create(['question_id' => $question->id, 'text' => 'Wrong', 'is_correct' => false]);

        $response = $this->post("/quiz/{$quiz->id}", [
            'answers' => [
                $question->id => $choiceCorrect->id,
            ]
        ]);

        $response->assertRedirect("/quiz/{$quiz->id}/result/10");

        $this->assertDatabaseHas('quiz_scores', [
            'quiz_id' => $quiz->id,
            'user_id' => null,
            'score' => 10,
        ]);
    }
}
