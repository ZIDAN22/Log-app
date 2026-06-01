<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('shipments') || !Schema::hasColumn('shipments', 'created_by')) {
            return;
        }

        Schema::table('shipments', function (Blueprint $table) {
            if (Schema::hasColumn('shipments', 'created_by')) {
                $table->dropForeign(['created_by']);
            }
        });

        DB::statement('ALTER TABLE shipments MODIFY created_by BIGINT UNSIGNED NULL');

        Schema::table('shipments', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('shipments') || !Schema::hasColumn('shipments', 'created_by')) {
            return;
        }

        Schema::table('shipments', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        DB::statement('ALTER TABLE shipments MODIFY created_by BIGINT UNSIGNED NOT NULL');

        Schema::table('shipments', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
    }
};
