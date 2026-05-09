<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePackingListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipment_id' => 'required|exists:shipments,id|unique:packing_lists,shipment_id',
            'packing_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.packaging_type' => 'required|string|max:100',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.weight' => 'required|numeric|min:0',
            'items.*.item_notes' => 'nullable|string|max:500',
        ];
    }
}
