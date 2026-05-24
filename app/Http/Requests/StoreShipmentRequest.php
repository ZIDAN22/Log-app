<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
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
            'total_weight' => 'required|numeric|min:0',
            'price_per_kg' => 'required|numeric|min:0',
            'transportation_type' => 'required|in:darat,laut,udara',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'shipping_day' => 'nullable|string|max:255',
            'sea_shipping' => 'nullable|string|max:255',
            'air_shipping' => 'nullable|string|max:255',
            'land_departure_date' => 'nullable|date',
            'sea_departure_date' => 'nullable|date',
            'air_departure_date' => 'nullable|date',
            'pickup_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
