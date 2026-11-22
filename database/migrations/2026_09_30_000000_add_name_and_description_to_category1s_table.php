<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('category1s', function (Blueprint $table) {
            if (! Schema::hasColumn('category1s', 'name')) {
                $table->string('name')->default('');
            }

            if (! Schema::hasColumn('category1s', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('category1s', function (Blueprint $table) {
            $table->dropColumn(['name', 'description']);
        });
    }
};
