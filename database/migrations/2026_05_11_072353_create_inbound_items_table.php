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
        Schema::create('inbound_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbound_id')->constrained('inbounds')->onDelete('cascade');
            $table->string('item_name', 255);
            $table->integer('qty')->default(0);
            $table->string('packaging_type', 100);
            $table->integer('total_packaging')->default(1);
            $table->decimal('weight', 10, 2)->default(0);
            $table->text('item_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbound_items');
    }
};
