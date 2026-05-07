<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Shipment::query();

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('receipt_number', 'like', "%{$search}%")
                    ->orWhere('sender_name', 'like', "%{$search}%")
                    ->orWhere('receiver_name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            if (in_array($status, Shipment::STATUSES, true)) {
                $query->where('shipment_status', $status);
            }
        }

        if ($from = $request->query('from')) {
            $query->whereDate('pickup_date', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->whereDate('pickup_date', '<=', $to);
        }

        $shipments = $query->orderBy('pickup_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pengiriman.index', compact('shipments'));
    }

    public function create()
    {
        return view('pengiriman.create');
    }

    public function store(StoreShipmentRequest $request)
    {
        $data = $request->validated();
        $data['shipment_status'] = Shipment::STATUS_PENDING;
        $data['created_by'] = Auth::id() ?? 1;

        Shipment::create($data);

        return redirect()->route('pengiriman.index')
            ->with('success', 'Pengiriman berhasil dibuat.');
    }

    public function show(Shipment $pengiriman)
    {
        return view('pengiriman.show', ['shipment' => $pengiriman]);
    }

    public function edit(Shipment $pengiriman)
    {
        return view('pengiriman.edit', ['shipment' => $pengiriman]);
    }

    public function update(UpdateShipmentRequest $request, Shipment $pengiriman)
    {
        $pengiriman->fill($request->validated());
        $pengiriman->save();

        return redirect()->route('pengiriman.index')
            ->with('success', 'Pengiriman berhasil diperbarui.');
    }

    public function destroy(Shipment $pengiriman)
    {
        $pengiriman->delete();

        return redirect()->route('pengiriman.index')
            ->with('success', 'Pengiriman berhasil dihapus.');
    }
}
