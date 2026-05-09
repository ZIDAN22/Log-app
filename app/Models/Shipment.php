<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public const STATUS_PENDING = 'Pending Pickup';
    public const STATUS_PROCESSED = 'Diproses';
    public const STATUS_SENT = 'Dikirim';
    public const STATUS_IN_TRANSIT = 'Dalam Perjalanan';
    public const STATUS_PACKING_COMPLETED = 'Packing Completed';
    public const STATUS_DELIVERED = 'Sampai';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PROCESSED,
        self::STATUS_SENT,
        self::STATUS_IN_TRANSIT,
        self::STATUS_PACKING_COMPLETED,
        self::STATUS_DELIVERED,
    ];

    protected $fillable = [
        'invoice_number',
        'receipt_number',
        'customer_sender_id',
        'customer_receiver_id',
        'sender_name',
        'receiver_name',
        'pickup_address',
        'destination_city',
        'item_type',
        'total_weight',
        'price_per_kg',
        'subtotal',
        'ppn',
        'pph',
        'grand_total',
        'transportation_type',
        'pickup_date',
        'shipment_status',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'total_weight' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'ppn' => 'decimal:2',
        'pph' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'pickup_date' => 'date',
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
    }

    public static function generateInvoiceNumber(): string
    {
        $year = date('Y');
        $lastShipment = static::where('invoice_number', 'like', "INV-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastShipment) {
            $lastNumber = (int) substr($lastShipment->invoice_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return "INV-{$year}-{$newNumber}";
    }

    public static function generateReceiptNumber(): string
    {
        $year = date('Y');
        $lastShipment = static::where('receipt_number', 'like', "RESI-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastShipment) {
            $lastNumber = (int) substr($lastShipment->receipt_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return "RESI-{$year}-{$newNumber}";
    }

    public function calculateTotals(): void
    {
        $this->subtotal = $this->total_weight * $this->price_per_kg;
        $this->ppn = $this->subtotal * 0.011;
        $this->pph = $this->subtotal * 0.02;
        $this->grand_total = $this->subtotal + $this->ppn - $this->pph;
    }

    public static function statusStyles(): array
    {
        return [
            self::STATUS_PENDING => ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'],
            self::STATUS_PROCESSED => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
            self::STATUS_SENT => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800'],
            self::STATUS_IN_TRANSIT => ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-800'],
            self::STATUS_PACKING_COMPLETED => ['bg' => 'bg-sky-100', 'text' => 'text-sky-800'],
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
}
