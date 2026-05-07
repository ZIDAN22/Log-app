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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('receipt_number')->unique();
            $table->unsignedBigInteger('customer_sender_id')->nullable();
            $table->unsignedBigInteger('customer_receiver_id')->nullable();
            $table->string('sender_name');
            $table->string('receiver_name');
            $table->text('pickup_address');
            $table->string('destination_city');
            $table->string('item_type');
            $table->decimal('total_weight', 10, 2);
            $table->decimal('price_per_kg', 10, 2);
            $table->decimal('subtotal', 15, 2);
            $table->decimal('ppn', 15, 2);
            $table->decimal('pph', 15, 2);
            $table->decimal('grand_total', 15, 2);
            $table->enum('transportation_type', ['darat', 'laut', 'udara']);
            $table->date('pickup_date');
            $table->string('shipment_status')->default('Pending Pickup');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
