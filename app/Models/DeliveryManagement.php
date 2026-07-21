<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class DeliveryManagement extends Model
{
    protected $table = 'delivery_managements';

    protected $fillable = [
        'delivery_number',
        'shipment_id',
        'outbound_id',
        'driver_id',
        'vehicle_id',
        'delivery_method',
        'delivery_status',
        'pod_status',
        'picked_up_at',
        'arrived_at_destination_at',
        'delivered_at',
        'receiver_name',
        'receiver_signature',
        'receiver_photo',
        'delivery_notes',
        'eta',
    ];

    protected $casts = [
        'picked_up_at' => 'datetime',
        'arrived_at_destination_at' => 'datetime',
        'delivered_at' => 'datetime',
        'eta' => 'datetime',
    ];

    const STATUS_READY_TO_SHIP = 'ready_to_ship';
    const STATUS_IN_TRANSIT = 'in_transit';
    const STATUS_ARRIVED_DESTINATION = 'arrived_destination';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_COMPLETED = 'completed';

    const STATUSES = [
        self::STATUS_READY_TO_SHIP => 'Siap Dikirim',
        self::STATUS_IN_TRANSIT => 'Dalam Perjalanan',
        self::STATUS_DELIVERED => 'Sampai',
        self::STATUS_COMPLETED => 'Selesai',
    ];

    const POD_STATUS_PENDING = 'pending';
    const POD_STATUS_UPLOADED = 'uploaded';
    const POD_STATUS_VERIFIED = 'verified';

    const POD_STATUSES = [
        self::POD_STATUS_PENDING => 'Pending',
        self::POD_STATUS_UPLOADED => 'Uploaded',
        self::POD_STATUS_VERIFIED => 'Verified',
    ];

    const METHODS = [
        'DARAT' => 'Darat',
        'LAUT' => 'Laut',
        'UDARA' => 'Udara',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function outbound(): BelongsTo
    {
        return $this->belongsTo(Outbound::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getEstimatedEtaAttribute()
    {
        if ($this->eta) {
            return $this->eta;
        }

        if (! $this->shipment) {
            return null;
        }

        $shippingDay = $this->shipment->shipping_day;
        if (empty($shippingDay)) {
            return null;
        }

        if (preg_match('/\d+/', $shippingDay, $matches)) {
            $days = intval($matches[0]);
        } else {
            return null;
        }

        $departureDate = $this->shipment->land_departure_date
            ?? $this->shipment->sea_departure_date
            ?? $this->shipment->air_departure_date;

        if (! $departureDate) {
            return null;
        }

        return $departureDate->copy()->addDays($days);
    }

    public function statusBadge(): string
    {
        return match ($this->delivery_status) {
            self::STATUS_READY_TO_SHIP => 'inline-flex rounded-full bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-700',
            self::STATUS_IN_TRANSIT => 'inline-flex rounded-full bg-cyan-50 px-2.5 py-1 text-xs font-semibold text-cyan-700',
            self::STATUS_ARRIVED_DESTINATION => 'inline-flex rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-700',
            self::STATUS_DELIVERED => 'inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700',
            self::STATUS_COMPLETED => 'inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700',
            default => 'inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700',
        };
    }

    public function podBadge(): string
    {
        return match ($this->pod_status) {
            self::POD_STATUS_PENDING => 'inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700',
            self::POD_STATUS_UPLOADED => 'inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700',
            self::POD_STATUS_VERIFIED => 'inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700',
            default => 'inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700',
        };
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->delivery_status] ?? ucfirst(str_replace('_', ' ', $this->delivery_status));
    }

    public function podLabel(): string
    {
        return self::POD_STATUSES[$this->pod_status] ?? ucfirst($this->pod_status);
    }

    public static function generateDeliveryNumber()
    {
        $year = now()->year;
        $lastDelivery = static::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = ($lastDelivery ? intval(substr($lastDelivery->delivery_number, -4)) : 0) + 1;
        return 'DLV-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
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
