<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackingList extends Model
{
    protected $fillable = [
        'shipment_id',
        'packing_date',
        'total_qty',
        'total_package',
        'total_weight',
        'total_value',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'packing_date' => 'date',
        'total_qty' => 'integer',
        'total_package' => 'integer',
        'total_weight' => 'decimal:2',
        'total_value' => 'decimal:2',
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
        return $this->hasMany(PackingItem::class);
    }
}
