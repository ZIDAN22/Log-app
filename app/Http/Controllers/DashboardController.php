<?php

namespace App\Http\Controllers;

use App\Models\DeliveryManagement;
use App\Models\Driver;
use App\Models\Inbound;
use App\Models\Invoice;
use App\Models\Outbound;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user?->role ?? User::ROLE_ADMIN_OPERASIONAL;

        return match ($role) {
            User::ROLE_MANAGER => $this->renderSuperAdmin(),
            User::ROLE_ADMIN_OPERASIONAL => $this->renderAdminOperasional(),
            User::ROLE_WAREHOUSE => $this->renderWarehouse(),
            User::ROLE_FINANCE => $this->renderFinance(),
            default => $this->renderAdminOperasional(),
        };
    }

    protected function renderSuperAdmin()
    {
        return view('dashboard.super-admin.index');
    }

    protected function renderWarehouse()
    {
        return view('dashboard.warehouse.index');
    }

    protected function renderFinance()
    {
        date_default_timezone_set('Asia/Jakarta');

        $today = Carbon::today();
        $now = Carbon::now();
        $currentYear = $today->year;

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

        $totalInvoices = Invoice::count();
        $totalPaymentsReceived = Payment::sum('amount_paid');
        $pendingPayments = Payment::where('status', Payment::STATUS_PENDING)->count();
        $verifiedPayments = Payment::where('status', Payment::STATUS_VERIFIED)->count();

        $currentMonthInvoices = Invoice::whereYear('invoice_date', $currentYear)
            ->whereMonth('invoice_date', $today->month)
            ->count();

        $monthlyPaymentTotals = Payment::selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total')
            ->whereYear('payment_date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyPaymentTrend = collect(range(5, 0))
            ->map(fn (int $monthsAgo) => $today->copy()->subMonths($monthsAgo))
            ->map(function (Carbon $date) use ($monthNames, $monthlyPaymentTotals) {
                $month = (int) $date->format('m');

                return [
                    'label' => $monthNames[$month],
                    'value' => round($monthlyPaymentTotals[$month] ?? 0, 2),
                ];
            });

        $invoiceStatusCounts = Invoice::selectRaw('payment_status, COUNT(*) as total')
            ->groupBy('payment_status')
            ->pluck('total', 'payment_status')
            ->toArray();

        $paymentMethodUsage = Invoice::selectRaw('payment_method, COUNT(*) as total')
            ->whereNotNull('payment_method')
            ->groupBy('payment_method')
            ->orderByDesc('total')
            ->limit(6)
            ->pluck('total', 'payment_method')
            ->toArray();

        $outstandingInvoiceQuery = Invoice::withSum('payment', 'amount_paid')
            ->whereIn('payment_status', [Invoice::STATUS_UNPAID, Invoice::STATUS_DP]);

        $outstandingInvoiceCount = $outstandingInvoiceQuery->count();

        $outstandingBalance = $outstandingInvoiceQuery->get()
            ->sum(fn (Invoice $invoice) => max(0, $invoice->grand_total - ($invoice->payment_sum_amount_paid ?? 0)));

        $topOutstandingInvoices = $outstandingInvoiceQuery
            ->orderByDesc('grand_total')
            ->take(3)
            ->get();

        $outstandingCustomerBalances = Invoice::selectRaw('customer_name, SUM(grand_total - COALESCE(payments.amount_paid, 0)) as balance')
            ->leftJoin('payments', 'payments.invoice_id', '=', 'invoices.id')
            ->whereIn('payment_status', [Invoice::STATUS_UNPAID, Invoice::STATUS_DP])
            ->groupBy('customer_name')
            ->orderByDesc('balance')
            ->limit(6)
            ->pluck('balance', 'customer_name');

        $recentInvoices = Invoice::withSum('payment', 'amount_paid')
            ->latest('invoice_date')
            ->take(6)
            ->get();

        $recentPayments = Payment::with('invoice')
            ->latest('payment_date')
            ->take(6)
            ->get();

        return view('dashboard.finance.index', compact(
            'greeting',
            'totalInvoices',
            'totalPaymentsReceived',
            'pendingPayments',
            'verifiedPayments',
            'outstandingBalance',
            'outstandingInvoiceCount',
            'currentMonthInvoices',
            'monthlyPaymentTrend',
            'invoiceStatusCounts',
            'paymentMethodUsage',
            'topOutstandingInvoices',
            'outstandingCustomerBalances',
            'recentInvoices',
            'recentPayments'
        ));
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
