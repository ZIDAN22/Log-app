<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Jalan - {{ $deliveryOrder->delivery_order_number }}</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 10mm 12mm 10mm 12mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9.5px;
            line-height: 1.35;
            color: #111827;
            background: #ffffff;
        }

        .page {
            width: 100%;
        }

        /* =========================
           HEADER / KOP
        ========================== */

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            vertical-align: top;
            padding: 0;
        }

        .logo-cell {
            width: 12%;
        }

        .logo {
            width: 72px;
            height: auto;
        }

        .company-cell {
            width: 51%;
            padding-left: 8px !important;
        }

        .company-name {
            margin: 0 0 3px 0;
            font-size: 18px;
            font-weight: 700;
            color: #0b1f44;
        }

        .company-info {
            font-size: 8.5px;
            line-height: 1.45;
            color: #374151;
        }

        .document-cell {
            width: 37%;
            text-align: right;
        }

        .document-title {
            margin: 0 0 5px 0;
            font-size: 21px;
            font-weight: 700;
            color: #0f2d62;
            letter-spacing: .3px;
        }

        .document-type {
            font-size: 8px;
            color: #64748b;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .doc-info {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5px;
        }

        .doc-info td {
            padding: 1px 0;
            border: none;
        }

        .doc-label {
            width: 42%;
            text-align: left;
            font-weight: 700;
            color: #334155;
        }

        .doc-separator {
            width: 5%;
            text-align: center;
        }

        .doc-value {
            text-align: left;
            color: #111827;
        }

        .header-line {
            margin-top: 8px;
            margin-bottom: 9px;
            border-top: 2px solid #0f2d62;
        }


        /* =========================
           SECTION
        ========================== */

        .section-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 7px;
        }

        .section-table > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            border: 1px solid #cbd5e1;
            padding: 8px 9px;
        }

        .section-table > tbody > tr > td:first-child {
            border-right: none;
        }

        .section-title {
            margin-bottom: 6px;
            padding-bottom: 3px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9.5px;
            font-weight: 700;
            color: #0f2d62;
            text-transform: uppercase;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table td {
            border: none !important;
            padding: 2px 0 !important;
            vertical-align: top;
        }

        .detail-label {
            width: 31%;
            font-weight: 700;
            color: #334155;
        }

        .detail-colon {
            width: 4%;
            text-align: center;
        }

        .detail-value {
            width: 65%;
            color: #111827;
        }


        /* =========================
           ADDRESS
        ========================== */

        .address-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 7px;
        }

        .address-table > tbody > tr > td {
            width: 50%;
            border: 1px solid #cbd5e1;
            vertical-align: top;
            padding: 8px 9px;
        }

        .address-table > tbody > tr > td:first-child {
            border-right: none;
        }

        .address-text {
            min-height: 42px;
            line-height: 1.45;
            color: #374151;
        }


        /* =========================
           BARANG
        ========================== */

        .goods-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
            margin-bottom: 7px;
        }

        .goods-table th,
        .goods-table td {
            border: 1px solid #94a3b8;
            padding: 5px 6px;
        }

        .goods-table th {
            background: #0f2d62;
            color: #ffffff;
            text-align: center;
            font-size: 8.5px;
            font-weight: 700;
        }

        .goods-table td {
            font-size: 9px;
        }

        .text-center {
            text-align: center;
        }


        /* =========================
           CATATAN
        ========================== */

        .notes-box {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            margin-bottom: 8px;
        }

        .notes-title {
            font-weight: 700;
            color: #0f2d62;
            margin-bottom: 2px;
        }

        .notes-text {
            color: #374151;
        }


        /* =========================
           PERNYATAAN
        ========================== */

        .statement {
            border: 1px solid #cbd5e1;
            padding: 5px 8px;
            margin-bottom: 9px;
            text-align: center;
            font-size: 8.5px;
            color: #374151;
        }


        /* =========================
           SIGNATURE
        ========================== */

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 33.33%;
            border: 1px solid #cbd5e1;
            text-align: center;
            vertical-align: top;
            padding: 6px 8px;
        }

        .signature-title {
            font-size: 8.5px;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
        }

        .signature-space {
            height: 48px;
        }

        .signature-name {
            width: 75%;
            margin: 0 auto;
            padding-top: 3px;
            border-top: 1px solid #475569;
            font-size: 8.5px;
            font-weight: 700;
        }

        .signature-role {
            margin-top: 2px;
            font-size: 7.5px;
            color: #64748b;
        }


        /* =========================
           FOOTER
        ========================== */

        .footer {
            margin-top: 7px;
            padding-top: 5px;
            border-top: 1px solid #cbd5e1;
            font-size: 7.5px;
            color: #64748b;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            border: none;
            padding: 0;
        }

        .footer-right {
            text-align: right;
        }
    </style>
