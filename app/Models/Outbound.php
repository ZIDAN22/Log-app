<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Outbound extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_READY_TO_SHIP = 'Siap Dikirim';
    public const STATUS_IN_TRANSIT = 'Dalam Perjalanan';
    public const STATUS_DELIVERED = 'Sampai';

    public const SHIPPING_METHOD_LAND = 'Darat';
    public const SHIPPING_METHOD_SEA = 'Laut';
    public const SHIPPING_METHOD_AIR = 'Udara';

    protected $fillable = [
        'packing_list_id',
        'driver_id',
        'vehicle_id',
        'shipping_method',
        'outbound_date',
        'delivery_notes',
        'status',
        'created_by',
    ];

    protected $casts = [
        'outbound_date' => 'date',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_READY_TO_SHIP,
            self::STATUS_IN_TRANSIT,
            self::STATUS_DELIVERED,
        ];
    }

    public static function shippingMethods(): array
    {
        return [
            self::SHIPPING_METHOD_LAND,
            self::SHIPPING_METHOD_SEA,
            self::SHIPPING_METHOD_AIR,
        ];
    }

    public static function statusStyles(): array
    {
        return [
            self::STATUS_READY_TO_SHIP => ['bg' => 'bg-slate-100', 'text' => 'text-slate-900'],
            self::STATUS_IN_TRANSIT => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
            self::STATUS_DELIVERED => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800'],
        ];
    }

    public function packingList(): BelongsTo
    {
        return $this->belongsTo(PackingList::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function statusBadge(): string
    {
        $styles = self::statusStyles();

        return $styles[$this->status]['bg'] . ' ' . $styles[$this->status]['text'];
    }

    public function deliveryManagement()
    {
        return $this->hasOne(DeliveryManagement::class);
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
