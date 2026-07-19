<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 0; padding: 0; }
        .page { padding: 24px; }
        .header { margin-bottom: 24px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 8px 0 0; color: #4b5563; font-size: 12px; }
        .summary-grid { display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 12px; margin-bottom: 24px; }
        .summary-card { border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; background: #fff; }
        .summary-title { font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 8px; }
        .summary-value { font-size: 20px; font-weight: bold; color: #111827; }
        .table { width: 100%; border-collapse: collapse; font-size: 11px; }
        .table th, .table td { border: 1px solid #e5e7eb; padding: 10px; text-align: left; vertical-align: top; }
        .table th { background: #f8fafc; color: #4b5563; font-weight: 700; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 10px; font-weight: 700; }
        .badge-unpaid { background: #fee2e2; color: #b91c1c; }
        .badge-dp { background: #fef3c7; color: #b45309; }
        .badge-paid { background: #dcfce7; color: #15803d; }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <h1>Laporan Keuangan</h1>
            <p>Ringkasan laporan invoice dan pembayaran operasional logistik.</p>
        </div>

        <div class="summary-grid">
            <div class="summary-card">
                <div class="summary-title">Total Invoice</div>
                <div class="summary-value">{{ number_format($summary['total'] ?? 0) }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Belum Bayar</div>
                <div class="summary-value">{{ number_format($summary['unpaid'] ?? 0) }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">DP</div>
                <div class="summary-value">{{ number_format($summary['dp'] ?? 0) }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Lunas</div>
                <div class="summary-value">{{ number_format($summary['paid'] ?? 0) }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Total Pembayaran Masuk</div>
                <div class="summary-value">Rp {{ number_format($summary['incoming_payments'] ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Invoice</th>
                    <th>Amount Paid</th>
                    <th>Remaining</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                @php
                    $amountPaid = $invoice->payment_amount_paid_sum ?? 0;
                    $remaining = max(0, $invoice->grand_total - $amountPaid);
                @endphp
                <tr>
                    <td>{{ $invoice->invoice_number }}<br><small>{{ $invoice->receipt_number }}</small></td>
                    <td>{{ $invoice->customer_name }}</td>
                    <td>
                        {{ $invoice->payment_method_display ?? $invoice->payment_method ?? '-' }}
                        @php $bankDetails = $invoice->bank_details ?? []; @endphp
                        @if(!empty($bankDetails['bank_name']) || !empty($bankDetails['account_number']) || !empty($bankDetails['account_name']))
                            <br><small>
                                {{ $bankDetails['bank_name'] ?? '-' }}
                                @if(!empty($bankDetails['account_number']))
                                    • {{ $bankDetails['account_number'] }}
                                @endif
                                @if(!empty($bankDetails['account_name']))
                                    • {{ $bankDetails['account_name'] }}
                                @endif
                            </small>
                        @endif
                    </td>
                    <td>Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($amountPaid, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($remaining, 0, ',', '.') }}</td>
                    <td>{{ optional($invoice->invoice_date)->format('d M Y') }}</td>
                    <td>
                        @if($invoice->payment_status === \App\Models\Invoice::STATUS_UNPAID)
                        <span class="badge badge-unpaid">{{ $invoice->payment_status }}</span>
                        @elseif($invoice->payment_status === \App\Models\Invoice::STATUS_DP)
                        <span class="badge badge-dp">{{ $invoice->payment_status }}</span>
                        @else
                        <span class="badge badge-paid">{{ $invoice->payment_status }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
