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

    public function packingList(): BelongsTo
    {
        return $this->belongsTo(PackingList::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
