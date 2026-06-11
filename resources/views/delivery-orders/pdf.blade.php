<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan - {{ $deliveryOrder->delivery_order_number }}</title>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            color: #1e293b;
            font-size: 11px;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo img {
            width: 100px;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .company-info {
            font-size: 10px;
            line-height: 1.7;
            color: #475569;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #0f2d62;
            text-align: center;
            margin: 10px 0 18px;
            letter-spacing: 1px;
        }

        .sub-title {
            font-size: 12px;
            color: #334155;
            margin-top: 4px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 18px;
        }

        .info-card {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 14px;
            background: #fff;
        }

        .card-title {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .field {
            display: flex;
            margin-bottom: 8px;
        }

        .field-label {
            width: 130px;
            font-weight: 700;
            color: #334155;
            flex-shrink: 0;
        }

        .field-value {
            color: #475569;
            flex: 1;
        }

        .address {
            line-height: 1.6;
            color: #475569;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        .table th,
        .table td {
            border: 1px solid #cbd5e1;
            padding: 10px;
            vertical-align: top;
            font-size: 11px;
        }

        .table th {
            background: #0f2d62;
            color: #fff;
            text-align: center;
            font-weight: 700;
        }

        .table td {
            color: #334155;
        }

        .text-center {
            text-align: center;
        }

        .signature-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-top: 40px;
        }

        .signature-box {
            width: 32%;
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid #334155;
            margin-top: 40px;
            padding-bottom: 6px;
        }

        .signature-label {
            font-size: 10px;
            margin-top: 6px;
            color: #475569;
        }
    </style>
</head>

<body>
    @php
    $shipment = optional($deliveryOrder->shipment);
    $pickupAddress = $deliveryOrder->pickup_address ?: $shipment->pickup_address;
    $receiverName = $deliveryOrder->receiver_name ?: $shipment->receiver_name;
    $transportType = $deliveryOrder->transportation_type ?: $shipment->transportation_type;
    $invoiceNumber = $shipment->invoice_number ?? '-';
    $receiptNumber = $shipment->receipt_number ?? '-';
    $itemType = $shipment->item_type ?: 'Barang Kiriman';
    $totalWeight = $shipment->total_weight ? number_format($shipment->total_weight, 2, ',', '.') : '-';
    @endphp

    <div class="container">
        <div class="header">
            <table class="header-table">
                <tr>
                    <td width="28%">
                        <div class="logo">
                            <img src="{{ public_path('images/bll.png') }}" alt="Logo">
                        </div>
                    </td>
                    <td width="50%">
                        <div class="company-name">PT. BERLIAN LINTAS LOGISTIK</div>
                        <div class="company-info">
                            Ruko Karang Anyar Permai 55 Blok B 18-19<br>
                            Jl. Karang Anyar Raya Jakarta Pusat 10750<br>
                            Email: info@berlianlintaslogistik.com
                        </div>
                    </td>
                    <td width="22%" style="text-align:right;">
                        <div class="sub-title">Dokumen</div>
                        <div class="field">
                            <div class="field-label">No. Surat Jalan</div>
                            <div class="field-value">{{ $deliveryOrder->delivery_order_number }}</div>
                        </div>
                        <div class="field">
                            <div class="field-label">Tanggal</div>
                            <div class="field-value">{{ $deliveryOrder->order_date->format('d F Y') }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="title">SURAT JALAN</div>

        <div class="info-grid">
            <div class="info-card">
                <div class="card-title">Detail Dokumen</div>
                <div class="field">
                    <div class="field-label">No. Resi</div>
                    <div class="field-value">{{ $receiptNumber }}</div>
                </div>
                <div class="field">
                    <div class="field-label">No. Invoice</div>
                    <div class="field-value">{{ $invoiceNumber }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Pengirim</div>
                    <div class="field-value">{{ $deliveryOrder->sender_name ?: ($shipment->sender_name ?: '-') }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Penerima</div>
                    <div class="field-value">{{ $receiverName ?: '-' }}</div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-title">Detail Pengiriman</div>
                <div class="field">
                    <div class="field-label">Transportasi</div>
                    <div class="field-value">{{ ucfirst($transportType ?: '-') }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Kendaraan</div>
                    <div class="field-value">{{ optional($shipment->vehicle)->name ? optional($shipment->vehicle)->name
                        . ' (' . optional($shipment->vehicle)->license_plate . ')' : '-' }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Tgl Berangkat</div>
                    <div class="field-value">
                        @if($shipment->land_departure_date)
                        Darat: {{ $shipment->land_departure_date->format('d F Y') }}<br>
                        @endif
                        @if($shipment->sea_departure_date)
                        Laut: {{ $shipment->sea_departure_date->format('d F Y') }}<br>
                        @endif
                        @if($shipment->air_departure_date)
                        Udara: {{ $shipment->air_departure_date->format('d F Y') }}
                        @endif
                        @if(!$shipment->land_departure_date && !$shipment->sea_departure_date &&
                        !$shipment->air_departure_date)
                        -
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="field-label">Estimasi Hari</div>
                    <div class="field-value">{{ $shipment->shipping_day ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="card-title">Alamat Pickup</div>
                <div class="address">
                    {{ $pickupAddress ?: '-' }}<br>
                    {{ $shipment->pickup_village ? $shipment->pickup_village . ', ' : '' }}{{ $shipment->pickup_district
                    ?: '' }}<br>
                    {{ $shipment->pickup_province ?: '' }}<br>
                    Kode Pos: {{ $shipment->pickup_postal_code ?? '-' }}
                </div>
            </div>

            <div class="info-card">
                <div class="card-title">Alamat Tujuan</div>
                <div class="address">
                    {{ $shipment->destination_address ?: '-' }}<br>
                    {{ $shipment->destination_village ? $shipment->destination_village . ', ' : '' }}{{
                    $shipment->destination_district ?: '' }}<br>
                    {{ $shipment->destination_city ?: '' }}, {{ $shipment->destination_province ?: '' }}<br>
                    Kode Pos: {{ $shipment->destination_postal_code ?? '-' }}
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 35%;">Deskripsi Barang</th>
                    <th style="width: 20%;">Berat (kg)</th>
                    <th style="width: 15%;">Jumlah</th>
                    <th style="width: 30%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $itemType }}</td>
                    <td class="text-center">{{ $totalWeight }}</td>
                    <td class="text-center">{{ $shipment->total_qty ?? 1 }}</td>
                    <td>{{ $deliveryOrder->notes ?: $shipment->notes ?: '-' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="signature-row">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-label">Admin Operasional</div>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-label">Driver</div>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-label">Pengirim</div>
            </div>
        </div>
    </div>
</body>

</html>