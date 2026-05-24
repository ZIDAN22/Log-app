<?php

namespace App\Http\Controllers;

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

    public function show(PackingList $packingList)
    {
        $packingList->load('shipment', 'items');

        return view('packing-list.show', compact('packingList'));
    }

    public function printPdf(PackingList $packingList)
    {
        $packingList->load('shipment.vehicle', 'items', 'invoice');

        $pdf = Pdf::loadView('packing-list.pdf', compact('packingList'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('packing-list-' . $packingList->id . '.pdf');
    }
}
