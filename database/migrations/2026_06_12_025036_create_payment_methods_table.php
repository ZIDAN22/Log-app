<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code')->unique();
            $table->string('method_name');
            $table->enum('method_type', [
                'BANK_TRANSFER',
                'E_WALLET',
                'CASH',
                'VIRTUAL_ACCOUNT'
            ]);

            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();


            $table->boolean('is_default')->default(false);

            $table->enum('status', [
                'ACTIVE',
                'INACTIVE'
            ])->default('ACTIVE');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};