<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->nullOnDelete()->after('transportation_type');
            $table->string('shipping_day')->nullable()->after('pickup_date');
            $table->string('sea_shipping')->nullable()->after('vehicle_id');
            $table->string('air_shipping')->nullable()->after('sea_shipping');
            $table->date('land_departure_date')->nullable()->after('pickup_date');
            $table->date('sea_departure_date')->nullable()->after('land_departure_date');
            $table->date('air_departure_date')->nullable()->after('sea_departure_date');
        });
    }

    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropColumn([
                'vehicle_id',
                'shipping_day',
                'sea_shipping',
                'air_shipping',
                'land_departure_date',
                'sea_departure_date',
                'air_departure_date',
            ]);
        });
    }
};
