<?php

namespace Database\Factories;

use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'category' => fake()->randomElement(['Legend', 'History']),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'image' => fake()->imageUrl(640, 480, 'history'),
        ];
    }
}
