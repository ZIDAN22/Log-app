<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POD - {{ $delivery->delivery_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 210mm; height: 297mm; margin: 0 auto; padding: 20mm; background: white; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 3px solid #1e293b; padding-bottom: 20px; }
        .company-info h1 { font-size: 24px; color: #1e293b; margin-bottom: 5px; }
        .company-info p { font-size: 12px; color: #64748b; }
        .doc-title { text-align: right; }
        .doc-title h2 { font-size: 18px; color: #059669; font-weight: 600; }
        .doc-title p { font-size: 13px; color: #64748b; margin-top: 3px; }
        .section { margin-bottom: 25px; }
        .section-title { background: #f1f5f9; padding: 10px 15px; font-weight: 600; color: #1e293b; margin-bottom: 12px; border-left: 4px solid #059669; }
        .row { display: flex; gap: 30px; margin-bottom: 12px; }
        .col { flex: 1; }
        .label { font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
        .value { font-size: 13px; color: #1e293b; font-weight: 500; }
        .photo-container { margin-top: 15px; text-align: center; }
        .photo-container img { max-width: 100%; height: auto; border: 1px solid #cbd5e1; padding: 5px; }
        .signature-box { border: 1px dashed #cbd5e1; padding: 20px; text-align: center; margin-top: 10px; }
        .signature-box img { max-width: 100%; height: auto; max-height: 80px; }
        .badge { display: inline-block; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; margin-bottom: 12px; background: #d1fae5; color: #065f46; }
        .info-box { background: #f0fdf4; border-left: 4px solid #059669; padding: 12px; margin-top: 15px; font-size: 12px; }
        .footer { margin-top: 40px; text-align: center; padding-top: 20px; border-top: 1px solid #cbd5e1; }
        .footer p { font-size: 11px; color: #64748b; }
        table { width: 100%; margin-top: 10px; }
        table tr { margin-bottom: 8px; }
        table td { padding: 6px 0; font-size: 12px; }
        table td:first-child { color: #64748b; width: 35%; }
        table td:last-child { color: #1e293b; font-weight: 500; }
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
                <h2>✓ BUKTI PENERIMAAN</h2>
                <p>Proof of Delivery (POD)</p>
            </div>
        </div>

        <!-- Status Badge -->
        <div style="text-align: center; margin-bottom: 20px;">
            <span class="badge">✓ PENGIRIMAN SELESAI</span>
        </div>

        <!-- Informasi Pengiriman -->
        <div class="section">
            <div class="section-title">Informasi Pengiriman</div>
            <table>
                <tr>
                    <td>No. Surat Jalan</td>
                    <td>: {{ $delivery->delivery_number }}</td>
                </tr>
                <tr>
                    <td>No. Resi</td>
                    <td>: {{ $delivery->shipment->receipt_number ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengiriman</td>
                    <td>: {{ $delivery->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Tanggal Penerimaan</td>
                    <td>: {{ $delivery->delivered_at ? $delivery->delivered_at->format('d M Y H:i') : '-' }}</td>
                </tr>
            </table>
        </div>

        <!-- Informasi Penerima -->
        <div class="section">
            <div class="section-title">Data Penerima Barang</div>
            <table>
                <tr>
                    <td>Nama Penerima</td>
                    <td>: {{ $delivery->receiver_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Alamat Penerima</td>
                    <td>: {{ $delivery->shipment->receiver_address ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kota Tujuan</td>
                    <td>: {{ $delivery->outbound->destination_city ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <!-- Detail Barang -->
        <div class="section">
            <div class="section-title">Detail Barang yang Diterima</div>
            <table>
                <tr>
                    <td>Jumlah Paket</td>
                    <td>: {{ $delivery->outbound->total_quantity ?? 0 }} unit</td>
                </tr>
                <tr>
                    <td>Berat Total</td>
                    <td>: {{ $delivery->outbound->total_weight ?? 0 }} kg</td>
                </tr>
                <tr>
                    <td>Status Barang</td>
                    <td>: Lengkap &amp; Aman</td>
                </tr>
            </table>
        </div>

        <!-- Tanda Tangan & Foto -->
        <div class="section">
            <div class="section-title">Bukti Penerimaan</div>
            
            <!-- Signature -->
            @if($delivery->receiver_signature)
            <div>
                <p style="font-size: 11px; color: #64748b; margin-bottom: 5px;">Tanda Tangan Penerima:</p>
                <div class="signature-box">
                    <img src="{{ asset('storage/' . $delivery->receiver_signature) }}" alt="Tanda Tangan">
                </div>
            </div>
            @endif

            <!-- Photo -->
            @if($delivery->receiver_photo)
            <div class="photo-container" style="margin-top: 20px;">
                <p style="font-size: 11px; color: #64748b; margin-bottom: 8px;">Foto Bukti Penerimaan:</p>
                <img src="{{ asset('storage/' . $delivery->receiver_photo) }}" alt="Foto Bukti">
            </div>
            @endif
        </div>

        <!-- Catatan Penerimaan -->
        @if($delivery->delivery_notes)
        <div class="info-box">
            <strong>Catatan Penerimaan:</strong> {{ $delivery->delivery_notes }}
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini adalah bukti resmi penerimaan barang. Simpan dengan baik untuk keperluan klaim atau rujukan di masa mendatang.</p>
            <p style="margin-top: 10px;">Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
