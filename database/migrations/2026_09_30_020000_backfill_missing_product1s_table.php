<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')->orderBy('id')->chunk(500, function ($products) {
            $rows = $products->map(fn ($product) => [
                'id' => $product->id,
                'category_id' => $product->category_id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ])->all();

            DB::table('product1s')->insertOrIgnore($rows);
        });
    }

    public function down(): void {}
};
