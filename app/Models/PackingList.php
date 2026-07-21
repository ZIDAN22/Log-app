<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function outbound(): HasOne
    {
        return $this->hasOne(Outbound::class);
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
