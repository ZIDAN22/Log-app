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
        $statuses = implode(',', array_map(fn($value) => addslashes($value), Outbound::statuses()));

        $rules = [
            'shipping_method' => "required|in:{$methods}",
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'outbound_date' => 'required|date',
            'delivery_notes' => 'nullable|string|max:1000',
            'status' => "required|in:{$statuses}",
        ];

        if ($this->input('shipping_method') === Outbound::SHIPPING_METHOD_LAND) {
            $rules['driver_id'] = 'required|exists:drivers,id';
            $rules['vehicle_id'] = 'required|exists:vehicles,id';
        }

        return $rules;
    }
}
