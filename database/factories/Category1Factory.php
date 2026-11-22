<?php

namespace Database\Factories;

use App\Models\Category1;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category1>
 */
class Category1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
