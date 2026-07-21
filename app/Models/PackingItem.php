<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PackingItem extends Model
{
    protected $fillable = [
        'packing_list_id',
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

    public function packingList(): BelongsTo
    {
        return $this->belongsTo(PackingList::class);
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
