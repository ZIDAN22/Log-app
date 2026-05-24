<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('vehicle_type');
            $table->string('license_plate')->unique();
            $table->decimal('weight_capacity', 8, 2);
            $table->decimal('volume_capacity', 8, 2);
            $table->year('year');
            $table->string('color');
            $table->string('status')->default('Ready');
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
