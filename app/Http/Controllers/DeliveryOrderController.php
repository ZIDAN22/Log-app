<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DeliveryOrder::with(['shipment', 'creator']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('delivery_order_number', 'like', "%{$search}%")
                    ->orWhere('sender_name', 'like', "%{$search}%")
                    ->orWhere('receiver_name', 'like', "%{$search}%")
                    ->orWhereHas('shipment', function ($sq) use ($search) {
                        $sq->where('receipt_number', 'like', "%{$search}%");
                    });
            });
        }

        $deliveryOrders = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('delivery-orders.index', compact('deliveryOrders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->load(['shipment', 'creator']);

        return view('delivery-orders.show', compact('deliveryOrder'));
    }

    /**
     * Generate delivery order from shipment.
     */
    public function generate(Request $request, Shipment $shipment)
    {
        // Check if delivery order already exists
        if ($shipment->deliveryOrder) {
            return redirect()->back()->with('error', 'Surat jalan sudah dibuat untuk shipment ini.');
        }

        $deliveryOrder = DeliveryOrder::create([
            'shipment_id' => $shipment->id,
            'delivery_order_number' => DeliveryOrder::generateDeliveryOrderNumber(),
            'order_date' => now()->toDateString(),
            'pickup_address' => $shipment->pickup_address,
            'destination_city' => $shipment->destination_city,
            'sender_name' => $shipment->sender_name,
            'receiver_name' => $shipment->receiver_name,
            'transportation_type' => $shipment->transportation_type,
            'notes' => $shipment->notes,
            'created_by' => auth()->id() ?? 1,
        ]);

        return redirect()->route('delivery-orders.show', $deliveryOrder)->with('success', 'Surat jalan berhasil dibuat.');
    }

    /**
     * Print PDF of delivery order.
     */
    public function printPdf(DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->load(['shipment', 'creator']);

        $pdf = Pdf::loadView('delivery-orders.pdf', compact('deliveryOrder'));

        return $pdf->download('surat-jalan-' . $deliveryOrder->delivery_order_number . '.pdf');
    }
}
