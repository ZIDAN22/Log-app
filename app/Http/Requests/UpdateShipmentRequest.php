<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'pickup_address' => 'required|string|max:500',
            'destination_city' => 'required|string|max:255',
            'item_type' => 'required|string|max:255',
            'total_weight' => 'required|numeric|min:0',
            'price_per_kg' => 'required|numeric|min:0',
            'transportation_type' => 'required|in:darat,laut,udara',
            'pickup_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
            'shipment_status' => 'nullable|string|in:' . implode(',', Shipment::STATUSES),
        ];
    }
}
