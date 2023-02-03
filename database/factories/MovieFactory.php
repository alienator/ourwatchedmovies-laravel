<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'      => fake()->uuid(),
            'title'   => fake()->text(100),
            'summary' => fake()->text(),
            'releaseDate' => fake()->date(),
            'imagePath' => fake()->image(),
            'globalScore' => fake()->randomFloat(2, 0, 10),
            'moreInfo' => fake()->url(),
            'watchedDate' => fake()->date(),
            'ourScore' => fake()->numberBetween(0, 10)
        ];
    }
}
