<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_managements', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_number')->unique(); // DLV-2026-0001
            $table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade');
            $table->foreignId('outbound_id')->nullable()->constrained('outbounds')->onDelete('set null');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('set null');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            $table->string('delivery_method')->default('DARAT'); // DARAT, LAUT, UDARA
            $table->string('delivery_status')->default('ready_to_ship'); // ready_to_ship, picked_up, in_transit, arrived_destination, delivered, completed
            $table->string('pod_status')->default('pending'); // pending, uploaded, verified
            $table->dateTime('picked_up_at')->nullable();
            $table->dateTime('arrived_at_destination_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->string('receiver_name')->nullable();
            $table->text('receiver_signature')->nullable(); // path ke file signature
            $table->text('receiver_photo')->nullable(); // path ke foto bukti
            $table->text('delivery_notes')->nullable();
            $table->dateTime('eta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_managements');
    }
};
