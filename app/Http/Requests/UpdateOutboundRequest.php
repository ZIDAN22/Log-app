<?php

namespace App\Http\Requests;

use App\Models\Outbound;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOutboundRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $methods = implode(',', array_map(fn($value) => addslashes($value), Outbound::shippingMethods()));

        $rules = [
            'shipping_method' => "required|in:{$methods}",
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'outbound_date' => 'required|date',
            'delivery_notes' => 'nullable|string|max:1000',
            'sea_shipping' => 'nullable|string|max:255',
            'sea_departure_date' => 'nullable|date',
            'air_shipping' => 'nullable|string|max:255',
            'air_departure_date' => 'nullable|date',
            'land_departure_date' => 'nullable|date',
        ];

        if ($this->input('shipping_method') === Outbound::SHIPPING_METHOD_LAND) {
            $rules['driver_id'] = 'required|exists:drivers,id';
            $rules['vehicle_id'] = 'required|exists:vehicles,id';
        }

        return $rules;
    }
}
