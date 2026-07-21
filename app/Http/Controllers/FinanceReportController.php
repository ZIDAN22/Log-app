<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
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

        $query = Invoice::with(['packingList.shipment', 'paymentMethod'])
            ->withSum('payment', 'amount_paid');

        $this->applyFilters($query, $request);

        // Handle export request (csv/xlsx). CSV implemented as streaming response; XLSX via maatwebsite/excel.
        $export = $request->query('export');

        if ($export === 'xlsx') {
            $items = $query->orderBy('invoice_date', 'desc')->orderBy('created_at', 'desc')->get();
            $filename = 'laporan-keuangan-' . now()->format('YmdHis') . '.xlsx';

            return Excel::download(new InvoicesExport($items), $filename);
        }

        if ($export === 'csv') {
            $rows = [];

            // header row
            $rows[] = [
                'Invoice Number', 'Receipt Number', 'Customer', 'Payment Method', 'Total Invoice', 'Amount Paid', 'Remaining', 'Invoice Date', 'Due Date', 'Status'
                ];

                $items = $query->orderBy('invoice_date', 'desc')->orderBy('created_at', 'desc')->get();

                foreach ($items as $invoice) {
                    $amountPaid = $invoice->payment_sum_amount_paid ?? 0;
                    $remaining = max(0, $invoice->grand_total - $amountPaid);

                    $rows[] = [
                        $invoice->invoice_number,
                        $invoice->receipt_number,
                        $invoice->customer_name,
                        $invoice->payment_method_display ?? $invoice->payment_method ?? '-',
                        'Rp ' . number_format($invoice->grand_total, 0, ',', '.'),
                        'Rp ' . number_format($amountPaid, 0, ',', '.'),
                        'Rp ' . number_format($remaining, 0, ',', '.'),
                        optional($invoice->invoice_date)->format('Y-m-d'),
                        $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '-',
                        $invoice->payment_status,
                    ];
                }

            $filename = 'laporan-keuangan-' . now()->format('YmdHis') . '.csv';

            // Stream CSV content
            $callback = function () use ($rows) {
                $FH = fopen('php://output', 'w');
                // write BOM for Excel compatibility with UTF-8
                fwrite($FH, chr(0xEF) . chr(0xBB) . chr(0xBF));
                foreach ($rows as $row) {
                    // convert any value that begins with =+-@ to prevent CSV injection
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
