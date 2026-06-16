<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['manager', 'admin_operasional', 'warehouse', 'finance'])
                ->default('admin_operasional')
                ->after('email');
            $table->enum('status', ['active', 'inactive'])
                ->default('active')
                ->after('role');
            $table->string('phone')->nullable()->after('status');
            $table->timestamp('last_login')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'phone', 'last_login']);
        });
    }
};
