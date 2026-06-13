<?php

namespace App\Http\Controllers;

use App\Models\DeliveryManagement;
use App\Models\Driver;
use App\Models\Inbound;
use App\Models\Outbound;
use App\Models\Shipment;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user?->role ?? 'admin_operasional';

        switch ($role) {
            case 'admin_operasional':
                return $this->renderAdminOperasional();

            default:
                return $this->renderAdminOperasional();
        }
    }

    protected function renderAdminOperasional()
    {
        // Pastikan semua perhitungan waktu sesuai WIB (Asia/Jakarta)
        date_default_timezone_set('Asia/Jakarta');

        $today = Carbon::today();
        $now = Carbon::now();

        $dayNames = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $monthNames = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        $greeting = match (true) {
            $now->hour >= 5 && $now->hour < 11 => 'Selamat Pagi',
            $now->hour >= 11 && $now->hour < 15 => 'Selamat Siang',
            $now->hour >= 15 && $now->hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };

        $summary = [
            'totalShipments' => Shipment::count(),
            'shipmentToday' => Shipment::whereDate('created_at', $today)->count(),
            'inboundToday' => Inbound::whereDate('inbound_date', $today)->count(),
            'outboundToday' => Outbound::whereDate('outbound_date', $today)->count(),
            'pendingDelivery' => DeliveryManagement::where('delivery_status', DeliveryManagement::STATUS_READY_TO_SHIP)->count(),
            'delivered' => DeliveryManagement::whereIn('delivery_status', [DeliveryManagement::STATUS_DELIVERED, DeliveryManagement::STATUS_COMPLETED])->count(),
            'activeArmada' => Vehicle::where('status', Vehicle::STATUS_READY)->count(),
            'activeDriver' => Driver::where('status', Driver::STATUS_ACTIVE)->count(),
        ];

        $shipmentTrendData = Shipment::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $today->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $shipmentTrend = collect(range(5, 0))
            ->map(function (int $monthsAgo) use ($today) {
                return $today->copy()->subMonths($monthsAgo);
            })
            ->map(function (Carbon $date) use ($monthNames, $shipmentTrendData) {
                return [
                    'label' => $monthNames[(int) $date->format('m')],
                    'value' => $shipmentTrendData[(int) $date->format('m')] ?? 0,
                ];
            });

        $deliveryStatusCounts = DeliveryManagement::selectRaw(
            "CASE
                WHEN delivery_status = '" . DeliveryManagement::STATUS_READY_TO_SHIP . "' THEN 'pending'
                WHEN delivery_status = '" . DeliveryManagement::STATUS_IN_TRANSIT . "' THEN 'in_transit'
                WHEN delivery_status = '" . DeliveryManagement::STATUS_ARRIVED_DESTINATION . "' THEN 'in_transit'
                WHEN delivery_status IN ('" . DeliveryManagement::STATUS_DELIVERED . "', '" . DeliveryManagement::STATUS_COMPLETED . "') THEN 'delivered'
                ELSE 'other'
            END AS status_group, COUNT(*) as total"
        )
            ->whereIn('delivery_status', [
                DeliveryManagement::STATUS_READY_TO_SHIP,
                DeliveryManagement::STATUS_IN_TRANSIT,
                DeliveryManagement::STATUS_ARRIVED_DESTINATION,
                DeliveryManagement::STATUS_DELIVERED,
                DeliveryManagement::STATUS_COMPLETED,
            ])
            ->groupBy('status_group')
            ->pluck('total', 'status_group')
            ->toArray();

        $deliveryOverview = [
            'pending' => $deliveryStatusCounts['pending'] ?? 0,
            'in_transit' => $deliveryStatusCounts['in_transit'] ?? 0,
            'delivered' => $deliveryStatusCounts['delivered'] ?? 0,
        ];

        $recentShipments = Shipment::latest('created_at')->take(6)->get();
        $recentInbound = Inbound::latest('created_at')->with('shipment')->take(3)->get();
        $recentOutbound = Outbound::latest('created_at')->with('packingList.shipment')->take(3)->get();

        $totalArmada = Vehicle::count();
        $availableVehicle = Vehicle::where('status', Vehicle::STATUS_READY)->count();
        $onDeliveryVehicle = Vehicle::where('status', Vehicle::STATUS_USED)->count();
        $maintenanceVehicle = Vehicle::where('status', Vehicle::STATUS_MAINTENANCE)->count();

        $armadaVehicles = Vehicle::latest('id')
            ->with(['deliveryManagements' => fn ($query) => $query->with('driver')->latest('id')->limit(1)])
            ->take(6)
            ->get();

        $activeDriverCount = Driver::where('status', Driver::STATUS_ACTIVE)->count();
        $onDeliveryDriverCount = DeliveryManagement::whereIn('delivery_status', [
            DeliveryManagement::STATUS_IN_TRANSIT,
            DeliveryManagement::STATUS_ARRIVED_DESTINATION,
        ])->distinct('driver_id')->count('driver_id');

        $availableDriverCount = max($activeDriverCount - $onDeliveryDriverCount, 0);

        $driverItems = Driver::latest('id')
            ->with(['deliveryManagements' => fn ($query) => $query->with('vehicle')->latest('id')->limit(1)])
            ->take(6)
            ->get();

        $timelineEvents = collect();

        $timelineEvents = $timelineEvents->concat(
            Shipment::latest('created_at')->take(2)->get()->map(fn (Shipment $shipment) => [
                'title' => 'Pengiriman Dibuat',
                'description' => sprintf('%s menuju %s', $shipment->receipt_number, $shipment->destination_city ?? '-'),
                'time' => $shipment->created_at,
            ])
        );

        $timelineEvents = $timelineEvents->concat(
            Inbound::latest('created_at')->take(2)->with('shipment')->get()->map(fn (Inbound $inbound) => [
                'title' => 'Barang Masuk Ditambahkan',
                'description' => sprintf('Barang masuk untuk %s',  $inbound->shipment?->receiver_name ?? '-'),
                'time' => $inbound->created_at,
            ])
        );

        $timelineEvents = $timelineEvents->concat(
            Outbound::latest('created_at')->take(2)->with('packingList.shipment')->get()->map(fn (Outbound $outbound) => [
                'title' => 'Barang keluar Dibuat',
                'description' => sprintf('Barang keluar ke %s  ', $outbound->packingList->shipment->destination_city ?? '-'),
                'time' => $outbound->created_at,
            ])
        );

        $timelineEvents = $timelineEvents->concat(
            DeliveryManagement::latest('created_at')->take(2)->with(['driver', 'vehicle'])->get()->map(fn (DeliveryManagement $delivery) => [
                'title' => 'Pengiriman Diperbaharui',
                'description' => sprintf('%s %s', $delivery->driver?->name ?? 'Driver tidak ditetapkan', $delivery->delivery_status),
                'time' => $delivery->created_at,
            ])
        );

        $timeline = $timelineEvents
            ->sortByDesc('time')
            ->values()
            ->take(6);

        return view('dashboard.admin-operasional.index', compact(
            'dayNames',
            'now',
            'greeting',
            'summary',
            'shipmentTrend',
            'deliveryOverview',
            'recentShipments',
            'recentInbound',
            'recentOutbound',
            'totalArmada',
            'availableVehicle',
            'onDeliveryVehicle',
            'maintenanceVehicle',
            'armadaVehicles',
            'activeDriverCount',
            'onDeliveryDriverCount',
            'availableDriverCount',
            'driverItems',
            'timeline'
        ));
    }
}
