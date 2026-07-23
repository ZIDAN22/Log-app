<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Surat Jalan Pengiriman - {{ $delivery->delivery_number ?? '-' }}
    </title>

    <style>
        /* =========================================================
           PENGATURAN HALAMAN PDF
        ========================================================= */

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
            font-family: Arial, DejaVu Sans, sans-serif;
            font-size: 9.5px;
            line-height: 1.35;
            color: #111827;
            background: #ffffff;
        }

        .page {
            width: 100%;
        }


        /* =========================================================
           KOP SURAT
        ========================================================= */

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
            width: 50%;
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
            width: 38%;
            text-align: right;
        }

        .document-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #0f2d62;
            letter-spacing: .3px;
        }

        .document-subtitle {
            margin-top: 1px;
            margin-bottom: 5px;
            font-size: 8px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .6px;
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
            width: 39%;
            text-align: left;
            font-weight: 700;
            color: #334155;
        }

        .doc-colon {
            width: 5%;
            text-align: center;
        }

        .doc-value {
            width: 56%;
            text-align: left;
            color: #111827;
        }

        .document-number {
            color: #b91c1c;
            font-weight: 700;
        }

        .header-line {
            margin-top: 8px;
            margin-bottom: 9px;
            border-top: 2px solid #0f2d62;
        }


        /* =========================================================
           JUDUL SECTION
        ========================================================= */

        .section-title {
            margin-bottom: 5px;
            padding-bottom: 3px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9.5px;
            font-weight: 700;
            color: #0f2d62;
            text-transform: uppercase;
        }


        /* =========================================================
           INFORMASI UTAMA
        ========================================================= */

        .info-section {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 7px;
        }

        .info-section>tbody>tr>td {
            width: 50%;
            vertical-align: top;
            border: 1px solid #cbd5e1;
            padding: 7px 9px;
        }

        .info-section>tbody>tr>td:first-child {
            border-right: none;
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


        /* =========================================================
           PENGIRIM & PENERIMA
        ========================================================= */

        .address-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 7px;
        }

        .address-table>tbody>tr>td {
            width: 50%;
            border: 1px solid #cbd5e1;
            vertical-align: top;
            padding: 7px 9px;
        }

        .address-table>tbody>tr>td:first-child {
            border-right: none;
        }

        .party-name {
            font-size: 10px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 3px;
        }

        .address-text {
            min-height: 40px;
            font-size: 9px;
            line-height: 1.45;
            color: #374151;
        }


        /* =========================================================
           TABEL BARANG
        ========================================================= */

        .goods-title {
            margin-top: 1px;
            margin-bottom: 4px;
            font-size: 9.5px;
            font-weight: 700;
            color: #0f2d62;
            text-transform: uppercase;
        }

        .goods-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 7px;
        }

        .goods-table th,
        .goods-table td {
            border: 1px solid #94a3b8;
            padding: 5px 6px;
            vertical-align: middle;
        }

        .goods-table th {
            background: #0f2d62;
            color: #ffffff;
            text-align: center;
            font-size: 8.3px;
            font-weight: 700;
        }

        .goods-table td {
            font-size: 9px;
            color: #1f2937;
        }

        .text-center {
            text-align: center;
        }


        /* =========================================================
           OPERASIONAL
        ========================================================= */

        .operational-box {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 7px;
        }

        .operational-box td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            vertical-align: top;
        }

        .operational-label {
            display: block;
            margin-bottom: 2px;
            font-size: 7.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
        }

        .operational-value {
            font-size: 9px;
            font-weight: 700;
            color: #111827;
        }


        /* =========================================================
           CATATAN
        ========================================================= */

        .notes-box {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            margin-bottom: 7px;
        }

        .notes-title {
            margin-bottom: 2px;
            font-size: 8.5px;
            font-weight: 700;
            color: #0f2d62;
            text-transform: uppercase;
        }

        .notes-text {
            font-size: 8.5px;
            color: #374151;
            line-height: 1.4;
        }


        /* =========================================================
           PERNYATAAN
        ========================================================= */

        .statement {
            border: 1px solid #cbd5e1;
            padding: 5px 8px;
            margin-bottom: 8px;
            text-align: center;
            font-size: 8.3px;
            color: #374151;
        }


        /* =========================================================
           TANDA TANGAN
        ========================================================= */

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 33.33%;
            height: 88px;
            border: 1px solid #cbd5e1;
            text-align: center;
            vertical-align: top;
            padding: 6px 8px;
        }

        .signature-title {
            font-size: 8.5px;
            font-weight: 700;
            color: #111827;
            text-transform: uppercase;
        }

        .signature-role {
            margin-top: 2px;
            font-size: 7.5px;
            color: #64748b;
        }

        .signature-space {
            height: 42px;
        }

        .signature-name {
            width: 75%;
            margin: 0 auto;
            padding-top: 3px;
            border-top: 1px solid #475569;
            font-size: 8px;
            color: #111827;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            margin-top: 6px;
            padding-top: 4px;
            border-top: 1px solid #cbd5e1;
            font-size: 7.2px;
            color: #64748b;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            padding: 0;
            border: none;
        }

        .footer-right {
            text-align: right;
        }
    </style>
