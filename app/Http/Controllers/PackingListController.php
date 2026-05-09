<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackingListRequest;
use App\Http\Requests\UpdatePackingListRequest;
use App\Models\PackingItem;
use App\Models\PackingList;
use App\Models\Shipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackingListController extends Controller
{
    public function index(Request $request)
    {
        $query = PackingList::with('shipment');

        if ($search = $request->query('search')) {
            $query->whereHas('shipment', function ($sub) use ($search) {
                $sub->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('receipt_number', 'like', "%{$search}%");
            });
        }

        if ($from = $request->query('from')) {
            $query->whereDate('packing_date', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->whereDate('packing_date', '<=', $to);
        }

        $packingLists = $query->orderBy('packing_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('packing-list.index', compact('packingLists'));
    }

    public function create()
    {
        $shipments = Shipment::doesntHave('packingList')
            ->orderBy('pickup_date', 'desc')
            ->get();

        return view('packing-list.create', compact('shipments'));
    }

    public function store(StorePackingListRequest $request)
    {
        $data = $request->validated();
        $shipment = Shipment::findOrFail($data['shipment_id']);

        if ($shipment->packingList) {
            return redirect()->back()->withInput()->withErrors(['shipment_id' => 'Shipment ini sudah memiliki packing list.']);
        }

        $items = collect($data['items'])->map(function ($item) {
            $qty = (int) $item['qty'];
            $unitPrice = (float) $item['unit_price'];
            $weight = (float) $item['weight'];

            return [
                'item_name' => $item['item_name'],
                'qty' => $qty,
                'packaging_type' => $item['packaging_type'],
                'unit_price' => $unitPrice,
                'subtotal_price' => round($qty * $unitPrice, 2),
                'weight' => round($weight, 2),
                'item_notes' => $item['item_notes'] ?? null,
            ];
        });

        $totalQty = $items->sum('qty');
        $totalWeight = $items->sum('weight');
        $totalValue = $items->sum('subtotal_price');
        $totalPackage = $items->count();

        DB::transaction(function () use ($data, $items, $totalQty, $totalWeight, $totalValue, $totalPackage, $shipment) {
            $packingList = PackingList::create([
                'shipment_id' => $data['shipment_id'],
                'packing_date' => $data['packing_date'],
                'notes' => $data['notes'] ?? null,
                'total_qty' => $totalQty,
                'total_weight' => $totalWeight,
                'total_value' => $totalValue,
                'total_package' => $totalPackage,
                'created_by' => Auth::id() ?? null,
            ]);

            $packingList->items()->createMany($items->toArray());

            $shipment->shipment_status = Shipment::STATUS_PACKING_COMPLETED;
            $shipment->save();
        });

        return redirect()->route('packing-list.index')
            ->with('success', 'Packing list berhasil dibuat.');
    }

    public function show(PackingList $packingList)
    {
        $packingList->load('shipment', 'items');

        return view('packing-list.show', compact('packingList'));
    }

    public function edit(PackingList $packingList)
    {
        $packingList->load('shipment', 'items');

        return view('packing-list.edit', compact('packingList'));
    }

    public function update(UpdatePackingListRequest $request, PackingList $packingList)
    {
        $data = $request->validated();

        $items = collect($data['items'])->map(function ($item) {
            $qty = (int) $item['qty'];
            $unitPrice = (float) $item['unit_price'];
            $weight = (float) $item['weight'];

            return [
                'item_name' => $item['item_name'],
                'qty' => $qty,
                'packaging_type' => $item['packaging_type'],
                'unit_price' => $unitPrice,
                'subtotal_price' => round($qty * $unitPrice, 2),
                'weight' => round($weight, 2),
                'item_notes' => $item['item_notes'] ?? null,
            ];
        });

        $totalQty = $items->sum('qty');
        $totalWeight = $items->sum('weight');
        $totalValue = $items->sum('subtotal_price');
        $totalPackage = $items->count();

        DB::transaction(function () use ($data, $items, $totalQty, $totalWeight, $totalValue, $totalPackage, $packingList) {
            $packingList->update([
                'packing_date' => $data['packing_date'],
                'notes' => $data['notes'] ?? null,
                'total_qty' => $totalQty,
                'total_weight' => $totalWeight,
                'total_value' => $totalValue,
                'total_package' => $totalPackage,
            ]);

            $packingList->items()->delete();
            $packingList->items()->createMany($items->toArray());
        });

        return redirect()->route('packing-list.show', $packingList)
            ->with('success', 'Packing list berhasil diperbarui.');
    }

    public function destroy(PackingList $packingList)
    {
        $packingList->delete();

        return redirect()->route('packing-list.index')
            ->with('success', 'Packing list berhasil dihapus.');
    }

    public function printPdf(PackingList $packingList)
    {
        $packingList->load('shipment', 'items');

        $pdf = Pdf::loadView('packing-list.pdf', compact('packingList'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('packing-list-' . $packingList->id . '.pdf');
    }
}
