<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\orderProducts;
use App\Models\Product1;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<orderProducts>
 */
class OrderProductsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product1::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
