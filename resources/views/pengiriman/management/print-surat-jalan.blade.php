<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan - {{ $delivery->delivery_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 210mm; height: 297mm; margin: 0 auto; padding: 20mm; background: white; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 3px solid #1e293b; padding-bottom: 20px; }
        .company-info h1 { font-size: 24px; color: #1e293b; margin-bottom: 5px; }
        .company-info p { font-size: 12px; color: #64748b; }
        .doc-title { text-align: right; }
        .doc-title h2 { font-size: 18px; color: #1e293b; font-weight: 600; }
        .doc-title p { font-size: 13px; color: #64748b; margin-top: 3px; }
        .section { margin-bottom: 25px; }
        .section-title { background: #f1f5f9; padding: 10px 15px; font-weight: 600; color: #1e293b; margin-bottom: 12px; border-left: 4px solid #0ea5e9; }
        .row { display: flex; gap: 30px; margin-bottom: 12px; }
        .col { flex: 1; }
        .label { font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
        .value { font-size: 13px; color: #1e293b; font-weight: 500; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        table thead { background: #f1f5f9; }
        table th { padding: 10px 12px; text-align: left; font-size: 12px; font-weight: 600; color: #1e293b; border-bottom: 2px solid #cbd5e1; }
        table td { padding: 8px 12px; font-size: 12px; color: #334155; border-bottom: 1px solid #e2e8f0; }
        table tbody tr:nth-child(even) { background: #f8fafc; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; }
        .signature-box { width: 150px; border-top: 1px solid #64748b; padding-top: 40px; text-align: center; }
        .signature-box p { font-size: 11px; color: #64748b; margin-top: 5px; }
        .alert { background: #fef2f2; border-left: 4px solid #ef4444; padding: 10px 12px; margin-top: 15px; font-size: 12px; color: #7f1d1d; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: 600; margin-bottom: 12px; }
        .badge-darat { background: #dcfce7; color: #166534; }
        .badge-laut { background: #cffafe; color: #164e63; }
        .badge-udara { background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <h1>🚚 Logistik Pro</h1>
                <p>Jl. Raya Utama No. 123 | Jakarta 12345</p>
                <p>Telp: (021) 123-4567 | Email: info@logistikpro.id</p>
            </div>
            <div class="doc-title">
                <h2>SURAT JALAN</h2>
                <p>Delivery Order</p>
            </div>
        </div>

        <!-- Nomor Dokumen -->
        <div class="section">
            <div class="row">
                <div class="col">
                    <p class="label">No. Surat Jalan</p>
                    <p class="value">{{ $delivery->delivery_number }}</p>
                </div>
                <div class="col">
                    <p class="label">No. Resi</p>
                    <p class="value">{{ $delivery->shipment->receipt_number ?? '-' }}</p>
                </div>
                <div class="col">
                    <p class="label">Tanggal</p>
                    <p class="value">{{ now()->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Pengirim & Penerima -->
        <div class="section">
            <div class="section-title">Informasi Pengirim & Penerima</div>
            <div class="row">
                <div class="col">
                    <p class="label">📤 Pengirim</p>
                    <p class="value">{{ $delivery->shipment->sender_name ?? '-' }}</p>
                    <p style="font-size: 12px; color: #64748b; margin-top: 3px;">{{ $delivery->shipment->sender_address ?? '-' }}</p>
                </div>
                <div class="col">
                    <p class="label">📥 Penerima</p>
                    <p class="value">{{ $delivery->shipment->receiver_name ?? '-' }}</p>
                    <p style="font-size: 12px; color: #64748b; margin-top: 3px;">{{ $delivery->shipment->receiver_address ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Pengiriman -->
        <div class="section">
            <div class="section-title">Informasi Pengiriman</div>
            <div class="row">
                <div class="col">
                    <p class="label">Metode Pengiriman</p>
                    <span class="badge @if($delivery->delivery_method === 'DARAT') badge-darat @elseif($delivery->delivery_method === 'LAUT') badge-laut @else badge-udara @endif">
                        {{ $delivery->delivery_method }}
                    </span>
                </div>
                <div class="col">
                    <p class="label">Kota Tujuan</p>
                    <p class="value">{{ $delivery->outbound->destination_city ?? '-' }}</p>
                </div>
            </div>
            <div class="row">
                @if($delivery->delivery_method === 'DARAT')
                <div class="col">
                    <p class="label">Driver</p>
                    <p class="value">{{ $delivery->driver->name ?? '-' }}</p>
                </div>
                <div class="col">
                    <p class="label">Kendaraan</p>
                    <p class="value">{{ $delivery->vehicle->name ?? '-' }} ({{ $delivery->vehicle->plate_number ?? '-' }})</p>
                </div>
                @elseif($delivery->delivery_method === 'LAUT')
                <div class="col">
                    <p class="label">Vendor Pengiriman</p>
                    <p class="value">{{ $delivery->outbound->shipping_vendor ?? '-' }}</p>
                </div>
                <div class="col">
                    <p class="label">Nama Kapal/Ekspedisi</p>
                    <p class="value">{{ $delivery->outbound->vessel_name ?? '-' }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Detail Barang -->
        <div class="section">
            <div class="section-title">Detail Barang yang Dikirim</div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 45%;">Deskripsi Barang</th>
                        <th style="width: 15%;">Qty</th>
                        <th style="width: 20%;">Berat</th>
                        <th style="width: 15%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $delivery->outbound->item_description ?? 'Pengiriman Barang' }}</td>
                        <td>{{ $delivery->outbound->total_quantity ?? 0 }} unit</td>
                        <td>{{ $delivery->outbound->total_weight ?? 0 }} kg</td>
                        <td>{{ $delivery->outbound->delivery_notes ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Catatan -->
        @if($delivery->outbound->delivery_notes)
        <div class="alert">
            <strong>Catatan Khusus:</strong> {{ $delivery->outbound->delivery_notes }}
        </div>
        @endif

        <!-- Tanda Tangan -->
        <div class="footer">
            <div class="signature-box">
                <p>Pengirim</p>
                <p style="font-size: 10px; margin-top: 10px;">(.......................)</p>
            </div>
            <div class="signature-box">
                <p>Driver/Kurir</p>
                <p style="font-size: 10px; margin-top: 10px;">(.......................)</p>
            </div>
            <div class="signature-box">
                <p>Penerima</p>
                <p style="font-size: 10px; margin-top: 10px;">(.......................)</p>
            </div>
        </div>
    </div>
</body>
</html>
