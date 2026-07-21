<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InvoicesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting
{
    protected Collection $items;

    public function __construct(Collection $items)
    {
        $this->items = $items;
    }

    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return [
            'Invoice Number',
            'Receipt Number',
            'Customer',
            'Payment Method',
            'Total Invoice',
            'Amount Paid',
            'Remaining',
            'Invoice Date',
            'Due Date',
            'Status',
        ];
    }

    public function map($invoice): array
    {
        $amountPaid = $invoice->payment_sum_amount_paid ?? 0;
        $remaining = max(0, $invoice->grand_total - $amountPaid);

        return [
            $invoice->invoice_number,
            $invoice->receipt_number,
            $invoice->customer_name,
            $invoice->payment_method_display ?? $invoice->payment_method ?? '-',
            (float) $invoice->grand_total,
            (float) $amountPaid,
            (float) $remaining,
            optional($invoice->invoice_date)->format('Y-m-d'),
            $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '-',
            $invoice->payment_status,
        ];
    }

    /**
     * Column formatting for PhpSpreadsheet. Columns are 1-based letters.
     * E = Total Invoice, F = Amount Paid, G = Remaining
     */
    public function columnFormats(): array
    {
        // Use a custom format to prefix with Rp and show thousand separators
        // Keep cells numeric so Excel recognizes them as numbers and applies formatting.
        $rupiahFormat = '"Rp"\ #,##0';

        return [
            'E' => $rupiahFormat,
            'F' => $rupiahFormat,
            'G' => $rupiahFormat,
        ];
    }
}
