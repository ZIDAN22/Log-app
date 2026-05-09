<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing List PDF</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 0; padding: 0; }
        .page { padding: 24px; }
        .header, .footer { width: 100%; }
        .logo { display: inline-block; width: 56px; height: 56px; border-radius: 16px; background: #0f172a; color: white; text-align: center; line-height: 56px; font-size: 24px; font-weight: bold; }
        .heading { margin-bottom: 16px; }
        .heading h1 { margin: 0; font-size: 24px; }
        .heading p { margin: 4px 0 0; color: #475569; }
        .section { margin-bottom: 20px; }
        .section-title { margin-bottom: 12px; font-size: 14px; color: #475569; letter-spacing: .05em; text-transform: uppercase; }
        .card { border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px; background: #f8fafc; }
        .grid { display: grid; gap: 14px; }
        .grid-2 { grid-template-columns: 1fr 1fr; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px 10px; border: 1px solid #e2e8f0; }
        th { background: #f1f5f9; text-align: left; font-size: 12px; color: #475569; }
        td { font-size: 12px; color: #0f172a; }
        .text-right { text-align: right; }
        .summary-item { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .summary-item strong { color: #0f172a; }
        .footer { margin-top: 30px; font-size: 11px; color: #64748b; display: flex; justify-content: space-between; }
    </style>
</head>
<body>
<div class="page">
    <div class="header">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
            <div style="display:flex; gap:14px; align-items:center;">
                <div class="logo">L</div>
                <div>
                    <div style="font-size:18px; font-weight:700; color:#0f172a;">LogistikPro</div>
                    <div style="font-size:12px; color:#475569;">Packing List Document</div>
                </div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:18px; font-weight:700; color:#0f172a;">PACKING LIST</div>
                <div style="font-size:12px; color:#475569;">No Resi: {{ $packingList->shipment->receipt_number }}</div>
                <div style="font-size:12px; color:#475569;">Invoice: {{ $packingList->shipment->invoice_number }}</div>
                <div style="font-size:12px; color:#475569;">Tanggal: {{ $packingList->packing_date->format('d M Y') }}</div>
            </div>
        </div>
    </div>

    <div class="section grid grid-2">
        <div class="card">
            <div class="section-title">Pengirim</div>
            <div><strong>{{ $packingList->shipment->sender_name }}</strong></div>
            <div>{{ $packingList->shipment->pickup_address }}</div>
        </div>
        <div class="card">
            <div class="section-title">Penerima</div>
            <div><strong>{{ $packingList->shipment->receiver_name }}</strong></div>
            <div>{{ $packingList->shipment->destination_city }}</div>
        </div>
    </div>

    <div class="section card">
        <div class="section-title">Ringkasan Packing</div>
        <div class="summary-item"><span>Total Qty</span><strong>{{ $packingList->total_qty }}</strong></div>
        <div class="summary-item"><span>Total Package</span><strong>{{ $packingList->total_package }}</strong></div>
        <div class="summary-item"><span>Total Berat</span><strong>{{ number_format($packingList->total_weight, 2, ',', '.') }} kg</strong></div>
        <div class="summary-item"><span>Total Value</span><strong>Rp {{ number_format($packingList->total_value, 0, ',', '.') }}</strong></div>
        <div class="summary-item"><span>Catatan</span><strong>{{ $packingList->notes ?: '-' }}</strong></div>
    </div>

    <div class="section">
        <div class="section-title">Daftar Barang</div>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Packaging</th>
                    <th>Total Packaging</th>
                    <th>Berat (kg)</th>
                    <th class="text-right">Harga / Unit</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packingList->items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->packaging_type }}</td>
                    <td>{{ $item->total_packaging }}</td>
                    <td>{{ number_format($item->weight, 2, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div>Generated by LogistikPro</div>
        <div>{{ now()->format('d M Y H:i') }}</div>
    </div>
</div>
</body>
</html>
