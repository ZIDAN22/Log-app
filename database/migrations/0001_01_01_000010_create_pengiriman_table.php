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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique();
            $table->string('no_resi')->unique();
            $table->date('tanggal');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('alamat');
            $table->string('tujuan');
            $table->string('jenis_barang');
            $table->float('berat'); // dalam KG
            $table->float('harga_per_kg');
            $table->enum('transportasi', ['darat', 'laut', 'udara']);
            $table->float('total_amount');
            $table->string('status')->default('menunggu'); // menunggu, dalam_perjalanan, selesai
            
            // Transportasi Darat
            $table->string('ekspedisi')->nullable();
            $table->integer('estimasi_hari')->nullable();
            
            // Transportasi Laut
            $table->string('nama_kapal')->nullable();
            $table->dateTime('jadwal_kapal')->nullable();
            
            // Transportasi Udara
            $table->string('maskapai')->nullable();
            $table->string('nomor_flight')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
