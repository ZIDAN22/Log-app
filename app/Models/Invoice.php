<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    public const STATUS_UNPAID = 'Belum Bayar';
    public const STATUS_DP = 'DP';
    public const STATUS_PAID = 'Lunas';

    public const PAYMENT_STATUSES = [
        self::STATUS_UNPAID,
        self::STATUS_DP,
        self::STATUS_PAID,
    ];

    protected $fillable = [
        'packing_list_id',
        'invoice_number',
        'receipt_number',
        'invoice_date',
        'customer_name',
        'transportation_type',
        'payment_status',
        'payment_method_id',
        'payment_method',
        'notes',
        'proof_of_payment',
        'total_qty',
        'total_weight',
        'total_value',
        'delivery_fee',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'ppn_amount',
        'pph_amount',
        'grand_total',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'total_qty' => 'integer',
        'total_weight' => 'decimal:2',
        'total_value' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'ppn_amount' => 'decimal:2',
        'pph_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public static function statusStyles(): array
    {
        return [
            self::STATUS_UNPAID => ['bg' => 'bg-red-100', 'text' => 'text-red-700'],
            self::STATUS_DP => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700'],
            self::STATUS_PAID => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
        ];
    }

    public function paymentStatusBadge(): string
    {
        $styles = self::statusStyles();

        return ($styles[$this->payment_status]['bg'] ?? 'bg-slate-100') . ' ' . ($styles[$this->payment_status]['text'] ?? 'text-slate-800');
    }

    public function getShippingAmountAttribute(): float
    {
        $deliveryFee = (float) ($this->attributes['delivery_fee'] ?? 0);

        if ($deliveryFee > 0) {
            return round($deliveryFee, 2);
        }

        $packingList = $this->packingList;
        $shipment = $packingList?->shipment;

        if ($shipment) {
            $pricePerKg = (float) ($shipment->price_per_kg ?? 0);
            $totalWeight = (float) ($this->total_weight ?? 0);

            return round($pricePerKg * $totalWeight, 2);
        }

        return 0.0;
    }

    public function packingList(): BelongsTo
    {
        return $this->belongsTo(PackingList::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function getPaymentMethodDisplayAttribute(): string
    {
        if ($this->paymentMethod) {
            return $this->paymentMethod->method_name;
        }

        return $this->payment_method ?? '-';
    }

    public function getBankDetailsAttribute(): array
    {
        if ($this->paymentMethod) {
            return [
                'bank_name' => $this->paymentMethod->bank_name,
                'account_number' => $this->paymentMethod->account_number,
                'account_name' => $this->paymentMethod->account_name,
            ];
        }

        return [
            'bank_name' => $this->bank_name,
            'account_number' => $this->bank_account_number,
            'account_name' => $this->bank_account_name,
        ];
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the computed due date for the invoice.
     *
     * Notes:
     * - If the underlying table has a 'due_date' column it will be used.
     * - If not present, a default term of 30 days from invoice_date is assumed.
     *   Consider adding an explicit due_date or payment_terms field for clarity.
     *
     * @return \Illuminate\Support\Carbon|null
     */
    public function getDueDateAttribute()
    {
        // If a due_date column exists in attributes, return it parsed as Carbon
        if (array_key_exists('due_date', $this->attributes) && !empty($this->attributes['due_date'])) {
            return \Illuminate\Support\Carbon::parse($this->attributes['due_date']);
        }

        if ($this->invoice_date) {
            // Default to net 30 if no explicit due date/terms are stored
            return $this->invoice_date->copy()->addDays(30);
        }

        return null;
    }

    /**
     * Aging in days (number of days overdue). Returns integer or null if due date missing.
     * If not overdue, returns 0.
     *
     * @return int|null
     */
    public function getAgingAttribute()
    {
        $due = $this->due_date;
        if (! $due) {
            return null;
        }

        $now = \Illuminate\Support\Carbon::now();
        if ($now->gt($due)) {
            return $now->diffInDays($due);
        }

        return 0;
    }
}

