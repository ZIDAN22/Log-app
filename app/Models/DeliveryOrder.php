<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class DeliveryOrder extends Model
{
    protected $fillable = [
        'shipment_id',
        'delivery_order_number',
        'order_date',
        'pickup_address',
        'destination_city',
        'sender_name',
        'receiver_name',
        'transportation_type',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function generateDeliveryOrderNumber(): string
    {
        $year = now()->year;
        $lastOrder = self::where('delivery_order_number', 'like', "SJ-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = $lastOrder ? (int) substr($lastOrder->delivery_order_number, -4) + 1 : 1;

        return sprintf('SJ-%d-%04d', $year, $nextNumber);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
