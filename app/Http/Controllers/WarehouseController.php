<?php

namespace App\Http\Controllers;

use App\Models\Inbound;
use App\Models\Outbound;
use App\Models\PackingList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WarehouseExport;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $activityType = $request->query('activity_type');
        $activitySearch = $request->query('activity_search');
        $chartTimeframe = $request->query('chart_timeframe', 'monthly');

        $totalInbounds = Inbound::count();
        $totalPackingLists = PackingList::count();
        $totalOutbounds = Outbound::count();
        $warehouseStock = PackingList::doesntHave('outbound')->count();

        $lowStockThreshold = 10;
        $lowStockAlert = $warehouseStock > 0 && $warehouseStock <= $lowStockThreshold;

        $readyToShipOutbounds = Outbound::where('status', Outbound::STATUS_READY_TO_SHIP)->count();
        $inTransitOutbounds = Outbound::where('status', Outbound::STATUS_IN_TRANSIT)->count();
        $deliveredOutbounds = Outbound::where('status', Outbound::STATUS_DELIVERED)->count();
        $packingConversionRate = $totalPackingLists > 0 ? round(($totalOutbounds / $totalPackingLists) * 100) : 0;

        $weeklyPeriods = collect(range(5, 0, -1))->map(function ($weeksAgo) {
            return Carbon::now()->subWeeks($weeksAgo)->startOfWeek(Carbon::MONDAY);
        });
        $weeklyLabels = $weeklyPeriods->map(function ($week) {
            return $week->format('d M') . ' - ' . $week->copy()->endOfWeek(Carbon::SUNDAY)->format('d M');
        })->toArray();
        $weeklyKeys = $weeklyPeriods->map(fn ($week) => $week->format('o-W'))->toArray();

        $months = collect(range(5, 0, -1))->map(fn ($monthsAgo) => now()->subMonths($monthsAgo)->startOfMonth());
        $monthLabels = $months->map(fn ($month) => $month->format('M Y'))->toArray();
        $monthKeys = $months->map(fn ($month) => $month->format('Y-m'))->toArray();

        $quarterPeriods = collect(range(3, 0, -1))->map(fn ($quartersAgo) => now()->subMonths($quartersAgo * 3)->startOfQuarter());
        $quarterLabels = $quarterPeriods->map(fn ($quarter) => 'Q' . ceil($quarter->month / 3) . ' ' . $quarter->format('Y'))->toArray();
        $quarterKeys = $quarterPeriods->map(fn ($quarter) => $quarter->format('Y') . '-Q' . ceil($quarter->month / 3))->toArray();

        $inboundWeekly = Inbound::whereDate('inbound_date', '>=', $weeklyPeriods->first())
            ->get(['inbound_date'])
            ->groupBy(fn ($item) => $item->inbound_date->copy()->startOfWeek(Carbon::MONDAY)->format('o-W'))
            ->map->count()
            ->toArray();

        $packingWeekly = PackingList::whereDate('packing_date', '>=', $weeklyPeriods->first())
            ->get(['packing_date'])
            ->groupBy(fn ($item) => $item->packing_date->copy()->startOfWeek(Carbon::MONDAY)->format('o-W'))
            ->map->count()
            ->toArray();

        $outboundWeekly = Outbound::whereDate('outbound_date', '>=', $weeklyPeriods->first())
            ->get(['outbound_date'])
            ->groupBy(fn ($item) => $item->outbound_date->copy()->startOfWeek(Carbon::MONDAY)->format('o-W'))
            ->map->count()
            ->toArray();

        $inboundMonthly = Inbound::whereDate('inbound_date', '>=', $months->first())
            ->get(['inbound_date'])
            ->groupBy(fn ($item) => $item->inbound_date->copy()->format('Y-m'))
            ->map->count()
            ->toArray();

        $packingMonthly = PackingList::whereDate('packing_date', '>=', $months->first())
            ->get(['packing_date'])
            ->groupBy(fn ($item) => $item->packing_date->copy()->format('Y-m'))
            ->map->count()
            ->toArray();

        $outboundMonthly = Outbound::whereDate('outbound_date', '>=', $months->first())
            ->get(['outbound_date'])
            ->groupBy(fn ($item) => $item->outbound_date->copy()->format('Y-m'))
            ->map->count()
            ->toArray();

        $inboundQuarterly = Inbound::whereDate('inbound_date', '>=', $quarterPeriods->first())
            ->get(['inbound_date'])
            ->groupBy(fn ($item) => $item->inbound_date->copy()->startOfQuarter()->format('Y') . '-Q' . ceil($item->inbound_date->copy()->startOfQuarter()->month / 3))
            ->map->count()
            ->toArray();

        $packingQuarterly = PackingList::whereDate('packing_date', '>=', $quarterPeriods->first())
            ->get(['packing_date'])
            ->groupBy(fn ($item) => $item->packing_date->copy()->startOfQuarter()->format('Y') . '-Q' . ceil($item->packing_date->copy()->startOfQuarter()->month / 3))
            ->map->count()
            ->toArray();

        $outboundQuarterly = Outbound::whereDate('outbound_date', '>=', $quarterPeriods->first())
            ->get(['outbound_date'])
            ->groupBy(fn ($item) => $item->outbound_date->copy()->startOfQuarter()->format('Y') . '-Q' . ceil($item->outbound_date->copy()->startOfQuarter()->month / 3))
            ->map->count()
            ->toArray();

        $inboundWeeklyData = collect($weeklyKeys)->map(fn ($key) => $inboundWeekly[$key] ?? 0)->toArray();
        $packingWeeklyData = collect($weeklyKeys)->map(fn ($key) => $packingWeekly[$key] ?? 0)->toArray();
        $outboundWeeklyData = collect($weeklyKeys)->map(fn ($key) => $outboundWeekly[$key] ?? 0)->toArray();

        $inboundMonthlyData = collect($monthKeys)->map(fn ($key) => $inboundMonthly[$key] ?? 0)->toArray();
        $packingMonthlyData = collect($monthKeys)->map(fn ($key) => $packingMonthly[$key] ?? 0)->toArray();
        $outboundMonthlyData = collect($monthKeys)->map(fn ($key) => $outboundMonthly[$key] ?? 0)->toArray();

        $inboundQuarterlyData = collect($quarterKeys)->map(fn ($key) => $inboundQuarterly[$key] ?? 0)->toArray();
        $packingQuarterlyData = collect($quarterKeys)->map(fn ($key) => $packingQuarterly[$key] ?? 0)->toArray();
        $outboundQuarterlyData = collect($quarterKeys)->map(fn ($key) => $outboundQuarterly[$key] ?? 0)->toArray();

        $recentInbounds = Inbound::with('shipment')
            ->latest('inbound_date')
            ->limit(5)
            ->get();

        $recentPackingLists = PackingList::with('shipment')
            ->latest('packing_date')
            ->limit(5)
            ->get();

        $recentOutbounds = Outbound::with('packingList.shipment')
            ->latest('outbound_date')
            ->limit(5)
            ->get();

        $recentActivities = collect()
            ->concat($recentInbounds->map(fn ($inbound) => [
                'type' => 'Inbound',
                'reference' => $inbound->shipment->receipt_number,
                'description' => 'Barang masuk ' . $inbound->total_qty . ' pcs dari ' . $inbound->shipment->sender_name,
                'date' => $inbound->inbound_date,
                'status' => 'Selesai',
            ]))
            ->concat($recentPackingLists->map(fn ($packingList) => [
                'type' => 'Packing List',
                'reference' => $packingList->shipment->receipt_number,
                'description' => 'Packing list siap cek, paket ' . $packingList->total_package,
                'date' => $packingList->packing_date,
                'status' => 'Tersedia',
            ]))
            ->concat($recentOutbounds->map(fn ($outbound) => [
                'type' => 'Outbound',
                'reference' => $outbound->packingList->shipment->receipt_number,
                'description' => 'Barang keluar ke ' . $outbound->packingList->shipment->receiver_name,
                'date' => $outbound->outbound_date,
                'status' => $outbound->status,
            ]));

        if ($activityType) {
            $recentActivities = $recentActivities->filter(fn ($activity) => $activity['type'] === $activityType);
        }

        if ($activitySearch) {
            $search = Str::lower($activitySearch);
            $recentActivities = $recentActivities->filter(fn ($activity) =>
                Str::contains(Str::lower($activity['reference'] . ' ' . $activity['description']), $search)
            );
        }

        $recentActivities = $recentActivities->sortByDesc('date')->values()->take(8);
        $activityTypes = ['Inbound', 'Packing List', 'Outbound'];

        return view('warehouse.index', compact(
            'totalInbounds',
            'totalPackingLists',
            'totalOutbounds',
            'warehouseStock',
            'lowStockAlert',
            'lowStockThreshold',
            'readyToShipOutbounds',
            'inTransitOutbounds',
            'deliveredOutbounds',
            'packingConversionRate',
            'chartTimeframe',
            'weeklyLabels',
            'monthLabels',
            'quarterLabels',
            'inboundWeeklyData',
            'packingWeeklyData',
            'outboundWeeklyData',
            'inboundMonthlyData',
            'packingMonthlyData',
            'outboundMonthlyData',
            'inboundQuarterlyData',
            'packingQuarterlyData',
            'outboundQuarterlyData',
            'recentInbounds',
            'recentPackingLists',
            'recentOutbounds',
            'recentActivities',
            'activityTypes',
            'activityType',
            'activitySearch'
        ));
    }

    /**
     * Export warehouse reports (inbound, packing list, outbound) to Excel or CSV.
     * Query params: type = inbound|packing|outbound, format = xlsx|csv (optional, default xlsx)
     */
    public function export(Request $request)
    {
        $type = $request->query('type', 'inbound');
        $format = $request->query('format', 'xlsx');

        $now = now()->format('Ymd_His');

        switch ($type) {
            case 'packing':
            case 'packing_list':
                $items = \App\Models\PackingList::with('shipment', 'createdBy')->get()->map(function ($p) {
                    return [
                        'ID' => $p->id,
                        'Packing Date' => optional($p->packing_date)->format('Y-m-d'),
                        'Receipt Number' => optional($p->shipment)->receipt_number,
                        'Receiver' => optional($p->shipment)->receiver_name,
                        'Total Qty' => $p->total_qty,
                        'Total Package' => $p->total_package,
                        'Total Weight' => $p->total_weight,
                        'Total Value' => $p->total_value,
                        'Created By' => optional($p->createdBy)->name,
                        'Notes' => $p->notes,
                    ];
                });

                $headings = [
                    'ID', 'Packing Date', 'Receipt Number', 'Receiver', 'Total Qty', 'Total Package', 'Total Weight', 'Total Value', 'Created By', 'Notes'
                ];

                $filename = "packing_list_report_{$now}.{$format}";
                break;

            case 'outbound':
                $items = \App\Models\Outbound::with('packingList.shipment', 'driver', 'vehicle', 'packingList.createdBy')->get()->map(function ($o) {
                    return [
                        'ID' => $o->id,
                        'Outbound Date' => optional($o->outbound_date)->format('Y-m-d'),
                        'Receipt Number' => optional($o->packingList->shipment)->receipt_number,
                        'Receiver' => optional($o->packingList->shipment)->receiver_name,
                        'Shipping Method' => $o->shipping_method,
                        'Status' => $o->status,
                        'Driver' => optional($o->driver)->name,
                        'Vehicle' => optional($o->vehicle)->license_plate ?? optional($o->vehicle)->name,
                        'Created By' => optional($o->packingList->createdBy)->name,
                        'Delivery Notes' => $o->delivery_notes,
                    ];
                });

                $headings = [
                    'ID', 'Outbound Date', 'Receipt Number', 'Receiver', 'Shipping Method', 'Status', 'Driver', 'Vehicle', 'Created By', 'Delivery Notes'
                ];

                $filename = "outbound_report_{$now}.{$format}";
                break;

            case 'inbound':
            default:
                $items = \App\Models\Inbound::with('shipment', 'createdBy')->get()->map(function ($i) {
                    return [
                        'ID' => $i->id,
                        'Inbound Date' => optional($i->inbound_date)->format('Y-m-d'),
                        'Receipt Number' => optional($i->shipment)->receipt_number,
                        'Sender' => optional($i->shipment)->sender_name,
                        'Total Qty' => $i->total_qty,
                        'Total Package' => $i->total_package,
                        'Total Weight' => $i->total_weight,
                        'Created By' => optional($i->createdBy)->name,
                        'Notes' => $i->notes,
                    ];
                });

                $headings = [
                    'ID', 'Inbound Date', 'Receipt Number', 'Sender', 'Total Qty', 'Total Package', 'Total Weight', 'Created By', 'Notes'
                ];

                $filename = "inbound_report_{$now}.{$format}";
                break;
        }

        // Use WarehouseExport to export collection
        return Excel::download(new WarehouseExport(collect($items), $headings), $filename);
    }
}

