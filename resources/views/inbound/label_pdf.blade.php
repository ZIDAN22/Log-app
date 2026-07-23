<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Label Pengiriman - {{ $inbound->shipment->receipt_number ?? 'N/A' }}
    </title>

    <style>

        /* =========================================================
           A4
        ========================================================= */

        @page {
            size: A4 portrait;
            margin: 16mm 15mm;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
            font-family: Arial, DejaVu Sans, sans-serif;
            color: #111827;
            background: #ffffff;
            font-size: 9px;
            line-height: 1.35;
        }

        .page {
            width: 100%;
        }

        .label {
            width: 96%;
            margin: 0 auto;
            border: 1.4px solid #1f2937;
            border-radius: 8px;
            overflow: hidden;
            background: #ffffff;
        }

        table {
            border-collapse: collapse;
            table-layout: fixed;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .header-table {
            width: 100%;
        }

        .header-table td {
            vertical-align: middle;
            padding: 9px 10px;
        }

        .logo-cell {
            width: 13%;
            text-align: center;
        }

        .logo {
            width: 58px;
            max-height: 46px;
            object-fit: contain;
        }

        .company-cell {
            width: 45%;
            padding-left: 2px !important;
        }

        .company-name {
            font-size: 15px;
            font-weight: 700;
            color: #0b1f44;
            margin-bottom: 2px;
        }

        .company-info {
            font-size: 6.4px;
            line-height: 1.4;
            color: #64748b;
        }

        .title-cell {
            width: 42%;
            text-align: center;
            border-left: 1px solid #cbd5e1;
        }

        .document-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f2d62;
            letter-spacing: .3px;
        }

        .document-subtitle {
            margin-top: 2px;
            font-size: 6.5px;
            font-weight: 700;
            color: #64748b;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .service-badge {
            display: inline-block;
            margin-top: 5px;
            padding: 4px 14px;
            background: #0f2d62;
            color: #ffffff;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }


        /* =========================================================
           MAIN AREA
        ========================================================= */

        .main-table {
            width: 100%;
            border-top: 2px solid #0f2d62;
        }

        .main-left {
            width: 70%;
            vertical-align: top;
            border-right: 1px solid #64748b;
        }

        .main-right {
            width: 30%;
            vertical-align: top;
        }


        /* =========================================================
           RECEIPT + BARCODE
        ========================================================= */

        .tracking-box {
            padding: 10px 12px 9px;
            border-bottom: 1px solid #64748b;
        }

        .field-label {
            font-size: 6px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .receipt-big {
            margin-top: 2px;
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            letter-spacing: 1px;
        }

        .barcode-img {
            display: block;
            width: auto;
            max-width: 94%;
            height: 54px;
            margin: 7px auto 0;
            object-fit: contain;
        }

        .barcode-placeholder {
            width: 92%;
            height: 52px;
            margin: 7px auto 0;
            border: 1px solid #cbd5e1;
        }

        .barcode-number {
            margin-top: 4px;
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }


        /* =========================================================
           SHIPPER + CONSIGNEE
        ========================================================= */

        .party-table {
            width: 100%;
        }

        .party-table td {
            width: 50%;
            padding: 9px 10px;
            vertical-align: top;
        }

        .party-table td:first-child {
            border-right: 1px solid #cbd5e1;
        }

        .party-title {
            margin-bottom: 4px;
            font-size: 6.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
        }

        .party-name {
            margin-bottom: 3px;
            font-size: 11px;
            font-weight: 700;
            color: #111827;
        }

        .receiver-name {
            color: #0f2d62;
            font-size: 12px;
        }

        .party-address {
            font-size: 7.5px;
            line-height: 1.45;
            color: #374151;
        }

        .postal {
            margin-top: 2px;
            font-weight: 700;
            color: #111827;
        }


        /* =========================================================
           RIGHT SIDE QR
        ========================================================= */

        .qr-box {
            padding: 9px;
            text-align: center;
            border-bottom: 1px solid #64748b;
        }

        .qr-img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        .qr-placeholder {
            width: 90px;
            height: 90px;
            margin: 0 auto;
            border: 1px solid #94a3b8;
            line-height: 90px;
            text-align: center;
            color: #64748b;
        }

        .qr-caption {
            margin-top: 3px;
            font-size: 5.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
        }


        /* =========================================================
           RIGHT INFORMATION
        ========================================================= */

        .side-info {
            padding: 7px 9px;
            border-bottom: 1px solid #cbd5e1;
        }

        .side-info:last-child {
            border-bottom: none;
        }

        .side-label {
            margin-bottom: 2px;
            font-size: 6px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
        }

        .side-value {
            font-size: 11px;
            font-weight: 700;
            color: #111827;
        }

        .side-value-big {
            font-size: 15px;
            font-weight: 700;
            color: #0f2d62;
        }


        /* =========================================================
           BOTTOM
        ========================================================= */

        .bottom-table {
            width: 100%;
            border-top: 1px solid #64748b;
        }

        .bottom-table td {
            padding: 9px 10px;
            vertical-align: middle;
        }

        .destination-cell {
            width: 38%;
            border-right: 1px solid #cbd5e1;
        }

        .content-cell {
            width: 38%;
            border-right: 1px solid #cbd5e1;
        }

        .package-cell {
            width: 24%;
            text-align: center;
        }

        .bottom-label {
            margin-bottom: 3px;
            font-size: 6px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
        }

        .destination-big {
            font-size: 15px;
            font-weight: 700;
            color: #0f2d62;
            text-transform: uppercase;
            line-height: 1.15;
        }

        .destination-region {
            margin-top: 2px;
            font-size: 7px;
            color: #475569;
        }

        .content-value {
            font-size: 9px;
            font-weight: 700;
            color: #111827;
            line-height: 1.4;
        }

        .package-type {
            font-size: 13px;
            font-weight: 700;
            color: #0f2d62;
            text-transform: uppercase;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            width: 96%;
            margin: 5px auto 0;
            text-align: center;
            font-size: 6px;
            color: #94a3b8;
        }


        /* =========================================================
           PRINT
        ========================================================= */

        @media print {

            html,
            body {
                margin: 0;
                padding: 0;
            }

            .label,
            table,
            tr,
            td {
                page-break-inside: avoid;
            }

        }

    </style>

</head>


<body>


@php

    /*
    |--------------------------------------------------------------------------
    | SHIPMENT
    |--------------------------------------------------------------------------
    */

    $shipment = $inbound->shipment;


    /*
    |--------------------------------------------------------------------------
    | PENGIRIM
    |--------------------------------------------------------------------------
    */

    $senderRegion = collect([
        $shipment->pickup_village ?? null,
        $shipment->pickup_district ?? null,
        $shipment->pickup_city ?? null,
        $shipment->pickup_province ?? null,
    ])
    ->filter()
    ->implode(', ');


    /*
    |--------------------------------------------------------------------------
    | PENERIMA
    |--------------------------------------------------------------------------
    */

    $receiverRegion = collect([
        $shipment->destination_village ?? null,
        $shipment->destination_district ?? null,
        $shipment->destination_city ?? null,
        $shipment->destination_province ?? null,
    ])
    ->filter()
    ->implode(', ');


    /*
    |--------------------------------------------------------------------------
    | LAYANAN
    |--------------------------------------------------------------------------
    */

    $service = strtoupper(
        $shipment->service ?? 'REG'
    );


    /*
    |--------------------------------------------------------------------------
    | TRANSPORTASI
    |--------------------------------------------------------------------------
    |
    | Menggunakan field transportation_type jika tersedia.
    | Jika kosong tidak mengarang jenis transportasi.
    |
    */

    $transportation = strtoupper(
        $shipment->transportation_type ?? ''
    );


    /*
    |--------------------------------------------------------------------------
    | TOTAL KOLI
    |--------------------------------------------------------------------------
    */

    $totalPackage = max(
        (int) ($inbound->total_package ?? 1),
        1
    );


    /*
    |--------------------------------------------------------------------------
    | NOMOR KOLI
    |--------------------------------------------------------------------------
    */

    $packageSequence = $packageSequence ?? 1;


    /*
    |--------------------------------------------------------------------------
    | ISI KIRIMAN
    |--------------------------------------------------------------------------
    */

    $itemNames = $inbound->items
        ->pluck('item_name')
        ->filter()
        ->unique()
        ->implode(', ');


    /*
    |--------------------------------------------------------------------------
    | PACKAGING
    |--------------------------------------------------------------------------
    */

    $packagingTypes = $inbound->items
        ->pluck('packaging_type')
        ->filter()
        ->unique()
        ->implode(', ');

@endphp



<div class="page">


    <div class="label">


        <!-- =====================================================
             HEADER / KOP
        ====================================================== -->

        <table class="header-table">

            <tr>


                <!-- LOGO BLL -->

                <td class="logo-cell">

                    <img
                        src="{{ public_path('images/bll.png') }}"
                        class="logo"
                        alt="BLL"
                    >

                </td>



                <!-- COMPANY -->

                <td class="company-cell">

                    <div class="company-name">
                        PT. BERLIAN LINTAS LOGISTIK
                    </div>


                    <div class="company-info">

                        Jl. Kampung Bandan RT 02/04 Lapangan Tanah Merah<br>

                        Kecamatan Pademangan, Jakarta Utara 14430<br>

                        Email: berlianlintaslogistik@gmail.com

                    </div>

                </td>



                <!-- LABEL -->

                <td class="title-cell">

                    <div class="document-title">
                        LABEL PENGIRIMAN
                    </div>


                    <div class="document-subtitle">
                        SHIPPING LABEL
                    </div>


                    @if($transportation)

                        <div class="service-badge">
                            {{ $transportation }}
                        </div>

                    @endif

                </td>


            </tr>

        </table>



        <!-- =====================================================
             MAIN CONTENT
        ====================================================== -->

        <table class="main-table">

            <tr>


                <!-- =================================================
                     LEFT
                ================================================== -->

                <td class="main-left">


                    <!-- =============================================
                         NO RESI + BARCODE
                    ============================================== -->

                    <div class="tracking-box">


                        <div class="field-label">
                            No. Resi / Tracking Number
                        </div>




                        @if(!empty($barcodeData))

                            <img
                                src="{{ $barcodeData }}"
                                class="barcode-img"
                                alt="Barcode"
                            >

                        @else

                            <div class="barcode-placeholder"></div>

                        @endif


                        <div class="barcode-number">

                            {{ $shipment->receipt_number ?? '-' }}

                        </div>


                    </div>



                    <!-- =============================================
                         PENGIRIM + PENERIMA
                    ============================================== -->

                    <table class="party-table">

                        <tr>


                            <!-- PENGIRIM -->

                            <td>


                                <div class="party-title">
                                    Pengirim / Shipper
                                </div>


                                <div class="party-name">

                                    {{ $shipment->sender_name ?? '-' }}

                                </div>


                                <div class="party-address">

                                    {{ $shipment->pickup_address ?? '-' }}


                                    @if($senderRegion)

                                        <br>
                                        {{ $senderRegion }}

                                    @endif


                                    @if($shipment->pickup_postal_code)

                                        <div class="postal">

                                            Kode Pos:
                                            {{ $shipment->pickup_postal_code }}

                                        </div>

                                    @endif

                                </div>


                            </td>



                            <!-- PENERIMA -->

                            <td>


                                <div class="party-title">
                                    Penerima / Consignee
                                </div>


                                <div class="party-name receiver-name">

                                    {{ $shipment->receiver_name ?? '-' }}

                                </div>


                                <div class="party-address">

                                    {{ $shipment->destination_address ?? '-' }}


                                    @if($receiverRegion)

                                        <br>
                                        {{ $receiverRegion }}

                                    @endif


                                    @if($shipment->destination_postal_code)

                                        <div class="postal">

                                            Kode Pos:
                                            {{ $shipment->destination_postal_code }}

                                        </div>

                                    @endif

                                </div>


                            </td>


                        </tr>

                    </table>


                </td>



                <!-- =================================================
                     RIGHT
                ================================================== -->

                <td class="main-right">


                    <!-- QR -->

                    <div class="qr-box">


                        @if(!empty($qrData))

                            <img
                                src="{{ $qrData }}"
                                class="qr-img"
                                alt="QR Code"
                            >

                        @else

                            <div class="qr-placeholder">
                                QR
                            </div>

                        @endif


                        <div class="qr-caption">
                            Scan Tracking
                        </div>


                    </div>



                    <!-- LAYANAN -->

                    <div class="side-info">

                        <div class="side-label">
                            Layanan
                        </div>


                        <div class="side-value">

                            {{ $service }}

                        </div>

                    </div>



                    <!-- BERAT -->

                    <div class="side-info">

                        <div class="side-label">
                            Berat Kiriman
                        </div>


                        <div class="side-value">

                            {{ number_format(
                                (float) ($inbound->total_weight ?? 0),
                                2,
                                ',',
                                '.'
                            ) }} KG

                        </div>

                    </div>



                    <!-- JUMLAH KOLI -->

                    <div class="side-info">

                        <div class="side-label">
                            Jumlah Koli
                        </div>


                        <div class="side-value">

                            {{ $totalPackage }} KOLI

                        </div>

                    </div>



                    <!-- NOMOR KOLI -->

                    <div class="side-info">

                        <div class="side-label">
                            Paket / Package
                        </div>


                        <div class="side-value-big">

                            {{ $packageSequence }}
                            /
                            {{ $totalPackage }}

                        </div>

                    </div>


                </td>


            </tr>

        </table>



        <!-- =====================================================
             BOTTOM INFORMATION
        ====================================================== -->

        <table class="bottom-table">

            <tr>


                <!-- TUJUAN -->

                <td class="destination-cell">


                    <div class="bottom-label">
                        Tujuan / Destination
                    </div>


                    <div class="destination-big">

                        {{ $shipment->destination_city ?? '-' }}

                    </div>


                    @if($shipment->destination_province)

                        <div class="destination-region">

                            {{ strtoupper(
                                $shipment->destination_province
                            ) }}

                        </div>

                    @endif


                </td>



                <!-- ISI BARANG -->

                <td class="content-cell">


                    <div class="bottom-label">
                        Isi Kiriman / Shipment Content
                    </div>


                    <div class="content-value">

                        {{ $itemNames
                            ?: ($shipment->item_type ?? 'Barang Kiriman')
                        }}

                    </div>


                </td>



                <!-- PACKAGING -->

                <td class="package-cell">


                    <div class="bottom-label">
                        Jenis Kemasan
                    </div>


                    <div class="package-type">

                        {{ $packagingTypes ?: '-' }}

                    </div>


                </td>


            </tr>

        </table>


    </div>



</div>


</body>

</html>