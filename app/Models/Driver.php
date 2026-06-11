<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'Aktif';
    public const STATUS_INACTIVE = 'Tidak Aktif';

    public const LICENSE_TYPE_C = 'SIM C';
    public const LICENSE_TYPE_C1 = 'SIM C1';
    public const LICENSE_TYPE_C2 = 'SIM C2';
    public const LICENSE_TYPE_A = 'SIM A';
    public const LICENSE_TYPE_B1 = 'SIM B1';
    public const LICENSE_TYPE_B2 = 'SIM B2';
    public const LICENSE_TYPE_D = 'SIM D';

    protected $fillable = [
        'code',
        'name',
        'phone',
        'license_number',
        'license_type',
        'address',
        'status',
        'photo_path',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
        ];
    }

    public static function licenseTypes(): array
    {
        return [
            self::LICENSE_TYPE_A,
            self::LICENSE_TYPE_B1,
            self::LICENSE_TYPE_B2,
            self::LICENSE_TYPE_C,
            self::LICENSE_TYPE_C1,
            self::LICENSE_TYPE_C2,
            self::LICENSE_TYPE_D,
        ];
    }

    public static function statusStyles(): array
    {
        return [
            self::STATUS_ACTIVE => [
                'bg' => 'bg-emerald-100',
                'text' => 'text-emerald-700',
                'dot' => 'bg-emerald-500',
            ],
            self::STATUS_INACTIVE => [
                'bg' => 'bg-rose-100',
                'text' => 'text-rose-700',
                'dot' => 'bg-rose-500',
            ],
        ];
    }

    public static function generateCode(): string
    {
        $lastDriver = self::orderBy('id', 'desc')->first();

        if (! $lastDriver) {
            return 'DRV0001';
        }

        if (preg_match('/DRV(\d+)/', $lastDriver->code, $matches)) {
            $nextNumber = (int) $matches[1] + 1;
            return 'DRV' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        }

        return 'DRV0001';
    }

    public function outbounds()
    {
        return $this->hasMany(Outbound::class);
    }

    public function deliveryManagements()
    {
        return $this->hasMany(DeliveryManagement::class);
    }
}
