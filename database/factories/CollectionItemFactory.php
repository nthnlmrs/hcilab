<?php

namespace Database\Factories;

use App\Models\CollectionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CollectionItem>
 */
class CollectionItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'category' => fake()->randomElement(['Arca', 'Diorama', 'Maket', 'Penggilesan', 'Topeng']),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(640, 480, 'museum'),
        ];
    }
}
