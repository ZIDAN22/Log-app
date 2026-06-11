<?php

namespace App\Observers;

use App\Models\Outbound;
use App\Models\DeliveryManagement;

class OutboundObserver
{
    public function created(Outbound $outbound)
    {
        $this->createDeliveryManagementIfReady($outbound);
    }

    public function updated(Outbound $outbound)
    {
        $this->createDeliveryManagementIfReady($outbound);
    }

    private function createDeliveryManagementIfReady(Outbound $outbound): void
    {
        if ($outbound->status !== Outbound::STATUS_READY_TO_SHIP) {
            return;
        }

        if ($outbound->deliveryManagement) {
            return;
        }

        if (!$outbound->packingList || !$outbound->packingList->shipment) {
            return;
        }

        $shipment = $outbound->packingList->shipment;

        DeliveryManagement::create([
            'delivery_number' => DeliveryManagement::generateDeliveryNumber(),
            'shipment_id' => $shipment->id,
            'outbound_id' => $outbound->id,
            'driver_id' => $outbound->driver_id,
            'vehicle_id' => $outbound->vehicle_id,
            'delivery_method' => $this->mapDeliveryMethod($outbound->shipping_method),
            'delivery_status' => DeliveryManagement::STATUS_READY_TO_SHIP,
            'pod_status' => DeliveryManagement::POD_STATUS_PENDING,
        ]);
    }

    private function mapDeliveryMethod($shippingMethod): string
    {
        return match ($shippingMethod) {
            'Laut' => 'LAUT',
            'Udara' => 'UDARA',
            default => 'DARAT',
        };
    }
}
