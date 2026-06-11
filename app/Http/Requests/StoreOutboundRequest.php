<?php

namespace App\Http\Requests;

use App\Models\Outbound;
use Illuminate\Foundation\Http\FormRequest;

class StoreOutboundRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $methods = implode(',', array_map(fn($value) => addslashes($value), Outbound::shippingMethods()));

        $rules = [
            'packing_list_id' => 'required|exists:packing_lists,id',
            'shipping_method' => "required|in:{$methods}",
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'outbound_date' => 'required|date',
            'delivery_notes' => 'nullable|string|max:1000',
            'shipment.sea_shipping' => 'nullable|string|max:255',
            'shipment.sea_departure_date' => 'nullable|date',
            'shipment.air_shipping' => 'nullable|string|max:255',
            'shipment.air_departure_date' => 'nullable|date',
            'shipment.land_departure_date' => 'nullable|date',
            'shipment.transportation_type' => 'nullable|string',
        ];

        if ($this->input('shipping_method') === Outbound::SHIPPING_METHOD_LAND) {
            $rules['driver_id'] = 'required|exists:drivers,id';
            $rules['vehicle_id'] = 'required|exists:vehicles,id';
        }

        return $rules;
    }
}

