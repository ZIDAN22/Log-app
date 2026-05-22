<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_list_id')->unique()->constrained('packing_lists')->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->string('receipt_number');
            $table->date('invoice_date');
            $table->string('customer_name');
            $table->string('transportation_type')->nullable();
            $table->string('payment_status');
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->integer('total_qty')->default(0);
            $table->decimal('total_weight', 16, 2)->default(0);
            $table->decimal('total_value', 18, 2)->default(0);
            $table->decimal('delivery_fee', 18, 2)->default(0);
            $table->decimal('ppn_amount', 18, 2)->default(0);
            $table->decimal('pph_amount', 18, 2)->default(0);
            $table->decimal('grand_total', 18, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
