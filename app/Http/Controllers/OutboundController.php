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

        // If packing list has a shipment, apply shipment transport updates from the form
        $packingList = PackingList::with('shipment')->find($data['packing_list_id'] ?? null);

        $shipmentInput = $request->input('shipment', []);
        if ($request->has('driver_id')) {
            $shipmentInput['driver_id'] = $request->input('driver_id');
        }
        if ($request->has('vehicle_id')) {
            $shipmentInput['vehicle_id'] = $request->input('vehicle_id');
        }

        if ($packingList && $packingList->shipment && is_array($shipmentInput) && count($shipmentInput)) {
            $allowed = [
                'transportation_type', 'driver_id', 'vehicle_id', 'shipping_day', 'sea_shipping', 'air_shipping',
                'land_departure_date', 'sea_departure_date', 'air_departure_date',
            ];

            $toUpdate = [];
            foreach ($allowed as $key) {
                if (array_key_exists($key, $shipmentInput)) {
                    $toUpdate[$key] = $shipmentInput[$key];
                }
            }

            // If outbound method is sea/air we ensure shipment driver/vehicle are nullified
            if (in_array($data['shipping_method'], [Outbound::SHIPPING_METHOD_SEA, Outbound::SHIPPING_METHOD_AIR], true)) {
                $toUpdate['driver_id'] = null;
                $toUpdate['vehicle_id'] = null;
            }

            if (count($toUpdate)) {
                $packingList->shipment->update($toUpdate);
            }
        }

        $outbound = Outbound::create($data);

        if ($packingList && $packingList->shipment) {
            $packingList->shipment->update(['shipment_status' => Shipment::STATUS_SENT]);
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
