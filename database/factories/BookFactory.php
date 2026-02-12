<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 20);
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'category' => fake()->word(),
            'isbn' => fake()->unique()->isbn13(),
            'language' => fake()->languageCode(),
            'quantity' => $quantity,
            'available_qty' => $quantity,
        ];
    }
}
