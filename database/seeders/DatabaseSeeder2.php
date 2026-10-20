<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category1;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product1;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category1::all();
        if ($categories->isEmpty()) {
            $categories = Category1::factory(5)->create();
        }

        $products = Product1::factory(2000)->recycle($categories)->create();
        $users = User::factory(20)->create();

        $users->each(function (User $user) {
            Address::factory(rand(1, 2))->for($user)->create();
        });

        $orders = $users->flatMap(function (User $user) {
            return Order::factory(rand(0, 5))->for($user)->create();
        });

        $orders->each(function (Order $order) use ($products) {
            foreach ($products->random(rand(1, 4)) as $product) {
                OrderProduct::factory()->for($order)->for($product)->create();
            }
        });

        $products->each(function (Product1 $product) use ($users) {
            foreach ($users->random(rand(0, 8)) as $user) {
                Review::factory()->for($user)->for($product)->create();
            }
        });
    }
}
