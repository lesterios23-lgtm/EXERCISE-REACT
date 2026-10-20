<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'description' => $this->faker->sentence(),
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(8)),
            'category' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'quantity' => $this->faker->numberBetween(1, 100),
            'status' => 'Available',
        ];
    }
}