</head>


<body>

    @php

    /*
    |--------------------------------------------------------------------------
    | DATA UTAMA
    |--------------------------------------------------------------------------
    */

    $shipment = $delivery->shipment;
    $outbound = $delivery->outbound;
    $driver = $delivery->driver;
    $vehicle = $delivery->vehicle;


    /*
    |--------------------------------------------------------------------------
    | METODE PENGIRIMAN
    |--------------------------------------------------------------------------
    */

    $deliveryMethod = match (
    strtoupper((string) ($delivery->delivery_method ?? ''))
    ) {
    'DARAT' => 'Darat',
    'LAUT' => 'Laut',
    'UDARA' => 'Udara',
    default => $delivery->delivery_method ?? '-',
    };


    /*
    |--------------------------------------------------------------------------
    | ALAMAT PENGIRIM
    |--------------------------------------------------------------------------
    */

    $senderAddress = trim(
    implode(', ', array_filter([
    $shipment->pickup_village ?? null,
    $shipment->pickup_district ?? null,
    $shipment->pickup_city ?? null,
    $shipment->pickup_province ?? null,
    $shipment->pickup_postal_code ?? null,
    ]))
    );


    /*
    |--------------------------------------------------------------------------
    | ALAMAT PENERIMA
    |--------------------------------------------------------------------------
    */

    $receiverAddress = trim(
    implode(', ', array_filter([
    $shipment->destination_village ?? null,
    $shipment->destination_district ?? null,
    $shipment->destination_city ?? null,
    $shipment->destination_province ?? null,
    $shipment->destination_postal_code ?? null,
    ]))
    );


    /*
    |--------------------------------------------------------------------------
    | DETAIL BARANG
    |--------------------------------------------------------------------------
    */

    $itemDescription =
    $outbound->item_description
    ?? $shipment->item_type
    ?? 'Barang Kiriman';

    $weight =
    $shipment->actual_weight
    ?? $shipment->total_weight
    ?? 0;

    $chargeableWeight =
    $shipment->chargeable_weight
    ?? $weight;

    $quantity =
    $outbound->quantity
    ?? $shipment->total_qty
    ?? 1;

    $noteText =
    $outbound->delivery_notes
    ?? $shipment->notes
    ?? null;


    /*
    |--------------------------------------------------------------------------
    | KENDARAAN
    |--------------------------------------------------------------------------
    */

    $vehicleName =
    $vehicle->name
    ?? '-';

    $vehiclePlate =
    $vehicle->plate_number
    ?? $vehicle->license_plate
    ?? '-';


    /*
    |--------------------------------------------------------------------------
    | DRIVER
    |--------------------------------------------------------------------------
    */

    $driverName =
    $driver->name
    ?? '-';

    @endphp


    <div class="page">


        <!-- =========================================================
         KOP SURAT
    ========================================================== -->

        <table class="header-table">

            <tr>

                <td class="logo-cell">

                    <img src="{{ public_path('images/bll.png') }}" class="logo" alt="Logo PT Berlian Lintas Logistik">

                </td>


                <td class="company-cell">

                    <div class="company-name">
                        PT. BERLIAN LINTAS LOGISTIK
                    </div>

                    <div class="company-info">
                        Jl. Kampung Bandan Rt 02/04 Lapangan Tanah Merah <br>
                        Kecamatan Pademangan, Jakarta Utara 14430 <br>
                        Email : berlianlintaslogistik@gmail.com
                    </div>

                </td>


                <td class="document-cell">

                    <div class="document-title">
                        SURAT JALAN
                    </div>

                    <div class="document-subtitle">
                        Pengiriman Barang
                    </div>


                    <table class="doc-info">

                        <tr>

                            <td class="doc-label">
                                No. Surat Jalan
                            </td>

                            <td class="doc-colon">
                                :
                            </td>

                            <td class="doc-value document-number">
                                {{ $delivery->delivery_number ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="doc-label">
                                Tanggal
                            </td>

                            <td class="doc-colon">
                                :
                            </td>

                            <td class="doc-value">
                                {{ optional($delivery->created_at ?? now())->format('d/m/Y') }}
                            </td>

                        </tr>


                        <tr>

                            <td class="doc-label">
                                No. Resi
                            </td>

                            <td class="doc-colon">
                                :
                            </td>

                            <td class="doc-value">
                                {{ $shipment->receipt_number ?? '-' }}
                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

        </table>


        <div class="header-line"></div>



        <!-- =========================================================
         INFORMASI DOKUMEN & OPERASIONAL
    ========================================================== -->

        <table class="info-section">

            <tr>

                <!-- KIRI -->

                <td>

                    <div class="section-title">
                        Informasi Pengiriman
                    </div>


                    <table class="detail-table">

                        <tr>

                            <td class="detail-label">
                                No. Invoice
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $shipment->invoice_number ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="detail-label">
                                Pengirim
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $shipment->sender_name ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="detail-label">
                                Penerima
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $shipment->receiver_name ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="detail-label">
                                Transportasi
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $deliveryMethod }}
                            </td>

                        </tr>

                    </table>

                </td>



                <!-- KANAN -->

                <td>

                    <div class="section-title">
                        Informasi Operasional
                    </div>


                    <table class="detail-table">

                        <tr>

                            <td class="detail-label">
                                Driver
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $driverName }}
                            </td>

                        </tr>


                        <tr>

                            <td class="detail-label">
                                Kendaraan
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $vehicleName }}
                            </td>

                        </tr>


                        <tr>

                            <td class="detail-label">
                                No. Polisi
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $vehiclePlate }}
                            </td>

                        </tr>


                        <tr>

                            <td class="detail-label">
                                Status
                            </td>

                            <td class="detail-colon">
                                :
                            </td>

                            <td class="detail-value">
                                {{ $delivery->statusLabel() }}
                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

        </table>



        <!-- =========================================================
         PENGIRIM & PENERIMA
    ========================================================== -->

        <table class="address-table">

            <tr>

                <!-- PENGIRIM -->

                <td>

                    <div class="section-title">
                        Pengirim (Shipper)
                    </div>


                    <div class="party-name">
                        {{ $shipment->sender_name ?? '-' }}
                    </div>


                    <div class="address-text">

                        {{ $shipment->pickup_address ?? '-' }}

                        @if($senderAddress)

                        <br>
                        {{ $senderAddress }}

                        @endif

                    </div>

                </td>



                <!-- PENERIMA -->

                <td>

                    <div class="section-title">
                        Penerima (Consignee)
                    </div>


                    <div class="party-name">
                        {{ $shipment->receiver_name ?? '-' }}
                    </div>


                    <div class="address-text">

                        {{ $shipment->destination_address ?? '-' }}

                        @if($receiverAddress)

                        <br>
                        {{ $receiverAddress }}

                        @endif

                    </div>

                </td>

            </tr>

        </table>



        <!-- =========================================================
         DETAIL BARANG
    ========================================================== -->

        <div class="goods-title">
            Detail Barang
        </div>


        <table class="goods-table">

            <thead>

                <tr>

                    <th style="width: 5%;">
                        NO
                    </th>

                    <th style="width: 36%;">
                        DESKRIPSI BARANG
                    </th>

                    <th style="width: 11%;">
                        JUMLAH
                    </th>

                    <th style="width: 14%;">
                        BERAT (KG)
                    </th>

                    <th style="width: 16%;">
                        CHARGEABLE
                    </th>

                    <th style="width: 18%;">
                        KETERANGAN
                    </th>

                </tr>

            </thead>


            <tbody>

                <tr>

                    <td class="text-center">
                        1
                    </td>


                    <td>
                        {{ $itemDescription }}
                    </td>


                    <td class="text-center">
                        {{ $quantity }}
                    </td>


                    <td class="text-center">
                        {{ number_format((float) $weight, 2, ',', '.') }}
                    </td>


                    <td class="text-center">
                        {{ number_format((float) $chargeableWeight, 2, ',', '.') }} kg
                    </td>


                    <td>
                        {{ $noteText ?: '-' }}
                    </td>

                </tr>

            </tbody>

        </table>



        <!-- =========================================================
         INFORMASI TRANSPORTASI
    ========================================================== -->

        <table class="operational-box">

            <tr>

                <td style="width: 25%;">

                    <span class="operational-label">
                        Transportasi
                    </span>

                    <span class="operational-value">
                        {{ $deliveryMethod }}
                    </span>

                </td>


                <td style="width: 25%;">

                    <span class="operational-label">
                        Driver / Kurir
                    </span>

                    <span class="operational-value">
                        {{ $driverName }}
                    </span>

                </td>


                <td style="width: 25%;">

                    <span class="operational-label">
                        Kendaraan
                    </span>

                    <span class="operational-value">
                        {{ $vehicleName }}
                    </span>

                </td>


                <td style="width: 25%;">

                    <span class="operational-label">
                        Nomor Polisi
                    </span>

                    <span class="operational-value">
                        {{ $vehiclePlate }}
                    </span>

                </td>

            </tr>

        </table>



        <!-- =========================================================
         CATATAN
    ========================================================== -->

        <div class="notes-box">

            <div class="notes-title">
                Catatan Pengiriman
            </div>


            <div class="notes-text">

                @if($noteText)

                {{ $noteText }}

                @else

                Barang dibawa oleh driver PT. Berlian Lintas Logistik
                untuk dikirimkan ke alamat penerima sebagaimana
                tercantum pada dokumen ini.

                @endif

            </div>

        </div>



        <!-- =========================================================
         PERNYATAAN
    ========================================================== -->

        <div class="statement">

            Dokumen ini menyatakan bahwa barang telah keluar untuk proses
            pengiriman dan dibawa oleh driver PT. Berlian Lintas Logistik
            menuju alamat penerima sesuai informasi pengiriman yang tercantum.

        </div>



        <!-- =========================================================
         TANDA TANGAN
    ========================================================== -->

        <table class="signature-table">

            <tr>

                <!-- ADMIN -->

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



                <!-- DRIVER -->

                <td>

                    <div class="signature-title">
                        Dibawa Oleh
                    </div>

                    <div class="signature-role">
                        Driver / Kurir
                    </div>

                    <div class="signature-space"></div>

                    <div class="signature-name">

                        @if($driverName !== '-')

                        ( {{ $driverName }} )

                        @else

                        ( ____________________ )

                        @endif

                    </div>

                </td>



                <!-- PENERIMA -->

                <td>

                    <div class="signature-title">
                        Diterima Oleh
                    </div>

                    <div class="signature-role">
                        Penerima Barang
                    </div>

                    <div class="signature-space"></div>

                    <div class="signature-name">
                        ( ____________________ )
                    </div>

                </td>

            </tr>

        </table>



        <!-- =========================================================
         FOOTER
    ========================================================== -->

        <div class="footer">

            <table class="footer-table">

                <tr>

                    <td>
                        PT. Berlian Lintas Logistik
                    </td>

                    <td class="footer-right">
                        Surat Jalan Pengiriman Barang
                    </td>

                </tr>

            </table>

        </div>


    </div>

</body>

</html>