<?php

namespace App\Http\Controllers;

use App\Models\DeliveryManagement;
use App\Models\Shipment;
use App\Models\Outbound;
use App\Models\Driver;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = DeliveryManagement::with(['shipment', 'outbound', 'driver', 'vehicle']);

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('delivery_number', 'like', "%{$search}%")
                    ->orWhereHas('shipment', function ($q) use ($search) {
                        $q->where('invoice_number', 'like', "%{$search}%")
                            ->orWhere('receipt_number', 'like', "%{$search}%")
                            ->orWhere('receiver_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('outbound', function ($q) use ($search) {
                        $q->where('destination_city', 'like', "%{$search}%");
                    });
            });
        }

        if ($status = $request->query('status')) {
            $query->where('delivery_status', $status);
        }

        if ($method = $request->query('method')) {
            $query->where('delivery_method', $method);
        }

        $deliveries = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => DeliveryManagement::count(),
            'ready_to_ship' => DeliveryManagement::where('delivery_status', 'ready_to_ship')->count(),
            'in_transit' => DeliveryManagement::where('delivery_status', 'in_transit')->count(),
            'delivered' => DeliveryManagement::where('delivery_status', 'delivered')->count(),
            'completed' => DeliveryManagement::where('pod_status', 'verified')->count(),
        ];

        return view('pengiriman.management.index', compact('deliveries', 'stats'));
    }

    public function show(DeliveryManagement $deliveryManagement)
    {
        $deliveryManagement->load(['shipment', 'outbound', 'driver', 'vehicle']);
        return view('pengiriman.management.show', compact('deliveryManagement'));
    }

    public function updateStatus(Request $request, DeliveryManagement $deliveryManagement)
    {
        $validated = $request->validate([
            'delivery_status' => 'required|in:ready_to_ship,in_transit,delivered,completed',
        ]);

        $target = $validated['delivery_status'];
        $current = $deliveryManagement->delivery_status;

        // Guard transisi status agar sesuai timeline baru:
        // ready_to_ship -> in_transit -> delivered
        // Status lama seperti picked_up atau arrived_destination tetap dapat dilanjutkan ke stage visible berikutnya.
        $allowedTransitions = [
            'ready_to_ship' => ['in_transit'],
            'picked_up' => ['in_transit'],
            'in_transit' => ['delivered'],
            'arrived_destination' => ['delivered'],
            'delivered' => ['completed'],
            'completed' => [],
        ];

        if ($target === 'completed') {
            return redirect()->route('delivery-management.show', $deliveryManagement)
                ->with('error', 'Completed hanya dapat dibuat saat upload POD.');
        }

        $allowed = $allowedTransitions[$current] ?? [];
        if (!in_array($target, $allowed, true)) {
            return redirect()->route('delivery-management.show', $deliveryManagement)
                ->with('error', "Transisi status tidak valid: {$current} → {$target}.");
        }

        DB::transaction(function () use ($deliveryManagement, $target) {
            $deliveryManagement->update([
                'delivery_status' => $target,
            ]);

            if ($target === 'delivered') {
                $deliveryManagement->update(['delivered_at' => now()]);
            }

            if ($deliveryManagement->shipment) {
                $shipmentStatus = match ($target) {
                    'ready_to_ship' => Shipment::STATUS_SENT,
                    'in_transit' => Shipment::STATUS_IN_TRANSIT,
                    'delivered' => Shipment::STATUS_DELIVERED,
                    default => $deliveryManagement->shipment->shipment_status,
                };

                $deliveryManagement->shipment->update(['shipment_status' => $shipmentStatus]);
            }
        });

        return redirect()->route('delivery-management.show', $deliveryManagement)
            ->with('success', 'Status pengiriman berhasil diperbarui.');
    }

    public function uploadPOD(Request $request, DeliveryManagement $deliveryManagement)
    {
        $allowedStatuses = [
            DeliveryManagement::STATUS_IN_TRANSIT,
            DeliveryManagement::STATUS_ARRIVED_DESTINATION,
            DeliveryManagement::STATUS_DELIVERED,
        ];

        if (! in_array($deliveryManagement->delivery_status, $allowedStatuses, true)) {
            return redirect()->back()
                ->with('error', 'POD hanya dapat diupload saat status In Transit, Arrived Destination, atau Delivered.');
        }

        $validated = $request->validate([
            'receiver_name' => 'required|string',
            'receiver_photo' => 'nullable|image|max:5120',
            'delivery_notes' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('receiver_photo')) {
            $path = $request->file('receiver_photo')->store('pod/photos', 'public');
            $validated['receiver_photo'] = $path;
        }

        $validated['pod_status'] = DeliveryManagement::POD_STATUS_UPLOADED;

        if ($deliveryManagement->delivery_status === DeliveryManagement::STATUS_DELIVERED) {
            $validated['delivery_status'] = DeliveryManagement::STATUS_COMPLETED;
        } else {
            $validated['delivery_status'] = DeliveryManagement::STATUS_DELIVERED;
            $validated['delivered_at'] = now();
        }

        $deliveryManagement->update($validated);

        return redirect()->route('delivery-management.show', $deliveryManagement)
            ->with('success', 'POD berhasil diupload. Status pengiriman diperbarui.');
    }

    public function printSuratJalan(DeliveryManagement $deliveryManagement)
    {
        $deliveryManagement->load(['shipment', 'outbound', 'driver', 'vehicle']);

        // Use barryvdh/laravel-dompdf to generate PDF
        $pdf = PDF::loadView('pengiriman.management.print-surat-jalan', [
            'delivery' => $deliveryManagement
        ]);

        return $pdf->download('surat-jalan-' . $deliveryManagement->delivery_number . '.pdf');
    }

    public function printPOD(DeliveryManagement $deliveryManagement)
    {
        $deliveryManagement->load(['shipment', 'outbound', 'driver', 'vehicle']);

        $pdf = PDF::loadView('pengiriman.management.print-pod', [
            'delivery' => $deliveryManagement
        ]);

        return $pdf->download('pod-' . $deliveryManagement->delivery_number . '.pdf');
    }
}
