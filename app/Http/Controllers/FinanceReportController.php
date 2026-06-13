<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FinanceReportController extends Controller
{
    public function index(Request $request)
    {
        $paymentMethods = PaymentMethod::where('status', PaymentMethod::STATUS_ACTIVE)
            ->orderBy('method_name')
            ->get();

        $statusOptions = Invoice::PAYMENT_STATUSES;

        $query = Invoice::with(['packingList.shipment'])
            ->withSum('payment', 'amount_paid');

        $this->applyFilters($query, $request);

        $invoices = $query->orderBy('invoice_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $summary = [
            'total' => $this->countInvoices($request),
            'unpaid' => $this->countInvoices($request, Invoice::STATUS_UNPAID),
            'dp' => $this->countInvoices($request, Invoice::STATUS_DP),
            'paid' => $this->countInvoices($request, Invoice::STATUS_PAID),
            'incoming_payments' => $this->sumIncomingPayments($request),
        ];

        return view('finance-reports.index', compact(
            'invoices',
            'summary',
            'paymentMethods',
            'statusOptions'
        ));
    }

    public function exportPdf(Request $request)
    {
        $query = Invoice::with(['packingList.shipment'])
            ->withSum('payment', 'amount_paid');

        $this->applyFilters($query, $request);

        $invoices = $query->orderBy('invoice_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $summary = [
            'total' => $this->countInvoices($request),
            'unpaid' => $this->countInvoices($request, Invoice::STATUS_UNPAID),
            'dp' => $this->countInvoices($request, Invoice::STATUS_DP),
            'paid' => $this->countInvoices($request, Invoice::STATUS_PAID),
            'incoming_payments' => $this->sumIncomingPayments($request),
        ];

        $pdf = Pdf::loadView('finance-reports.pdf', compact('invoices', 'summary'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-keuangan.pdf');
    }

    private function applyFilters(Builder $query, Request $request): Builder
    {
        return $query
            ->when($request->query('search'), function (Builder $query, $search) {
                $query->where(function (Builder $sub) use ($search) {
                    $sub->where('invoice_number', 'like', "%{$search}%")
                        ->orWhere('receipt_number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%");
                });
            })
            ->when($request->query('payment_status'), function (Builder $query, $status) {
                $query->where('payment_status', $status);
            })
            ->when($request->query('payment_method'), function (Builder $query, $method) {
                $query->where('payment_method', $method);
            })
            ->when($request->query('from'), function (Builder $query, $from) {
                $query->whereDate('invoice_date', '>=', $from);
            })
            ->when($request->query('to'), function (Builder $query, $to) {
                $query->whereDate('invoice_date', '<=', $to);
            });
    }

    private function countInvoices(Request $request, ?string $status = null): int
    {
        $query = Invoice::query();
        $this->applyFilters($query, $request);

        if ($status) {
            $query->where('payment_status', $status);
        }

        return $query->count();
    }

    private function sumIncomingPayments(Request $request): float
    {
        $query = Payment::query()
            ->whereHas('invoice', function (Builder $query) use ($request) {
                $this->applyFilters($query, $request);
            });

        return (float) $query->sum('amount_paid');
    }
}
