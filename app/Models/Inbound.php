<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inbound extends Model
{
    protected $fillable = [
        'shipment_id',
        'inbound_date',
        'total_qty',
        'total_package',
        'total_weight',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'inbound_date' => 'date',
        'total_qty' => 'integer',
        'total_package' => 'integer',
        'total_weight' => 'decimal:2',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InboundItem::class);
    }

    protected static function booted()
    {
        static::deleted(function (Inbound $inbound) {
            $inbound->shipment?->deliveryManagement?->delete();
        });
    }
}
