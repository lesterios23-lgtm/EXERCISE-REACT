<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product1s', function (Blueprint $table) {
            if (!Schema::hasColumn('product1s', 'code')) {
                $table->string('code', 12)->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('product1s', 'cost')) {
                $table->decimal('cost', 10, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('product1s', 'inventory_quantity')) {
                $table->integer('inventory_quantity')->nullable()->after('cost');
            }
        });

        Schema::table('product1s', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('product1s', function (Blueprint $table) {
            if (Schema::hasColumn('product1s', 'code')) {
                $table->dropUnique(['code']);
                $table->dropColumn('code');
            }
            if (Schema::hasColumn('product1s', 'cost')) {
                $table->dropColumn('cost');
            }
            if (Schema::hasColumn('product1s', 'inventory_quantity')) {
                $table->dropColumn('inventory_quantity');
            }
        });

        Schema::table('product1s', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable(false)->change();
        });
    }
};
