<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Exports\ShipmentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Vehicle;
use App\Models\Driver;
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

        // Eager-load relasi deliveryManagement agar status bisa ditampilkan (ready_to_ship → in_transit → delivered/completed)
        $query = $query->with(['deliveryOrder', 'deliveryManagement']);

        // handle export requests
        $export = $request->query('export');

        if ($export === 'xlsx') {
            $items = $query->orderBy('pickup_date', 'desc')->orderBy('created_at', 'desc')->get();
            $filename = 'pengiriman-' . now()->format('YmdHis') . '.xlsx';

            return Excel::download(new ShipmentsExport($items), $filename);
        }

        if ($export === 'csv') {
            $rows = [];

            // header row
            $rows[] = [
                'Invoice Number', 'Receipt Number', 'Sender', 'Receiver', 'Destination City', 'Transportation', 'Shipping Subtotal', 'Status', 'Pickup Date', 'Created At'
            ];

            $items = $query->orderBy('pickup_date', 'desc')->orderBy('created_at', 'desc')->get();

            foreach ($items as $shipment) {
                $rows[] = [
                    $shipment->invoice_number,
                    $shipment->receipt_number,
                    $shipment->sender_name,
                    $shipment->receiver_name,
                    $shipment->destination_city,
                    ucfirst($shipment->transportation_type),
                    'Rp ' . number_format($shipment->shipping_subtotal, 0, ',', '.'),
                    $shipment->shipment_status,
                    optional($shipment->pickup_date)->format('Y-m-d'),
                    optional($shipment->created_at)->format('Y-m-d H:i:s'),
                ];
            }

            $filename = 'pengiriman-' . now()->format('YmdHis') . '.csv';

            $callback = function () use ($rows) {
                $FH = fopen('php://output', 'w');
                // write BOM for Excel compatibility with UTF-8
                fwrite($FH, chr(0xEF) . chr(0xBB) . chr(0xBF));
                foreach ($rows as $row) {
                    $safe = array_map(function ($cell) {
                        if (is_string($cell) && preg_match('/^[=+\-@]/', $cell)) {
                            return "'" . $cell;
                        }
                        return $cell;
                    }, $row);
                    fputcsv($FH, $safe);
                }
                fclose($FH);
            };

            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ];

            return response()->stream($callback, 200, $headers);
        }

        $shipments = $query->orderBy('pickup_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pengiriman.index', compact('shipments'));
    }

    public function management()
    {
        return view('pengiriman.manage');
    }

    public function create()
    {
        $vehicles = Vehicle::orderBy('name')->get();
        $drivers = Driver::where('status', Driver::STATUS_ACTIVE)->orderBy('name')->get();

        return view('pengiriman.create', compact('vehicles', 'drivers'));
    }

    public function store(StoreShipmentRequest $request)
    {
        $data = $request->validated();
        $data['shipment_status'] = Shipment::STATUS_PENDING;
        $data['created_by'] = Auth::id();

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
        $vehicles = Vehicle::orderBy('name')->get();
        $drivers = Driver::where('status', Driver::STATUS_ACTIVE)->orderBy('name')->get();

        return view('pengiriman.edit', [
            'shipment' => $pengiriman,
            'vehicles' => $vehicles,
            'drivers' => $drivers,
        ]);
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
