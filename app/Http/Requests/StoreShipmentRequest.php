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
            'destination_city' => 'required|string|max:255',
            'item_type' => 'required|string|max:255',
            'total_weight' => 'required|numeric|min:0',
            'price_per_kg' => 'required|numeric|min:0',
            'transportation_type' => 'required|in:darat,laut,udara',
            'pickup_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
