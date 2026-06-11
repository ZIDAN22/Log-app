<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('delivery_orders') || !Schema::hasColumn('delivery_orders', 'created_by')) {
            return;
        }

        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        DB::statement('ALTER TABLE delivery_orders MODIFY created_by BIGINT UNSIGNED NULL');

        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('delivery_orders') || !Schema::hasColumn('delivery_orders', 'created_by')) {
            return;
        }

        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        DB::statement('ALTER TABLE delivery_orders MODIFY created_by BIGINT UNSIGNED NOT NULL');

        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
    }
};
