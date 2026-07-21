<?php

namespace App\Http\Requests;

use Aliziodev\IndonesiaRegions\Models\IndonesiaRegion;
use App\Models\Shipment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->mergeRegionData('pickup');
        $this->mergeRegionData('destination');
    }

    private function mergeRegionData(string $prefix): void
    {
        $fields = [
            'province' => $this->input("{$prefix}_province_code"),
            'city' => $this->input("{$prefix}_city_code"),
            'district' => $this->input("{$prefix}_district_code"),
            'village' => $this->input("{$prefix}_village_code"),
        ];

        $regions = IndonesiaRegion::query()
            ->whereIn('code', array_filter($fields))
            ->get()
            ->keyBy('code');

        $data = [];

        foreach ($fields as $field => $code) {
            if (! $code || $this->hasRegionValue("{$prefix}_{$field}")) {
                continue;
            }

            $region = $regions->get($code);
            if ($region) {
                $data["{$prefix}_{$field}"] = $region->name;
            }
        }

        $village = $regions->get($fields['village']);
        if (! $this->hasRegionValue("{$prefix}_postal_code") && $village?->postal_code) {
            $data["{$prefix}_postal_code"] = $village->postal_code;
        }

        if ($data) {
            $this->merge($data);
        }
    }

    private function hasRegionValue(string $field): bool
    {
        $value = trim((string) $this->input($field, ''));

        return $value !== '' && ! str_starts_with($value, 'Pilih ');
    }

    public function rules(): array
    {
        return [
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'pickup_address' => 'required|string|max:500',
            'pickup_province_code' => 'required|string|max:50',
            'pickup_province' => 'required|string|max:255',
            'pickup_city_code' => 'required|string|max:50',
            'pickup_district' => 'required|string|max:255',
            'pickup_district_code' => 'required|string|max:50',
            'pickup_village' => 'required|string|max:255',
            'pickup_village_code' => 'required|string|max:50',
            'pickup_postal_code' => 'required|string|max:20',
            'destination_province_code' => 'required|string|max:50',
            'destination_province' => 'required|string|max:255',
            'destination_city_code' => 'required|string|max:50',
            'destination_city' => 'required|string|max:255',
            'destination_district_code' => 'required|string|max:50',
            'destination_district' => 'required|string|max:255',
            'destination_village_code' => 'required|string|max:50',
            'destination_village' => 'required|string|max:255',
            'destination_postal_code' => 'required|string|max:20',
            'destination_address' => 'required|string|max:500',
            'item_type' => 'required|string|max:255',
            'actual_weight' => 'required|numeric|min:0',
            'total_weight' => 'nullable|numeric|min:0', // For backward compatibility
            'price_per_kg' => 'required|numeric|min:0',
            'transportation_type' => 'required|in:darat,laut,udara',
            'service_type' => 'required|in:PTP,DTD',
            'use_volumetric' => 'nullable|boolean',
            'length_cm' => 'nullable|numeric|min:0|required_if:use_volumetric,1',
            'width_cm' => 'nullable|numeric|min:0|required_if:use_volumetric,1',
            'height_cm' => 'nullable|numeric|min:0|required_if:use_volumetric,1',
            'shipping_day' => 'nullable|string|max:255',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'air_carrier' => 'nullable|string|max:255',
            'air_departure_date' => 'nullable|date',
            'land_fleet' => 'nullable|string|max:255',
            'land_license_plate' => 'nullable|string|max:255',
            'land_departure_date' => 'nullable|date',
            'sea_fleet' => 'nullable|string|max:255',
            'ship_name' => 'nullable|string|max:255',
            'sea_departure_date' => 'nullable|date',
            'sea_shipping' => 'nullable|string|max:255', // For backward compatibility
            'air_shipping' => 'nullable|string|max:255', // For backward compatibility
            'pickup_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
            'shipment_status' => 'nullable|string|in:' . implode(',', Shipment::STATUSES),
        ];
    }
}
