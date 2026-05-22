<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Label - {{ $inbound->shipment->receipt_number ?? 'N/A' }}</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; }
        html, body { width: 100%; min-height: 100%; }
        body { background-color: #fff; padding: 0; display: flex; justify-content: center; align-items: center; }
        .page-wrapper { width: 100%; max-width: 100%; display: flex; justify-content: center; align-items: center; }
        .resi-container { width: 560px; max-width: 100%; min-height: 397px; background-color: #fff; border: 1.5px solid #000; padding: 10px; position: relative; box-sizing: border-box; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; font-size: 10px; }
        td, th { border: 1px solid #000; padding: 3px 4px; vertical-align: top; }
        .header-table td { border: none; }
        .logo-area { width: 30%; }
        .center-code { width: 50%; text-align: center; }
        .main-code { font-size: 24px; font-weight: bold; letter-spacing: 1px; }
        .resi-num { font-size: 11px; font-weight: bold; margin-top: 1px; }
        .qr-right { width: 20%; text-align: right; }
        .qr-placeholder { width: 50px; height: 50px; display: inline-block; }
        .qr-text { font-size: 9px; font-weight: bold; text-align: right; margin-top: 1px; }
        .barcode-row td { text-align: center; padding: 6px 0; }
        .barcode-placeholder { width: 85%; height: 40px; background: repeating-linear-gradient(90deg, #000, #000 2px, #fff 2px, #fff 6px); margin: 0 auto; }
        .barcode-num { font-size: 13px; font-weight: bold; margin-top: 2px; letter-spacing: 1px; }
        .bold-title { font-weight: bold; font-size: 10px; margin-bottom: 2px; }
        .route-box { text-align: center; }
        .route-title { font-size: 8px; color: #444; margin-bottom: 1px; }
        .route-val { font-size: 14px; font-weight: bold; }
        .arrow { font-size: 14px; padding-top: 8px !important; }
        .item-table th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        .center-text { text-align: center; }
        .right-text { text-align: right; }
        .bottom-split { display: flex; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; }
        .bottom-left-col { width: 60%; }
        .bottom-right-col { width: 40%; border-left: 1px solid #000; display: flex; flex-direction: column; }
        .info-row { padding: 4px; border-bottom: 1px solid #000; font-size: 9px; }
        .penerima-box { flex-grow: 1; padding: 5px; text-align: center; position: relative; min-height: 80px; border-bottom: 1px solid #000; }
        .penerima-title { font-weight: bold; font-size: 9px; margin-bottom: 25px; }
        .penerima-line { border-bottom: 1px dashed #666; width: 80%; margin: 0 auto 2px auto; }
        .penerima-sub { font-size: 8px; color: #333; }
        .tracking-box { padding: 6px; display: flex; align-items: center; justify-content: space-between; font-size: 9px; }
        .footer-nav { margin-top: 5px; display: flex; justify-content: space-between; font-size: 9px; font-weight: bold; gap: 4px; }
        .footer-item { display: flex; align-items: center; gap: 3px; }
        .actions { margin-bottom: 12px; display:flex; gap:8px; }
        .btn { padding:8px 12px; border-radius:8px; text-decoration:none; color:#fff; background:#2563eb; }

        @page {
            size: A6 landscape;
            margin: 5mm;
        }

        @media print {
            body { background-color: #fff; padding: 0; margin: 0; }
            .page-wrapper { max-width: none; }
            .resi-container { width: 560px; height: auto; margin: 0; border-width: 1.5px; padding: 8px; }
            .footer-nav { font-size: 8px; gap: 8px; }
            .bottom-split { page-break-inside: avoid; }
            table { page-break-inside: avoid; }
            .header-table, .item-table, .bottom-split { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

<div style="max-width:100%; width:100%;">

    <div class="resi-container">
        <table class="header-table" style="border: 1px solid #000; border-bottom: none;">
            <tr>
                <td class="logo-area">
                    <img src="{{ asset('images/bll.png') }}" alt="BLL" style="max-height:50px;">
                </td>
                <td class="center-code">
                    <div class="main-code">{{ strtoupper($inbound->shipment->service ?? '') }}</div>
                    <div class="resi-num">No. Resi: {{ $inbound->shipment->receipt_number }}</div>
                </td>
                <td class="qr-right">
                    <div class="qr-placeholder">
                        @if(!empty($qrData))
                            <img src="{{ $qrData }}" alt="qr" style="width:50px; height:50px; object-fit:contain;">
                        @else
                            <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl={{ urlencode($inbound->shipment->receipt_number) }}" alt="qr" style="width:50px; height:50px; object-fit:contain;">
                        @endif
                    </div>
                    <div class="qr-text">{{ $inbound->shipment->receipt_number }}</div>
                </td>
            </tr>
        </table>

        <table style="border-left: 1px solid #000; border-right: 1px solid #000;">
            <tr class="barcode-row">
                <td>
                    @if(!empty($barcodeData))
                    <div style="text-align:center;"><img src="{{ $barcodeData }}" alt="barcode" style="max-width:85%; height:40px; object-fit:contain;"></div>
                    @else
                    <div class="barcode-placeholder"></div>
                    @endif
                    <div class="barcode-num">{{ $inbound->shipment->receipt_number }}</div>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="width: 45%; padding: 0;" rowspan="2">
                    <div style="padding: 4px; border-bottom: 1px solid #000; min-height: 70px;">
                        <div class="bold-title">Pengirim:</div>
                        <div style="font-weight: bold; font-size: 9px;">{{ $inbound->shipment->sender_name }}</div>
                        <div style="font-size: 8px;">{{ $inbound->shipment->pickup_address }}</div>
                        <div style="font-size: 8px;">{{ collect([$inbound->shipment->pickup_village, $inbound->shipment->pickup_district, $inbound->shipment->pickup_city, $inbound->shipment->pickup_province])->filter()->implode(', ') }}</div>
                        @if($inbound->shipment->pickup_postal_code)
                            <div style="font-size: 8px;">Kode Pos: {{ $inbound->shipment->pickup_postal_code }}</div>
                        @endif
                    </div>
                    <div style="padding: 4px; min-height: 80px;">
                        <div class="bold-title">Penerima:</div>
                        <div style="font-weight: bold; font-size: 9px;">{{ $inbound->shipment->receiver_name }}</div>
                        <div style="font-size: 8px;">{{ $inbound->shipment->destination_address ?? $inbound->shipment->destination_city }}</div>
                        <div style="font-size: 8px;">{{ collect([$inbound->shipment->destination_village, $inbound->shipment->destination_district, $inbound->shipment->destination_city, $inbound->shipment->destination_province])->filter()->implode(', ') }}</div>
                        @if($inbound->shipment->destination_postal_code)
                            <div style="font-size: 8px;">Kode Pos: {{ $inbound->shipment->destination_postal_code }}</div>
                        @endif
                    </div>
                </td>
                <td style="width: 55%; padding: 0;">
                    <table style="border: none;">
                        <tr>
                            <td class="route-box" style="border-top: none; border-left: none; width: 22%;">
                                <div class="route-title">Kota Asal</div>
                                <div class="route-val">{{ $inbound->shipment->origin_city ?? '-' }}</div>
                            </td>
                            <td class="center-text arrow" style="border-top: none; width: 6%; font-weight: bold;">&rarr;</td>
                            <td class="route-box" style="border-top: none; width: 22%;">
                                <div class="route-title">Kota Tujuan</div>
                                <div class="route-val">{{ $inbound->shipment->destination_city ?? '-' }}</div>
                            </td>
                            <td class="route-box" style="border-top: none; width: 18%;">
                                <div class="route-title">Layanan</div>
                                <div class="route-val" style="font-size: 12px;">{{ $inbound->shipment->service ?? '-' }}</div>
                            </td>
                            <td class="route-box" style="border-top: none; width: 16%;">
                                <div class="route-title">Berat</div>
                                <div class="route-val" style="font-size: 10px; padding-top: 2px;">{{ number_format($inbound->total_weight,2) }} Kg</div>
                            </td>
                            <td class="route-box" style="border-top: none; width: 16%;">
                                <div class="route-title">Tanggal</div>
                                <div style="font-size: 9px; font-weight: bold; padding-top: 3px;">{{ $inbound->inbound_date->format('d-m-Y') }}</div>
                            </td>
                            <td class="route-box" style="border-top: none; border-right: none; width: 16%;">
                                <div class="route-title">Jumlah Paket</div>
                                <div class="route-val" style="font-size: 11px;">1 / {{ $inbound->total_package }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table style="border: none; height: 100%;">
                        <tr>
                            <td style="border-left: none; border-bottom: none; width: 50%; min-height: 60px;">
                                <div class="bold-title" style="font-size: 10px;">INFORMASI PAKET</div>
                                <div style="margin-bottom: 2px; font-size: 9px;">Jenis Kiriman : <strong>PARCEL</strong></div>
                                <div style="font-size: 9px;">Pembayaran : <strong>Prepaid</strong></div>
                            </td>
                            <td style="border-right: none; border-bottom: none; width: 50%;">
                                <div style="font-weight: bold; font-size: 10px; margin-bottom: 2px;">Catatan Pengirim:</div>
                                <div style="font-size: 10px; line-height: 1.2;">{{ $inbound->notes ?: '-' }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="item-table">
            <thead>
                <tr>
                    <th colspan="5" style="text-align: left; background-color: #fff; font-size: 11px; border-bottom: 2px solid #000;">ISI KIRIMAN</th>
                </tr>
                <tr>
                    <th style="width: 6%;">No.</th>
                    <th style="width: 54%; text-align: left;">Nama Barang</th>
                    <th style="width: 10%;">Qty</th>
                    <th style="width: 15%;">Satuan</th>
                    <th style="width: 15%;">Berat (kg)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inbound->items as $i => $item)
                <tr>
                    <td class="center-text">{{ $i+1 }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td class="center-text">{{ $item->qty }}</td>
                    <td class="center-text">{{ $item->packaging_type }}</td>
                    <td class="right-text">{{ number_format($item->weight,2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2" style="text-align: left; background-color: #fff;">TOTAL</th>
                    <th class="center-text" style="background-color: #fff;">{{ $inbound->total_qty }}</th>
                    <th style="background-color: #fff;"></th>
                    <th class="right-text" style="background-color: #fff;">{{ number_format($inbound->total_weight,2) }}</th>
                </tr>
            </tbody>
        </table>

        <div class="bottom-split">
            <div class="bottom-left-col">
                <div class="info-row">
                    <strong>Keterangan:</strong> {{ $inbound->shipment->item_type ?? '-' }}
                </div>
                <div class="info-row" style="text-align: right; font-weight: bold; font-size: 10px; padding: 4px 4px;">
                    Total Berat Aktual: {{ number_format($inbound->total_weight,2) }} Kg
                </div>
                <div class="cod-box" style="display:flex; align-items:center; padding:4px;">
                    <div class="non-cod" style="border: 2px solid #000; padding: 3px 6px; font-weight: bold; font-size: 11px; margin-right: 5px; background-color: #fff;">NON COD</div>
                    <div style="font-size: 9px;">Tidak perlu bayar apapun ke kurir</div>
                </div>
            </div>
            
            <div class="bottom-right-col">
                <div class="penerima-box">
                    <div class="penerima-title">LEMBAR PENERIMA</div>
                    <div class="penerima-line"></div>
                    <div class="penerima-sub">Tanda Tangan & Nama Terang</div>
                </div>
                <!-- tracking box removed as requested -->
            </div>
        </div>

        <div class="footer-nav">
            <div class="footer-item">📞 021 8066 1888</div>
            <div class="footer-item">🌐 www.example.id</div>
            <div class="footer-item">f BLL Logistics</div>
            <div class="footer-item">🐦 @bll</div>
            <div class="footer-item">📸 bll</div>
        </div>
    </div>
</div>

</body>
</html>
