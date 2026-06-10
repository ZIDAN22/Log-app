<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Packing List {{ $packingList->shipment->invoice_number ?? 'Packing List' }}</title>

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
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo {
            width: 90px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .company-info {
            font-size: 12px;
            line-height: 1.7;
            color: #475569;
        }

        .packing-title {
            font-size: 34px;
            font-weight: bold;
            color: #0f2d62;
            margin-bottom: 10px;
        }

        .header-right {
            text-align: right;
        }

        .header-right p {
            margin: 4px 0;
            font-size: 12px;
            color: #334155;
        }

        .divider {
            border-top: 4px solid #0f2d62;
            margin-top: 18px;
        }

        .info-wrapper {
            margin-top: 25px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            vertical-align: top;
            padding: 4px 10px;
            font-size: 12px;
        }

        .label {
            width: 120px;
            font-weight: bold;
            color: #0f172a;
        }

        .colon {
            width: 10px;
        }

        .address-box {
            line-height: 1.8;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .items th {
            background: #0f2d62;
            color: white;
            padding: 12px 8px;
            border: 1px solid #cbd5e1;
            font-size: 12px;
            text-align: center;
        }

        .items td {
            border: 1px solid #cbd5e1;
            padding: 12px 8px;
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total-row td {
            font-weight: bold;
            font-size: 13px;
        }

        .note-box {
            border: 1px solid #dbe3ee;
            border-radius: 8px;
            margin-top: 25px;
            overflow: hidden;
        }

        .note-table {
            width: 100%;
            border-collapse: collapse;
        }

        .note-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 14px;
            font-size: 12px;
        }

        .shipping-box {
            border: 1px solid #dbe3ee;
            border-radius: 8px;
            margin-top: 25px;
            padding: 18px;
        }

        .shipping-table {
            width: 100%;
            border-collapse: collapse;
        }

        .shipping-table td {
            padding: 8px 4px;
            font-size: 12px;
            vertical-align: top;
        }

        .footer {
            margin-top: 45px;
        }

        .signature {
            margin-top: 70px;
        }

        .signature-line {
            width: 220px;
            border-top: 1px solid #334155;
            margin-top: 60px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <table class="header-table">
            <tr>

                <td width="12%">
                    <img src="{{ public_path('images/bll.png') }}" class="logo">
                </td>

                <td width="58%">
                    <div class="company-name">
                        PT. BERLIAN LINTAS LOGISTIK
                    </div>

                    <div class="company-info">
                        Ruko Karang Anyar Permai 55 Blok B 18-19 <br>
                        Jl. Karang Anyar Raya Jakarta Pusat 10750 <br>
                        Email : https://berlianlintaslogistik.com
                    </div>
                </td>

                <td width="30%" class="header-right">
                    <div class="packing-title">
                        PACKING LIST
                    </div>

                    <p>No Resi: {{ $packingList->shipment->receipt_number }}</p>
                    <p>Invoice: {{ optional($packingList->invoice)->invoice_number ?? $packingList->shipment->invoice_number }}</p>
                    <p>Tanggal: {{ optional($packingList->invoice)->invoice_date?->format('d F Y') ?? $packingList->packing_date->format('d F Y') }}</p>
                </td>

            </tr>
        </table>

        <div class="divider"></div>

    </div>

    <div class="info-wrapper">

        <table class="info-table">
            <tr>
                <td width="55%">
                    <table>
                        <tr>
                            <td class="label">NO INVOICE</td>
                            <td class="colon">:</td>
                            <td>{{ optional($packingList->invoice)->invoice_number ?? $packingList->shipment->invoice_number }}</td>
                        </tr>
                        <tr>
                            <td class="label">KEPADA</td>
                            <td class="colon">:</td>
                            <td>{{ optional($packingList->invoice)->customer_name ?? $packingList->shipment->receiver_name }}</td>
                        </tr>
                        <tr>
                            <td class="label">ALAMAT</td>
                            <td class="colon">:</td>
                            <td class="address-box">
                                {{ $packingList->shipment->destination_address ?? '-' }}<br>
                                {{ $packingList->shipment->destination_village ?? '' }}, {{ $packingList->shipment->destination_district ?? '' }}, {{ $packingList->shipment->destination_province ?? '' }}<br>
                                Kode Pos: {{ $packingList->shipment->destination_postal_code ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">TGL INVOICE</td>
                            <td class="colon">:</td>
                            <td>{{ optional($packingList->invoice)->invoice_date?->format('d F Y') ?? $packingList->packing_date->format('d F Y') }}</td>
                        </tr>
                    </table>
                </td>

                <td width="45%">
                    <div style="font-weight:bold; margin-bottom:8px;">
                            Alamat Pengirim :
                        </div>

                        <div class="address-box">
                            {{ $packingList->shipment->pickup_address ?? '-' }}<br>
                            {{ $packingList->shipment->pickup_village ?? '' }}, {{ $packingList->shipment->pickup_district ?? '' }}, {{ $packingList->shipment->pickup_province ?? '' }}<br>
                            Kode Pos: {{ $packingList->shipment->pickup_postal_code ?? '-' }}
                        </div>
                </td>
            </tr>
        </table>

    </div>

    <table class="items">
        <thead>
            <tr>
                <th width="8%">NO</th>
                <th>DESKRIPSI</th>
                <th width="12%">QTY</th>
                <th width="10%">KEMASAN</th>
                <th width="18%">HARGA</th>
                <th width="22%">JUMLAH</th>
            </tr>
        </thead>

        <tbody>
            @foreach($packingList->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td class="text-center">{{ $item->qty }} UNIT</td>
                    <td class="text-center">{{ $item->total_packaging ?? '-' }}</td>
                    <td class="text-right">Rp{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($item->subtotal_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5" class="text-center">TOTAL</td>
                <td class="text-right">Rp{{ number_format($item->subtotal_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="note-box">
        <table class="note-table">
            <tr>
                <td width="25%">Total Packing</td>
                <td width="5%">:</td>
                <td>
                    Total {{ $packingList->total_package }} packing peti kayu,
                    isi {{ $packingList->total_qty }} unit
                </td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td>:</td>
                <td>{{ $packingList->notes ?: '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="shipping-box">
        <table class="shipping-table">
            <tr>
                <td width="18%">Pengiriman</td>
                <td width="3%">:</td>
                <td width="29%">{{ $packingList->shipment->shipping_day ?? '-' }} Hari </td>
                <td width="20%"></td>
                <td width="3%"></td>
                <td></td>
            </tr>
            <tr>
                <td>By Darat</td>
                <td>:</td>
                <td>{{ $packingList->shipment->vehicle ? $packingList->shipment->vehicle->name . ' (' . $packingList->shipment->vehicle->license_plate . ')' : ($packingList->shipment->transportation_type === 'darat' ? 'Kendaraan belum ditetapkan' : '-') }}</td>
                <td>Tgl Berangkat</td>
                <td>:</td>
                <td>{{ $packingList->shipment->land_departure_date?->format('d F Y') ?? '-' }}</td>
            </tr>
            <tr>
                <td>By Laut</td>
                <td>:</td>
                <td>{{ $packingList->shipment->sea_shipping ?: '-' }}</td>
                <td>Tgl Berangkat</td>
                <td>:</td>
                <td>{{ $packingList->shipment->sea_departure_date?->format('d F Y') ?? '-' }}</td>
            </tr>
            <tr>
                <td>By Udara</td>
                <td>:</td>
                <td>{{ $packingList->shipment->air_shipping ?: '-' }}</td>
                <td>Tgl Berangkat</td>
                <td>:</td>
                <td>{{ $packingList->shipment->air_departure_date?->format('d F Y') ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Jakarta,
        {{ now()->format('d F Y') }}

        <div class="signature">
            Mengetahui,
            <div class="signature-line"></div>
        </div>
    </div>

</div>

</body>
</html>