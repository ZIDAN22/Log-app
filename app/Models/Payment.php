<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_VERIFIED = 'verified';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_VERIFIED,
    ];

    protected $fillable = [
        'invoice_id',
        'payment_code',
        'payment_date',
        'amount_paid',
        'proof_payment',
        'notes',
        'status',
        'verified_by',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount_paid' => 'decimal:2',
    ];

    /**
     * Generate unique payment code
     */
    public static function generatePaymentCode(): string
    {
        $prefix = 'PAY/' . date('Ymd');
        $latestPayment = self::where('payment_code', 'like', $prefix . '%')
            ->orderBy('payment_code', 'desc')
            ->first();

        if (!$latestPayment) {
            return $prefix . '/001';
        }

        $lastNumber = (int) substr($latestPayment->payment_code, -3);
        return $prefix . '/' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Relation: Payment belongs to Invoice
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Relation: Verified by User
     */
    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Get payment method from related invoice
     */
    public function getPaymentMethodAttribute(): ?string
    {
        return $this->invoice?->payment_method;
    }

    /**
     * Check if payment is fully paid
     */
    public function isFullyPaid(): bool
    {
        return $this->amount_paid == $this->invoice->grand_total;
    }

    /**
     * Check if payment is partial
     */
    public function isPartialPayment(): bool
    {
        return $this->amount_paid > 0 && $this->amount_paid < $this->invoice->grand_total;
    }

    /**
     * Get remaining balance
     */
    public function getRemainingBalance(): float
    {
        return max(0, $this->invoice->grand_total - $this->amount_paid);
    }

    /**
     * Get status badge styling
     */
    public function getStatusBadge(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-700',
            self::STATUS_VERIFIED => 'bg-emerald-100 text-emerald-700',
            default => 'bg-slate-100 text-slate-700',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Menunggu Verifikasi',
            self::STATUS_VERIFIED => 'Terverifikasi',
            default => 'Tidak Diketahui',
        };
    }
}
