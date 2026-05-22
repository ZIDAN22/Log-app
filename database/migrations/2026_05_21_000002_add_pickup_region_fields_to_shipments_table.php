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
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('pickup_province')->nullable()->after('pickup_address');
            $table->string('pickup_province_code')->nullable()->after('pickup_province');
            $table->string('pickup_city_code')->nullable()->after('pickup_province_code');
            $table->string('pickup_district')->nullable()->after('pickup_city_code');
            $table->string('pickup_district_code')->nullable()->after('pickup_district');
            $table->string('pickup_village')->nullable()->after('pickup_district_code');
            $table->string('pickup_village_code')->nullable()->after('pickup_village');
            $table->string('pickup_postal_code')->nullable()->after('pickup_village_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn([
                'pickup_province',
                'pickup_province_code',
                'pickup_city_code',
                'pickup_district',
                'pickup_district_code',
                'pickup_village',
                'pickup_village_code',
                'pickup_postal_code',
            ]);
        });
    }
};
