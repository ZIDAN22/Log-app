<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOutboundRequest;
use App\Http\Requests\UpdateOutboundRequest;
use App\Models\Driver;
use App\Models\PackingList;
use App\Models\Outbound;
use App\Models\Shipment;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutboundController extends Controller
{
    public function index(Request $request)
    {
        $query = Outbound::with(['packingList.shipment', 'driver', 'vehicle']);

        if ($search = $request->query('search')) {
            $query->whereHas('packingList.shipment', function ($sub) use ($search) {
                $sub->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('receipt_number', 'like', "%{$search}%")
                    ->orWhere('sender_name', 'like', "%{$search}%")
                    ->orWhere('receiver_name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            if (in_array($status, Outbound::statuses(), true)) {
                $query->where('status', $status);
            }
        }

        if ($method = $request->query('method')) {
            if (in_array($method, Outbound::shippingMethods(), true)) {
                $query->where('shipping_method', $method);
            }
        }

        $outbounds = $query->orderBy('outbound_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Outbound::count(),
            'ready' => Outbound::where('status', Outbound::STATUS_READY_TO_SHIP)->count(),
            'inTransit' => Outbound::where('status', Outbound::STATUS_IN_TRANSIT)->count(),
            'delivered' => Outbound::where('status', Outbound::STATUS_DELIVERED)->count(),
        ];

        return view('warehouse.outbound.index', compact('outbounds', 'stats'));
    }

    public function create(Request $request)
    {
        $packingLists = PackingList::doesntHave('outbound')
            ->with('shipment')
            ->orderBy('packing_date', 'desc')
            ->get();

        $selectedPackingList = null;

        if ($request->query('packing_list_id')) {
            $selectedPackingList = $packingLists->firstWhere('id', $request->query('packing_list_id')) ?? PackingList::with(['shipment', 'items'])->find($request->query('packing_list_id'));
        }

        $drivers = Driver::where('status', Driver::STATUS_ACTIVE)
            ->orderBy('name')
            ->get();

        $vehicles = Vehicle::where('status', Vehicle::STATUS_READY)
            ->orderBy('name')
            ->get();

        return view('warehouse.outbound.create', compact('packingLists', 'selectedPackingList', 'drivers', 'vehicles'));
    }

    public function store(StoreOutboundRequest $request)
    {
        $data = $request->validated();

        if (in_array($data['shipping_method'], [Outbound::SHIPPING_METHOD_SEA, Outbound::SHIPPING_METHOD_AIR], true)) {
            $data['driver_id'] = null;
            $data['vehicle_id'] = null;
        }

        $data['created_by'] = Auth::id();
        $data['status'] = Outbound::STATUS_READY_TO_SHIP;

        $packingList = PackingList::with('shipment')->find($data['packing_list_id'] ?? null);

        $outbound = Outbound::create($data);

        // Update shipment dengan data transportasi jika ada
        if ($packingList && $packingList->shipment) {
            $shipmentData = ['shipment_status' => Shipment::STATUS_SENT];
            
            // Update transportation data dari request
            if (isset($data['shipment'])) {
                $shipmentData = array_merge($shipmentData, $data['shipment']);
            }
            
            $packingList->shipment->update($shipmentData);
        }

        return redirect()->route('warehouse.outbound.index')
            ->with('success', 'Outbound berhasil dibuat. Surat jalan sudah tersedia.');
    }

    public function show(Outbound $outbound)
    {
        $outbound->load(['packingList.shipment', 'packingList.items', 'driver', 'vehicle']);

        return view('warehouse.outbound.show', compact('outbound'));
    }

    public function edit(Outbound $outbound)
    {
        $outbound->load(['packingList.shipment', 'packingList.items', 'driver', 'vehicle']);

        $drivers = Driver::where('status', Driver::STATUS_ACTIVE)
            ->orderBy('name')
            ->get();

        $vehicles = Vehicle::where('status', Vehicle::STATUS_READY)
            ->orderBy('name')
            ->get();

        return view('warehouse.outbound.edit', compact('outbound', 'drivers', 'vehicles'));
    }

    public function update(UpdateOutboundRequest $request, Outbound $outbound)
    {
        $data = $request->validated();

        if (in_array($data['shipping_method'], [Outbound::SHIPPING_METHOD_SEA, Outbound::SHIPPING_METHOD_AIR], true)) {
            $data['driver_id'] = null;
            $data['vehicle_id'] = null;
        }

        $outbound->update($data);

        // Update shipment dengan data transportasi yang baru
        if ($outbound->packingList && $outbound->packingList->shipment) {
            $shipmentData = [];
            
            // Update transportation fields dari request
            if ($request->filled('sea_shipping')) {
                $shipmentData['sea_shipping'] = $data['sea_shipping'];
            }
            if ($request->filled('sea_departure_date')) {
                $shipmentData['sea_departure_date'] = $data['sea_departure_date'];
            }
            if ($request->filled('air_shipping')) {
                $shipmentData['air_shipping'] = $data['air_shipping'];
            }
            if ($request->filled('air_departure_date')) {
                $shipmentData['air_departure_date'] = $data['air_departure_date'];
            }
            if ($request->filled('land_departure_date')) {
                $shipmentData['land_departure_date'] = $data['land_departure_date'];
            }

            if (!empty($shipmentData)) {
                $outbound->packingList->shipment->update($shipmentData);
            }
        }

        return redirect()->route('warehouse.outbound.show', $outbound)
            ->with('success', 'Outbound berhasil diperbarui.');
    }

    public function destroy(Outbound $outbound)
    {
        // Saat outbound dihapus, delivery management yang terkait juga harus terhapus.
        // delivery_managements.outbound_id memakai onDelete('set null'), jadi kita hapus manual agar data delivery management ikut hilang.
        // Hapus relasi terkait agar benar-benar bersih (termasuk SoftDeletes).
        // 1) Hapus delivery management (force delete karena user ingin hilang total dari database)
        $outbound->deliveryManagement()->forceDelete();


        // 2) Hapus outbound sendiri (force delete karena user ingin benar-benar hilang)
        $outbound->forceDelete();


        return redirect()->route('warehouse.outbound.index')
            ->with('success', 'Outbound berhasil dihapus.');
    }



}
