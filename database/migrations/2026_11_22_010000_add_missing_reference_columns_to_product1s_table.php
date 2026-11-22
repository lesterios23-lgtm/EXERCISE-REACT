<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product1s', function (Blueprint $table) {
            if (!Schema::hasColumn('product1s', 'manufacturer')) {
                $table->string('manufacturer', 100)->nullable()->after('description');
            }
            if (!Schema::hasColumn('product1s', 'photo')) {
                $table->string('photo', 1000)->nullable()->after('manufacturer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product1s', function (Blueprint $table) {
            if (Schema::hasColumn('product1s', 'photo')) {
                $table->dropColumn('photo');
            }
            if (Schema::hasColumn('product1s', 'manufacturer')) {
                $table->dropColumn('manufacturer');
            }
        });
    }
};