</head>

<body>

@php
    $shipment = optional($deliveryOrder->shipment);

    $pickupAddress =
        $deliveryOrder->pickup_address ?: $shipment->pickup_address;

    $receiverName =
        $deliveryOrder->receiver_name ?: $shipment->receiver_name;

    $senderName =
        $deliveryOrder->sender_name ?: ($shipment->sender_name ?: '-');

    $transportType =
        $deliveryOrder->transportation_type ?: $shipment->transportation_type;

    $invoiceNumber =
        $shipment->invoice_number ?? '-';

    $receiptNumber =
        $shipment->receipt_number ?? '-';

    $itemType =
        $shipment->item_type ?: 'Barang Kiriman';

    $totalWeight =
        $shipment->total_weight
            ? number_format($shipment->total_weight, 2, ',', '.')
            : '-';
@endphp


<div class="page">

    <!-- ================= HEADER ================= -->

    <table class="header-table">
        <tr>

            <td class="logo-cell">
                <img
                    src="{{ public_path('images/bll.png') }}"
                    class="logo"
                    alt="BLL">
            </td>

            <td class="company-cell">

                <div class="company-name">
                    PT. BERLIAN LINTAS LOGISTIK
                </div>

                <div class="company-info">
                    Ruko Karang Anyar Permai 55 Blok B 18-19<br>
                    Jl. Karang Anyar Raya, Jakarta Pusat 10750<br>
                    Email : info@berlianlintaslogistik.com
                </div>

            </td>

            <td class="document-cell">

                <div class="document-title">
                    SURAT JALAN
                </div>

                <div class="document-type">
                    Pengambilan Barang
                </div>

                <table class="doc-info">

                    <tr>
                        <td class="doc-label">No. Surat Jalan</td>
                        <td class="doc-separator">:</td>
                        <td class="doc-value">
                            {{ $deliveryOrder->delivery_order_number }}
                        </td>
                    </tr>

                    <tr>
                        <td class="doc-label">Tanggal</td>
                        <td class="doc-separator">:</td>
                        <td class="doc-value">
                            {{ $deliveryOrder->order_date->format('d/m/Y') }}
                        </td>
                    </tr>

                    <tr>
                        <td class="doc-label">No. Resi</td>
                        <td class="doc-separator">:</td>
                        <td class="doc-value">
                            {{ $receiptNumber }}
                        </td>
                    </tr>

                </table>

            </td>

        </tr>
    </table>

    <div class="header-line"></div>


    <!-- ================= DETAIL DOKUMEN ================= -->

    <table class="section-table">
        <tr>

            <td>

                <div class="section-title">
                    Informasi Pengiriman
                </div>

                <table class="detail-table">

                    <tr>
                        <td class="detail-label">No. Invoice</td>
                        <td class="detail-colon">:</td>
                        <td class="detail-value">
                            {{ $invoiceNumber }}
                        </td>
                    </tr>

                    <tr>
                        <td class="detail-label">Pengirim</td>
                        <td class="detail-colon">:</td>
                        <td class="detail-value">
                            {{ $senderName }}
                        </td>
                    </tr>

                    <tr>
                        <td class="detail-label">Penerima</td>
                        <td class="detail-colon">:</td>
                        <td class="detail-value">
                            {{ $receiverName ?: '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="detail-label">Transportasi</td>
                        <td class="detail-colon">:</td>
                        <td class="detail-value">
                            {{ ucfirst($transportType ?: '-') }}
                        </td>
                    </tr>

                </table>

            </td>


            <td>

                <div class="section-title">
                    Informasi Operasional
                </div>

                <table class="detail-table">

                    <tr>
                        <td class="detail-label">Kendaraan</td>
                        <td class="detail-colon">:</td>
                        <td class="detail-value">

                            @if(optional($shipment->vehicle)->name)

                                {{ optional($shipment->vehicle)->name }}

                                @if(optional($shipment->vehicle)->license_plate)
                                    ({{ optional($shipment->vehicle)->license_plate }})
                                @endif

                            @else
                                -
                            @endif

                        </td>
                    </tr>

                    <tr>
                        <td class="detail-label">Tgl Berangkat</td>
                        <td class="detail-colon">:</td>

                        <td class="detail-value">

                            @if($shipment->land_departure_date)
                                {{ $shipment->land_departure_date->format('d/m/Y') }}
                            @elseif($shipment->sea_departure_date)
                                {{ $shipment->sea_departure_date->format('d/m/Y') }}
                            @elseif($shipment->air_departure_date)
                                {{ $shipment->air_departure_date->format('d/m/Y') }}
                            @else
                                -
                            @endif

                        </td>
                    </tr>

                    <tr>
                        <td class="detail-label">Estimasi</td>
                        <td class="detail-colon">:</td>
                        <td class="detail-value">
                            {{ $shipment->shipping_day ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="detail-label">Status Dokumen</td>
                        <td class="detail-colon">:</td>
                        <td class="detail-value">
                            Pengambilan Barang
                        </td>
                    </tr>

                </table>

            </td>

        </tr>
    </table>


    <!-- ================= ALAMAT ================= -->

    <table class="address-table">
        <tr>

            <td>

                <div class="section-title">
                    Lokasi Pengambilan Barang
                </div>

                <div class="address-text">

                    <strong>{{ $senderName }}</strong><br>

                    {{ $pickupAddress ?: '-' }}

                    @if($shipment->pickup_village)
                        <br>{{ $shipment->pickup_village }}
                    @endif

                    @if($shipment->pickup_district)
                        , {{ $shipment->pickup_district }}
                    @endif

                    @if($shipment->pickup_province)
                        <br>{{ $shipment->pickup_province }}
                    @endif

                    @if($shipment->pickup_postal_code)
                        &nbsp; {{ $shipment->pickup_postal_code }}
                    @endif

                </div>

            </td>


            <td>

                <div class="section-title">
                    Alamat Tujuan Pengiriman
                </div>

                <div class="address-text">

                    <strong>{{ $receiverName ?: '-' }}</strong><br>

                    {{ $shipment->destination_address ?: '-' }}

                    @if($shipment->destination_village)
                        <br>{{ $shipment->destination_village }}
                    @endif

                    @if($shipment->destination_district)
                        , {{ $shipment->destination_district }}
                    @endif

                    @if($shipment->destination_city)
                        <br>{{ $shipment->destination_city }}
                    @endif

                    @if($shipment->destination_province)
                        , {{ $shipment->destination_province }}
                    @endif

                    @if($shipment->destination_postal_code)
                        &nbsp; {{ $shipment->destination_postal_code }}
                    @endif

                </div>

            </td>

        </tr>
    </table>


    <!-- ================= BARANG ================= -->

    <table class="goods-table">

        <thead>
        <tr>
            <th style="width:5%;">NO</th>
            <th style="width:37%;">DESKRIPSI BARANG</th>
            <th style="width:13%;">JUMLAH</th>
            <th style="width:15%;">BERAT (KG)</th>
            <th style="width:30%;">KETERANGAN</th>
        </tr>
        </thead>

        <tbody>

        <tr>

            <td class="text-center">
                1
            </td>

            <td>
                {{ $itemType }}
            </td>

            <td class="text-center">
                {{ $shipment->total_qty ?? 1 }}
            </td>

            <td class="text-center">
                {{ $totalWeight }}
            </td>

            <td>
                {{ $deliveryOrder->notes ?: $shipment->notes ?: '-' }}
            </td>

        </tr>

        </tbody>

    </table>


    <!-- ================= CATATAN ================= -->

    <div class="notes-box">

        <div class="notes-title">
            CATATAN PENGAMBILAN
        </div>

        <div class="notes-text">
            Barang telah diserahkan oleh pihak pengirim kepada driver
            PT. Berlian Lintas Logistik untuk dilakukan proses pengiriman
            menuju alamat penerima sesuai data pengiriman yang tercantum
            pada surat jalan ini.
        </div>

    </div>


    <div class="statement">
        Dengan menandatangani dokumen ini, pihak terkait menyatakan bahwa
        barang telah diserahkan kepada driver dalam jumlah dan kondisi
        sebagaimana tercantum pada Surat Jalan.
    </div>


    <!-- ================= TANDA TANGAN ================= -->

    <table class="signature-table">

        <tr>

            <td>

                <div class="signature-title">
                    Dibuat Oleh
                </div>

                <div class="signature-role">
                    Admin Operasional
                </div>

                <div class="signature-space"></div>

                <div class="signature-name">
                    ( ____________________ )
                </div>

            </td>


            <td>

                <div class="signature-title">
                    Diterima Oleh
                </div>

                <div class="signature-role">
                    Driver
                </div>

                <div class="signature-space"></div>

                <div class="signature-name">
                    ( ____________________ )
                </div>

            </td>


            <td>

                <div class="signature-title">
                    Diserahkan Oleh
                </div>

                <div class="signature-role">
                    Pengirim
                </div>

                <div class="signature-space"></div>

                <div class="signature-name">
                    ( ____________________ )
                </div>

            </td>

        </tr>

    </table>


    <!-- ================= FOOTER ================= -->

    <div class="footer">

        <table class="footer-table">

            <tr>

                <td>
                    PT. Berlian Lintas Logistik
                </td>

                <td class="footer-right">
                    Dokumen Surat Jalan Pengambilan Barang
                </td>

            </tr>

        </table>

    </div>

</div>

</body>
</html>