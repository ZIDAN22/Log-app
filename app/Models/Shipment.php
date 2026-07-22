<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Shipment extends Model
{
    public const STATUS_PENDING = 'Menunggu Pickup';
    public const STATUS_PROCESSED = 'Proses Picukup';
    public const STATUS_SENT = 'Dikirim';
    public const STATUS_IN_TRANSIT = 'Dalam Perjalanan';
    public const STATUS_PENGEMASAN_SELESAI = 'Pengemasan Selesai';
    public const STATUS_DELIVERED = 'Sampai';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PROCESSED,
        self::STATUS_SENT,
        self::STATUS_IN_TRANSIT,
        self::STATUS_PENGEMASAN_SELESAI,
        self::STATUS_DELIVERED,
    ];

    protected $fillable = [
        'invoice_number',
        'receipt_number',
        'uuid',
        'customer_sender_id',
        'customer_receiver_id',
        'sender_name',
        'receiver_name',
        'pickup_address',
        'pickup_province',
        'pickup_province_code',
        'pickup_city_code',
        'pickup_city',
        'pickup_district',
        'pickup_district_code',
        'pickup_village',
        'pickup_village_code',
        'pickup_postal_code',
        'destination_city',
        'destination_province',
        'destination_province_code',
        'destination_city_code',
        'destination_district',
        'destination_district_code',
        'destination_village',
        'destination_village_code',
        'destination_postal_code',
        'destination_address',
        'item_type',
        'actual_weight',
        'total_weight', // For backward compatibility
        'price_per_kg',
        'subtotal',
        'ppn',
        'pph',
        'grand_total',
        'transportation_type',
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
        'driver_id',
        'vehicle_id',
        'shipping_day',
        'air_carrier',
        'air_shipping',
        'air_departure_date',
        'land_fleet',
        'land_license_plate',
        'land_departure_date',
        'sea_fleet',
        'sea_shipping',
        'ship_name',
        'sea_departure_date',
        'pickup_date',
        'shipment_status',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'actual_weight' => 'decimal:2',
        'total_weight' => 'decimal:2', // For backward compatibility
        'price_per_kg' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'ppn' => 'decimal:2',
        'pph' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'use_volumetric' => 'boolean',
        'length_cm' => 'decimal:2',
        'width_cm' => 'decimal:2',
        'height_cm' => 'decimal:2',
        'volumetric_weight' => 'decimal:2',
        'chargeable_weight' => 'decimal:2',
        'surcharge_percent' => 'decimal:2',
        'surcharge_nominal' => 'decimal:2',
        'admin_fee_smu' => 'decimal:2',
        'admin_fee_sg' => 'decimal:2',
        'shipping_subtotal' => 'decimal:2',
        'pickup_date' => 'date',
        'land_departure_date' => 'date',
        'sea_departure_date' => 'date',
        'air_departure_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shipment) {
            if (empty($shipment->invoice_number)) {
                $shipment->invoice_number = static::generateInvoiceNumber();
            }
            if (empty($shipment->receipt_number)) {
                $shipment->receipt_number = static::generateReceiptNumber();
            }
            if (empty($shipment->shipment_status)) {
                $shipment->shipment_status = self::STATUS_PENDING;
            }
            if (!isset($shipment->subtotal)) {
                $shipment->calculateTotals();
            }
        });

        static::updating(function ($shipment) {
            $shipment->calculateTotals();
        });

        static::creating(function ($shipment) {
            if (empty($shipment->uuid)) {
                $shipment->uuid = (string) Str::uuid();
            }
        });
    }

    public static function generateInvoiceNumber(): string
    {
        $date = now();
        $month = static::romanMonth((int) $date->format('n'));
        $year = $date->format('y');
        $suffix = "INV/{$month}/{$year}";
        $patternSuffix = preg_quote($suffix, '/');

        $lastNumber = static::where('invoice_number', 'like', "%/{$suffix}")
            ->pluck('invoice_number')
            ->map(function (string $invoiceNumber) use ($patternSuffix) {
                if (preg_match("/^(\\d+)\\/{$patternSuffix}$/", $invoiceNumber, $matches)) {
                    return (int) $matches[1];
                }

                return 0;
            })
            ->max() ?? 0;

        do {
            $lastNumber++;
            $invoiceNumber = str_pad($lastNumber, 3, '0', STR_PAD_LEFT) . "/{$suffix}";
        } while (static::where('invoice_number', $invoiceNumber)->exists());

        return $invoiceNumber;
    }

    public static function generateReceiptNumber(): string
    {
        return static::generateUniqueNumber('receipt_number');
    }

    protected static function generateUniqueNumber(string $column): string
    {
        do {
            $number = now()->format('YmdHis') . Str::upper(Str::random(4));
        } while (static::where($column, $number)->exists());

        return $number;
    }

    protected static function romanMonth(int $month): string
    {
        return [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ][$month];
    }

    public function calculateTotals(): void
    {
        // Calculate shipping subtotal (operational cost without PPN/PPh)
        $actualWeight = $this->actual_weight ?? $this->total_weight ?? 0;
        $chargeableWeight = $actualWeight;

        // Calculate volumetric weight if enabled
        if ($this->use_volumetric) {
            $panjang = $this->length_cm ?? 0;
            $lebar = $this->width_cm ?? 0;
            $tinggi = $this->height_cm ?? 0;

            if ($panjang > 0 && $lebar > 0 && $tinggi > 0) {
                $this->volumetric_weight = ($panjang * $lebar * $tinggi) / 4000;
                $chargeableWeight = max($actualWeight, $this->volumetric_weight);
            }
        } else {
            $this->volumetric_weight = null;
        }

        $this->chargeable_weight = $chargeableWeight;
        $this->total_weight = $chargeableWeight; // Set for backward compatibility

        // Calculate surcharge based on chargeable weight
        $this->surcharge_percent = 0;
        $this->surcharge_nominal = 0;

        if ($chargeableWeight > 70 && $chargeableWeight <= 100) {
            $this->surcharge_percent = 50;
            $this->surcharge_nominal = ($this->price_per_kg ?? 0) * $chargeableWeight * 0.50;
        } elseif ($chargeableWeight > 100 && $chargeableWeight <= 150) {
            $this->surcharge_percent = 100;
            $this->surcharge_nominal = ($this->price_per_kg ?? 0) * $chargeableWeight * 1.00;
        } elseif ($chargeableWeight > 150 && $chargeableWeight <= 200) {
            $this->surcharge_percent = 200;
            $this->surcharge_nominal = ($this->price_per_kg ?? 0) * $chargeableWeight * 2.00;
        } elseif ($chargeableWeight > 200) {
            // For weight > 200 KG, tariff needs confirmation - don't auto-apply surcharge
            $this->surcharge_percent = 0;
            $this->surcharge_nominal = 0;
        }

        // Calculate administrative fees based on transportation type
        if ($this->transportation_type === 'udara') {
            $this->admin_fee_smu = 15000; // Admin SMU for air
        } else {
            $this->admin_fee_smu = 0;
        }
        
        $this->admin_fee_sg = 500; // Admin SG is always applied

        // Calculate shipping subtotal (operational cost)
        // PPN dan PPh akan dihitung di Invoice oleh Finance
        $baseTariff = ($this->price_per_kg ?? 0) * $chargeableWeight;
        $this->shipping_subtotal = $baseTariff + $this->surcharge_nominal + $this->admin_fee_smu + $this->admin_fee_sg;

        // Reset PPN, PPh, subtotal, grand_total - akan dihitung di Invoice
        $this->subtotal = null;
        $this->ppn = null;
        $this->pph = null;
        $this->grand_total = null;
    }

    public static function statusStyles(): array
    {
        return [
            self::STATUS_PENDING => ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'],
            self::STATUS_PROCESSED => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
            self::STATUS_SENT => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800'],
            self::STATUS_IN_TRANSIT => ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-800'],
            self::STATUS_PENGEMASAN_SELESAI => ['bg' => 'bg-sky-100', 'text' => 'text-sky-800'],
            self::STATUS_DELIVERED => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800'],
        ];
    }

    public function shipmentStatusBadge(): string
    {
        $styles = self::statusStyles();

        return $styles[$this->shipment_status]['bg'] . ' ' . $styles[$this->shipment_status]['text'];
    }

    public function deliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::class);
    }

    public function packingList()
    {
        return $this->hasOne(PackingList::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function inbound()
    {
        return $this->hasOne(Inbound::class);
    }

    public function deliveryManagement()
    {
        return $this->hasOne(DeliveryManagement::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
