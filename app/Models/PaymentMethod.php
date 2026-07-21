<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentMethod extends Model
{
    protected $fillable = [
        'payment_code',
        'method_name',
        'method_type',
        'bank_name',
        'account_number',
        'account_name',
        'is_default',
        'status',
        'notes',
    ];

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    const TYPE_BANK_TRANSFER = 'BANK_TRANSFER';
    const TYPE_E_WALLET = 'E_WALLET';
    const TYPE_CASH = 'CASH';
    const TYPE_VIRTUAL_ACCOUNT = 'VIRTUAL_ACCOUNT';

    public static function types(): array
    {
        return [
            self::TYPE_BANK_TRANSFER => 'Bank Transfer',
            self::TYPE_E_WALLET => 'E-Wallet',
            self::TYPE_CASH => 'Cash',
            self::TYPE_VIRTUAL_ACCOUNT => 'Virtual Account',
        ];
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Aktif',
            self::STATUS_INACTIVE => 'Nonaktif',
        ];
    }

    public function getStatusBadge(): string
    {
        return match ($this->status) {
            self::STATUS_ACTIVE =>
                'bg-emerald-100 text-emerald-700',

            self::STATUS_INACTIVE =>
                'bg-rose-100 text-rose-700',

            default =>
                'bg-slate-100 text-slate-700',
        };
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
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