<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ShipmentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting
{
    protected Collection $items;

    public function __construct(Collection $items)
    {
        $this->items = $items;
    }

    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return [
            'Invoice Number',
            'Receipt Number',
            'Item Type',
            'Origin',
            'Destination',
            'Sender',
            'Receiver',
            'Transportation',
            'Vehicle',
            'Driver',
            'License Plate',
            'Shipping Subtotal',
            'Status',
            'Pickup Date',
            'Created At',
        ];
    }

    public function map($shipment): array
    {
        return [
            $shipment->invoice_number,
            $shipment->receipt_number,
            $shipment->item_type,
            $shipment->pickup_city ?? $shipment->pickup_district ?? '-',
            $shipment->destination_city ?? $shipment->destination_district ?? '-',
            $shipment->sender_name,
            $shipment->receiver_name,
            ucfirst($shipment->transportation_type),
            optional($shipment->vehicle)->name ?? '-',
            optional($shipment->driver)->name ?? '-',
            optional($shipment->vehicle)->license_plate ?? $shipment->land_license_plate ?? '-',
            (float) $shipment->shipping_subtotal,
            $shipment->shipment_status,
            optional($shipment->pickup_date)->format('Y-m-d'),
            optional($shipment->created_at)->format('Y-m-d H:i:s'),
        ];
    }

    public function columnFormats(): array
    {
        $rupiahFormat = '"Rp"\ #,##0';

        return [
            // L = Shipping Subtotal
            'L' => $rupiahFormat,
        ];
    }
}
