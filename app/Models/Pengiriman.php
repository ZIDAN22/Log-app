<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'no_invoice',
        'no_resi',
        'tanggal',
        'pengirim',
        'penerima',
        'alamat',
        'tujuan',
        'jenis_barang',
        'berat',
        'harga_per_kg',
        'transportasi',
        'total_amount',
        'status',
        'ekspedisi',
        'estimasi_hari',
        'nama_kapal',
        'jadwal_kapal',
        'maskapai',
        'nomor_flight',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jadwal_kapal' => 'datetime',
        'berat' => 'float',
        'harga_per_kg' => 'float',
        'total_amount' => 'float',
    ];
}
