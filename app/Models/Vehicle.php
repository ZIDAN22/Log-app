<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;

    public const STATUS_READY = 'Ready';
    public const STATUS_MAINTENANCE = 'Maintenance';
    public const STATUS_USED = 'Used';

    public const TYPE_PICKUP = 'Pickup';
    public const TYPE_VAN = 'Van';
    public const TYPE_CDD = 'CDD';
    public const TYPE_FUSO = 'Fuso';
    public const TYPE_TRAILER = 'Trailer';
    public const TYPE_MOTOR = 'Motor';
    public const TYPE_OTHER = 'Lainnya';

    protected $fillable = [
        'code',
        'name',
        'vehicle_type',
        'license_plate',
        'weight_capacity',
        'volume_capacity',
        'year',
        'color',
        'status',
        'photo_path',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_READY,
            self::STATUS_MAINTENANCE,
            self::STATUS_USED,
        ];
    }

    public static function vehicleTypes(): array
    {
        return [
            self::TYPE_PICKUP,
            self::TYPE_VAN,
            self::TYPE_CDD,
            self::TYPE_FUSO,
            self::TYPE_TRAILER,
            self::TYPE_MOTOR,
            self::TYPE_OTHER,
        ];
    }

    public static function statusStyles(): array
    {
        return [
            self::STATUS_READY => [
                'bg' => 'bg-emerald-100',
                'text' => 'text-emerald-700',
                'dot' => 'bg-emerald-500',
            ],
            self::STATUS_MAINTENANCE => [
                'bg' => 'bg-amber-100',
                'text' => 'text-amber-700',
                'dot' => 'bg-amber-500',
            ],
            self::STATUS_USED => [
                'bg' => 'bg-blue-100',
                'text' => 'text-blue-700',
                'dot' => 'bg-blue-500',
            ],
        ];
    }

    public static function generateCode(): string
    {
        $lastVehicle = self::orderBy('id', 'desc')->first();

        if (! $lastVehicle) {
            return 'VEH0001';
        }

        if (preg_match('/VEH(\d+)/', $lastVehicle->code, $matches)) {
            $nextNumber = (int) $matches[1] + 1;
            return 'VEH' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        }

        return 'VEH0001';
    }

    public function outbounds()
    {
        return $this->hasMany(Outbound::class);
    }

    public function deliveryManagements()
    {
        return $this->hasMany(DeliveryManagement::class);
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
