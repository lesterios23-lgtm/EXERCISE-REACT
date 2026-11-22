<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // The order_products table is created by the earlier migration.
    }

    public function down(): void
    {
        // The earlier migration owns the order_products table.
    }
};
