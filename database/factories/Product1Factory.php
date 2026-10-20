<?php

namespace Database\Factories;

use App\Models\Product1;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category1;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product1>
 */
class Product1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2, true);

        return [
            'category_id' => Category1::factory(),
            'name' => $name,
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
