<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InboundItem extends Model
{
    protected $fillable = [
        'inbound_id',
        'item_name',
        'qty',
        'packaging_type',
        'total_packaging',
        'unit_price',
        'subtotal_price',
        'weight',
        'item_notes',
    ];

    protected $casts = [
        'qty' => 'integer',
        'total_packaging' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal_price' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    public function inbound(): BelongsTo
    {
        return $this->belongsTo(Inbound::class);
    }
}
