<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInboundRequest;
use App\Http\Requests\UpdateInboundRequest;
use App\Models\Inbound;
use App\Models\InboundItem;
use App\Models\PackingItem;
use App\Models\PackingList;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InboundController extends Controller
{
    public function index(Request $request)
    {
        $query = Inbound::with('shipment');

        if ($search = $request->query('search')) {
            $query->whereHas('shipment', function ($sub) use ($search) {
                $sub->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('receipt_number', 'like', "%{$search}%");
            });
        }

        if ($from = $request->query('from')) {
            $query->whereDate('inbound_date', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->whereDate('inbound_date', '<=', $to);
        }

        $inbounds = $query->orderBy('inbound_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('inbound.index', compact('inbounds'));
    }

    public function create()
    {
        $shipments = Shipment::doesntHave('inbound')
            ->orderBy('pickup_date', 'desc')
            ->get();

        return view('inbound.create', compact('shipments'));
    }

    public function store(StoreInboundRequest $request)
    {
        $data = $request->validated();
        $shipment = Shipment::findOrFail($data['shipment_id']);

        if ($shipment->inbound) {
            return redirect()->back()->withInput()->withErrors(['shipment_id' => 'Shipment ini sudah memiliki inbound.']);
        }

        $items = collect($data['items'])->map(function ($item) {
            $qty = (int) $item['qty'];
            $weight = (float) $item['weight'];
            $totalPackaging = (int) $item['total_packaging'];
            $unitPrice = (float) $item['unit_price'];

            return [
                'item_name' => $item['item_name'],
                'qty' => $qty,
                'packaging_type' => $item['packaging_type'],
                'total_packaging' => $totalPackaging,
                'unit_price' => round($unitPrice, 2),
                'subtotal_price' => round($qty * $unitPrice, 2),
                'weight' => round($weight, 2),
                'item_notes' => $item['item_notes'] ?? null,
            ];
        });

        $totalQty = $items->sum('qty');
        $totalWeight = $items->sum('weight');
        $totalPackage = $items->sum('total_packaging');

        DB::transaction(function () use ($data, $items, $totalQty, $totalWeight, $totalPackage, $shipment) {
            $inbound = Inbound::create([
                'shipment_id' => $data['shipment_id'],
                'inbound_date' => $data['inbound_date'],
                'notes' => $data['notes'] ?? null,
                'total_qty' => $totalQty,
                'total_weight' => $totalWeight,
                'total_package' => $totalPackage,
                'created_by' => Auth::id() ?? null,
            ]);

            $inbound->items()->createMany($items->toArray());

            // Update shipment status
            $shipment->shipment_status = Shipment::STATUS_INBOUND_COMPLETED;
            $shipment->save();

            // Auto create packing list from inbound items
            $totalValue = $items->sum('subtotal_price');

            $packingList = PackingList::create([
                'shipment_id' => $data['shipment_id'],
                'packing_date' => $data['inbound_date'], // or today
                'notes' => $data['notes'] ?? null,
                'total_qty' => $totalQty,
                'total_weight' => $totalWeight,
                'total_value' => $totalValue,
                'total_package' => $totalPackage,
                'created_by' => Auth::id() ?? null,
            ]);

            $packingList->items()->createMany($items->toArray());

            // Update shipment status to packing completed
            $shipment->shipment_status = Shipment::STATUS_PACKING_COMPLETED;
            $shipment->save();
        });

        return redirect()->route('inbound.index')
            ->with('success', 'Inbound berhasil dibuat dan packing list otomatis dibuat.');
    }

    public function show(Inbound $inbound)
    {
        $inbound->load('shipment', 'items');

        return view('inbound.show', compact('inbound'));
    }

    public function edit(Inbound $inbound)
    {
        $inbound->load('shipment', 'items');

        return view('inbound.edit', compact('inbound'));
    }

    public function update(UpdateInboundRequest $request, Inbound $inbound)
    {
        $data = $request->validated();

        $items = collect($data['items'])->map(function ($item) {
            $qty = (int) $item['qty'];
            $weight = (float) $item['weight'];
            $totalPackaging = (int) $item['total_packaging'];
            $unitPrice = (float) $item['unit_price'];

            return [
                'item_name' => $item['item_name'],
                'qty' => $qty,
                'packaging_type' => $item['packaging_type'],
                'total_packaging' => $totalPackaging,
                'unit_price' => round($unitPrice, 2),
                'subtotal_price' => round($qty * $unitPrice, 2),
                'weight' => round($weight, 2),
                'item_notes' => $item['item_notes'] ?? null,
            ];
        });

        $totalQty = $items->sum('qty');
        $totalWeight = $items->sum('weight');
        $totalPackage = $items->sum('total_packaging');

        DB::transaction(function () use ($data, $items, $totalQty, $totalWeight, $totalPackage, $inbound) {
            $inbound->update([
                'inbound_date' => $data['inbound_date'],
                'notes' => $data['notes'] ?? null,
                'total_qty' => $totalQty,
                'total_weight' => $totalWeight,
                'total_package' => $totalPackage,
            ]);

            $inbound->items()->delete();
            $inbound->items()->createMany($items->toArray());

            if ($packingList = $inbound->shipment->packingList) {
                $packingList->update([
                    'packing_date' => $data['inbound_date'],
                    'notes' => $data['notes'] ?? null,
                    'total_qty' => $totalQty,
                    'total_weight' => $totalWeight,
                    'total_value' => $items->sum('subtotal_price'),
                    'total_package' => $totalPackage,
                ]);
                $packingList->items()->delete();
                $packingList->items()->createMany($items->toArray());
            }
        });

        return redirect()->route('inbound.show', $inbound)
            ->with('success', 'Inbound berhasil diperbarui.');
    }

    public function destroy(Inbound $inbound)
    {
        $inbound->delete();

        return redirect()->route('inbound.index')
            ->with('success', 'Inbound berhasil dihapus.');
    }
}
