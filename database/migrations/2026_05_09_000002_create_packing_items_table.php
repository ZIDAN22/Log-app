<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_list_id')->constrained('packing_lists')->onDelete('cascade');
            $table->string('item_name', 255);
            $table->integer('qty')->default(0);
            $table->string('packaging_type', 100);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('subtotal_price', 15, 2)->default(0);
            $table->decimal('weight', 10, 2)->default(0);
            $table->text('item_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_items');
    }
};
