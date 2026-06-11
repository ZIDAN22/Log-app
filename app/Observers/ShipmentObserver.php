<?php

namespace App\Observers;

use App\Models\DeliveryManagement;
use App\Models\Outbound;
use App\Models\Shipment;

class ShipmentObserver
{
    public function updated(Shipment $shipment): void
    {
        if (! $shipment->wasChanged('shipment_status')) {
            return;
        }

        $this->syncOutboundStatus($shipment);
        $this->syncDeliveryManagementStatus($shipment);
    }

    protected function syncOutboundStatus(Shipment $shipment): void
    {
        $outbound = $shipment->packingList?->outbound;

        if (! $outbound) {
            return;
        }

        $status = match ($shipment->shipment_status) {
            Shipment::STATUS_SENT => Outbound::STATUS_READY_TO_SHIP,
            Shipment::STATUS_IN_TRANSIT => Outbound::STATUS_IN_TRANSIT,
            Shipment::STATUS_DELIVERED => Outbound::STATUS_DELIVERED,
            default => null,
        };

        if ($status && $outbound->status !== $status) {
            $outbound->update(['status' => $status]);
        }
    }

    protected function syncDeliveryManagementStatus(Shipment $shipment): void
    {
        $deliveryManagement = $shipment->deliveryManagement;

        if (! $deliveryManagement) {
            return;
        }

        $status = match ($shipment->shipment_status) {
            Shipment::STATUS_SENT => DeliveryManagement::STATUS_READY_TO_SHIP,
            Shipment::STATUS_IN_TRANSIT => DeliveryManagement::STATUS_IN_TRANSIT,
            Shipment::STATUS_DELIVERED => DeliveryManagement::STATUS_DELIVERED,
            default => null,
        };

        if ($status && $deliveryManagement->delivery_status !== $status) {
            $deliveryManagement->update([
                'delivery_status' => $status,
                'delivered_at' => $status === DeliveryManagement::STATUS_DELIVERED
                    ? ($deliveryManagement->delivered_at ?: now())
                    : $deliveryManagement->delivered_at,
            ]);
        }
    }
}
