<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            // Add actual_weight column if it doesn't exist
            if (!Schema::hasColumn('shipments', 'actual_weight')) {
                $table->decimal('actual_weight', 10, 2)->nullable()->after('item_type');
            }
            
            // Add jenis layanan (PTP/DTD)
            if (!Schema::hasColumn('shipments', 'service_type')) {
                $table->enum('service_type', ['PTP', 'DTD'])->nullable()->after('transportation_type');
            }
            
            // Add volumetric fields
            if (!Schema::hasColumn('shipments', 'use_volumetric')) {
                $table->boolean('use_volumetric')->default(false)->after('service_type');
            }
            if (!Schema::hasColumn('shipments', 'length_cm')) {
                $table->decimal('length_cm', 8, 2)->nullable()->after('use_volumetric');
            }
            if (!Schema::hasColumn('shipments', 'width_cm')) {
                $table->decimal('width_cm', 8, 2)->nullable()->after('length_cm');
            }
            if (!Schema::hasColumn('shipments', 'height_cm')) {
                $table->decimal('height_cm', 8, 2)->nullable()->after('width_cm');
            }
            if (!Schema::hasColumn('shipments', 'volumetric_weight')) {
                $table->decimal('volumetric_weight', 10, 2)->nullable()->after('height_cm');
            }
            if (!Schema::hasColumn('shipments', 'chargeable_weight')) {
                $table->decimal('chargeable_weight', 10, 2)->nullable()->after('volumetric_weight');
            }
            
            // Add surcharge fields
            if (!Schema::hasColumn('shipments', 'surcharge_percent')) {
                $table->decimal('surcharge_percent', 5, 2)->default(0)->after('chargeable_weight');
            }
            if (!Schema::hasColumn('shipments', 'surcharge_nominal')) {
                $table->decimal('surcharge_nominal', 15, 2)->default(0)->after('surcharge_percent');
            }
            
            // Add administrative fees
            if (!Schema::hasColumn('shipments', 'admin_fee_smu')) {
                $table->decimal('admin_fee_smu', 15, 2)->default(0)->after('surcharge_nominal');
            }
            if (!Schema::hasColumn('shipments', 'admin_fee_sg')) {
                $table->decimal('admin_fee_sg', 15, 2)->default(0)->after('admin_fee_smu');
            }
            
            // Add shipping subtotal (tanpa PPN/PPh - hanya operasional)
            if (!Schema::hasColumn('shipments', 'shipping_subtotal')) {
                $table->decimal('shipping_subtotal', 15, 2)->nullable()->after('admin_fee_sg');
            }
            
            // Add transport-specific fields for Udara
            if (!Schema::hasColumn('shipments', 'air_carrier')) {
                $table->string('air_carrier')->nullable()->after('shipping_subtotal');
            }
            
            // Add transport-specific fields for Darat
            if (!Schema::hasColumn('shipments', 'land_fleet')) {
                $table->string('land_fleet')->nullable()->after('air_carrier');
            }
            if (!Schema::hasColumn('shipments', 'land_license_plate')) {
                $table->string('land_license_plate')->nullable()->after('land_fleet');
            }
            
            // Add transport-specific fields for Laut
            if (!Schema::hasColumn('shipments', 'sea_fleet')) {
                $table->string('sea_fleet')->nullable()->after('land_license_plate');
            }
            if (!Schema::hasColumn('shipments', 'ship_name')) {
                $table->string('ship_name')->nullable()->after('sea_fleet');
            }
        });
        
        // Copy data from total_weight to actual_weight if total_weight exists
        if (Schema::hasColumn('shipments', 'total_weight') && Schema::hasColumn('shipments', 'actual_weight')) {
            DB::statement('UPDATE shipments SET actual_weight = total_weight WHERE actual_weight IS NULL AND total_weight IS NOT NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn([
                'actual_weight',
                'service_type',
                'use_volumetric',
                'length_cm',
                'width_cm',
                'height_cm',
                'volumetric_weight',
                'chargeable_weight',
                'surcharge_percent',
                'surcharge_nominal',
                'admin_fee_smu',
                'admin_fee_sg',
                'shipping_subtotal',
                'air_carrier',
                'land_fleet',
                'land_license_plate',
                'sea_fleet',
                'ship_name',
            ]);
        });
    }
};
