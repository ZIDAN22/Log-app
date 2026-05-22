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
            $table->string('destination_province')->nullable()->after('destination_city');
            $table->string('destination_province_code')->nullable()->after('destination_province');
            $table->string('destination_city_code')->nullable()->after('destination_province_code');
            $table->string('destination_district')->nullable()->after('destination_city_code');
            $table->string('destination_district_code')->nullable()->after('destination_district');
            $table->string('destination_village')->nullable()->after('destination_district_code');
            $table->string('destination_village_code')->nullable()->after('destination_village');
            $table->string('destination_postal_code')->nullable()->after('destination_village_code');
            $table->text('destination_address')->nullable()->after('destination_postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn([
                'destination_province',
                'destination_province_code',
                'destination_city_code',
                'destination_district',
                'destination_district_code',
                'destination_village',
                'destination_village_code',
                'destination_postal_code',
                'destination_address',
            ]);
        });
    }
};
