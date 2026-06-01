<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Jalan Outbound</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 24px; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; }
        .badge { background: #0f172a; color: white; padding: 8px 14px; border-radius: 9999px; font-size: 12px; letter-spacing: .05em; }
        .card { border: 1px solid #e2e8f0; border-radius: 24px; padding: 18px; margin-top: 18px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        .table th, .table td { border: 1px solid #e2e8f0; padding: 12px; text-align: left; font-size: 13px; }
        .table th { background: #f8fafc; }
        .section-title { font-size: 14px; font-weight: 700; margin-bottom: 10px; }
        .signature-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 32px; margin-top: 40px; }
        .signature-box { border-top: 1px solid #64748b; padding-top: 26px; text-align: center; font-size: 13px; color: #475569; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1 style="font-size:24px; margin:0;">Surat Jalan Outbound</h1>
            <p style="margin:8px 0 0; color:#475569;">No Resi: {{ $outbound->packingList->shipment->receipt_number }}</p>
        </div>
        <div class="badge">{{ $outbound->shipping_method }}</div>
    </div>

    <div class="card">
        <div class="section-title">Customer & Tujuan</div>
        <div style="display:flex; justify-content:space-between; gap:18px; flex-wrap:wrap;">
            <div style="min-width:250px;">
                <strong>Customer</strong>
                <p style="margin:8px 0 0;">{{ $outbound->packingList->shipment->receiver_name }}</p>
                <p style="margin:4px 0 0; color:#475569;">{{ $outbound->packingList->shipment->destination_address }}</p>
                <p style="margin:4px 0 0; color:#475569;">{{ $outbound->packingList->shipment->destination_city }}, {{ $outbound->packingList->shipment->destination_province }}</p>
            </div>
            <div style="min-width:250px;">
                <strong>Tanggal Outbound</strong>
                <p style="margin:8px 0 0;">{{ $outbound->outbound_date->format('d M Y') }}</p>
                <strong style="margin-top:14px; display:block;">No Outbound</strong>
                <p style="margin:8px 0 0;">OB-{{ str_pad($outbound->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div style="min-width:250px;">
                <strong>Driver</strong>
                <p style="margin:8px 0 0;">{{ $outbound->driver?->name ?? '-' }}</p>
                <strong style="margin-top:14px; display:block;">Kendaraan</strong>
                <p style="margin:8px 0 0;">{{ $outbound->vehicle?->name ?? '-' }} {{ $outbound->vehicle?->license_plate ? ' / ' . $outbound->vehicle->license_plate : '' }}</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="section-title">Daftar Barang</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Berat</th>
                    <th>Total Paket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($outbound->packingList->items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->weight, 2, ',', '.') }} kg</td>
                    <td>{{ $item->total_packaging }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display:flex; justify-content:space-between; gap:18px; margin-top:18px; flex-wrap:wrap;">
            <div style="min-width:180px; padding:14px; background:#f8fafc; border-radius:18px;">
                <strong>Total Qty</strong>
                <p style="margin-top:8px; font-size:16px;">{{ $outbound->packingList->total_qty }}</p>
            </div>
            <div style="min-width:180px; padding:14px; background:#f8fafc; border-radius:18px;">
                <strong>Total Berat</strong>
                <p style="margin-top:8px; font-size:16px;">{{ number_format($outbound->packingList->total_weight, 2, ',', '.') }} kg</p>
            </div>
            <div style="min-width:180px; padding:14px; background:#f8fafc; border-radius:18px;">
                <strong>Total Paket</strong>
                <p style="margin-top:8px; font-size:16px;">{{ $outbound->packingList->total_package }}</p>
            </div>
        </div>
    </div>

    <div class="signature-grid">
        <div class="signature-box">
            <div>Warehouse</div>
            <div style="margin-top:44px;">_________________________</div>
        </div>
        <div class="signature-box">
            <div>Driver</div>
            <div style="margin-top:44px;">_________________________</div>
        </div>
    </div>
</body>
</html>
