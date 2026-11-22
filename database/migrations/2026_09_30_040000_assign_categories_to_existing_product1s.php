<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $categoryNames = [
            'Light Bulb' => 'Electrical',
            'Hammer' => 'Hardware',
            'Water Pipe' => 'Plumbing',
        ];

        foreach ($categoryNames as $productName => $categoryName) {
            $category = DB::table('category1s')->where('name', $categoryName)->first();

            if (! $category) {
                $categoryId = DB::table('category1s')->insertGetId([
                    'name' => $categoryName,
                    'description' => $categoryName.' products',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $categoryId = $category->id;
            }

            DB::table('product1s')
                ->where('name', $productName)
                ->whereNull('category_id')
                ->update(['category_id' => $categoryId]);
        }
    }

    public function down(): void {}
};
