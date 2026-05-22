<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi J&T Express Replica</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .resi-container {
            width: 800px;
            background-color: #fff;
            border: 2px solid #000;
            padding: 15px;
            position: relative;
        }
        
        /* Table Layout Base */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        td, th {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: top;
        }

        /* Header Section */
        .header-table td {
            border: none;
        }
        .logo-area {
            width: 30%;
        }
        .logo-text {
            color: #e60000;
            font-weight: bold;
            font-size: 26px;
            font-style: italic;
            line-height: 1;
        }
        .logo-sub {
            font-size: 9px;
            font-style: italic;
            color: #333;
            border-top: 1px solid #000;
            margin-top: 2px;
            padding-top: 2px;
            display: inline-block;
        }
        .center-code {
            width: 50%;
            text-align: center;
        }
        .main-code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .resi-num {
            font-size: 13px;
            font-weight: bold;
            margin-top: 2px;
        }
        .qr-right {
            width: 20%;
            text-align: right;
        }
        .qr-placeholder {
            width: 65px;
            height: 65px;
            border: 1px solid #000;
            display: inline-block;
            background: linear-gradient(45deg, #ccc 25%, transparent 25%), linear-gradient(-45deg, #ccc 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #ccc 75%), linear-gradient(-45deg, transparent 75%, #ccc 75%);
            background-size: 8px 8px;
        }
        .qr-text {
            font-size: 10px;
            font-weight: bold;
            text-align: right;
            margin-top: 2px;
        }

        /* Barcode Area */
        .barcode-row td {
            text-align: center;
            padding: 10px 0;
        }
        .barcode-placeholder {
            width: 85%;
            height: 55px;
            background: repeating-linear-gradient(90deg, #000, #000 2px, #fff 2px, #fff 6px);
            margin: 0 auto;
        }
        .barcode-num {
            font-size: 16px;
            font-weight: bold;
            margin-top: 5px;
            letter-spacing: 2px;
        }

        /* Address & Info Details */
        .bold-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 3px;
        }
        .route-box {
            text-align: center;
        }
        .route-title {
            font-size: 9px;
            color: #444;
            margin-bottom: 3px;
        }
        .route-val {
            font-size: 18px;
            font-weight: bold;
        }
        .arrow {
            font-size: 18px;
            padding-top: 12px !important;
        }

        /* Item List Table */
        .item-table th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }
        .center-text {
            text-align: center;
        }
        .right-text {
            text-align: right;
        }

        /* Bottom Section Split */
        .bottom-split {
            display: flex;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        .bottom-left-col {
            width: 60%;
        }
        .bottom-right-col {
            width: 40%;
            border-left: 1px solid #000;
            display: flex;
            flex-direction: column;
        }
        .info-row {
            padding: 6px;
            border-bottom: 1px solid #000;
            font-size: 11px;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .cod-box {
            display: flex;
            align-items: center;
            padding: 8px;
        }
        .non-cod {
            border: 2px solid #000;
            padding: 4px 10px;
            font-weight: bold;
            font-size: 13px;
            margin-right: 10px;
            background-color: #fff;
        }
        
        /* Lembar Penerima (Tanda Tangan) */
        .penerima-box {
            flex-grow: 1;
            padding: 8px;
            text-align: center;
            position: relative;
            min-height: 110px;
            border-bottom: 1px solid #000;
        }
        .penerima-title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 40px;
        }
        .penerima-line {
            border-bottom: 1px dashed #666;
            width: 80%;
            margin: 0 auto 4px auto;
        }
        .penerima-sub {
            font-size: 9px;
            color: #333;
        }

        /* Tracking QR Area */
        .tracking-box {
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
        }

        /* Footer Hotline */
        .footer-nav {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            font-weight: bold;
        }
        .footer-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }
    </style>
</head>
<body>

<div class="resi-container">
    <table class="header-table" style="border: 1px solid #000; border-bottom: none;">
        <tr>
            <td class="logo-area">
                <div class="logo-text">J&T<sub>EXPRESS</sub></div>
                <div class="logo-sub">— Express Your Online Business —</div>
            </td>
            <td class="center-code">
                <div class="main-code">SUB-SUB011</div>
                <div class="resi-num">No. Resi: JP4085147626</div>
            </td>
            <td class="qr-right">
                <div class="qr-placeholder"></div>
                <div class="qr-text">JP4085147626</div>
            </td>
        </tr>
    </table>

    <table style="border-left: 1px solid #000; border-right: 1px solid #000;">
        <tr class="barcode-row">
            <td>
                <div class="barcode-placeholder"></div>
                <div class="barcode-num">JP4085147626</div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width: 45%; padding: 0;" rowspan="2">
                <div style="padding: 6px; border-bottom: 1px solid #000; min-height: 95px;">
                    <div class="bold-title">Pengirim:</div>
                    <div style="font-weight: bold;">TOKO MAJU JAYA</div>
                    <div>Jl. Raya Menganti No. 45<br>Wiyung, Surabaya<br>Jawa Timur, 60228<br>0812-3456-7890</div>
                </div>
                <div style="padding: 6px; min-height: 110px;">
                    <div class="bold-title">Penerima:</div>
                    <div style="font-weight: bold;">BUDI SANTOSO</div>
                    <div>Jl. Merdeka No. 123<br>Kec. Coblong, Kota Bandung<br>Jawa Barat, 40132<br>0813-9876-5432</div>
                </div>
            </td>
            <td style="width: 55%; padding: 0;">
                <table style="border: none;">
                    <tr>
                        <td class="route-box" style="border-top: none; border-left: none; width: 22%;">
                            <div class="route-title">Kota Asal</div>
                            <div class="route-val">SUB</div>
                        </td>
                        <td class="center-text arrow" style="border-top: none; width: 6%; font-weight: bold;">&rarr;</td>
                        <td class="route-box" style="border-top: none; width: 22%;">
                            <div class="route-title">Kota Tujuan</div>
                            <div class="route-val">BDO</div>
                        </td>
                        <td class="route-box" style="border-top: none; width: 18%;">
                            <div class="route-title">Layanan</div>
                            <div class="route-val" style="font-size: 16px;">EZ</div>
                        </td>
                        <td class="route-box" style="border-top: none; width: 16%;">
                            <div class="route-title">Berat</div>
                            <div class="route-val" style="font-size: 13px; padding-top: 3px;">3.25 Kg</div>
                        </td>
                        <td class="route-box" style="border-top: none; width: 16%;">
                            <div class="route-title">Tanggal</div>
                            <div style="font-size: 10px; font-weight: bold; padding-top: 5px;">24-05-2024</div>
                        </td>
                        <td class="route-box" style="border-top: none; border-right: none; width: 16%;">
                            <div class="route-title">Jumlah Paket</div>
                            <div class="route-val" style="font-size: 14px;">1 / 1</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 0;">
                <table style="border: none; height: 100%;">
                    <tr>
                        <td style="border-left: none; border-bottom: none; width: 50%; min-height: 80px;">
                            <div class="bold-title" style="font-size: 11px;">INFORMASI PAKET</div>
                            <div style="margin-bottom: 4px;">Jenis Kiriman : <strong>PARCEL</strong></div>
                            <div>Pembayaran : <strong>Prepaid</strong></div>
                        </td>
                        <td style="border-right: none; border-bottom: none; width: 50%;">
                            <div style="font-weight: bold; font-size: 11px; margin-bottom: 3px;">Catatan Pengirim:</div>
                            <div style="font-size: 11px; line-height: 1.3;">Barang mudah pecah, mohon ditangani dengan hati-hati.</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="item-table">
        <thead>
            <tr>
                <th colspan="5" style="text-align: left; background-color: #fff; font-size: 12px; border-bottom: 2px solid #000;">ISI KIRIMAN</th>
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
            <tr>
                <td class="center-text">1</td>
                <td>Kaos Polos Hitam L</td>
                <td class="center-text">5</td>
                <td class="center-text">Pcs</td>
                <td class="right-text">1.00</td>
            </tr>
            <tr>
                <td class="center-text">2</td>
                <td>Kaos Polos Putih M</td>
                <td class="center-text">5</td>
                <td class="center-text">Pcs</td>
                <td class="right-text">1.00</td>
            </tr>
            <tr>
                <td class="center-text">3</td>
                <td>Topi Baseball Hitam</td>
                <td class="center-text">2</td>
                <td class="center-text">Pcs</td>
                <td class="right-text">0.40</td>
            </tr>
            <tr>
                <td class="center-text">4</td>
                <td>Stiker Merek</td>
                <td class="center-text">10</td>
                <td class="center-text">Lembar</td>
                <td class="right-text">0.10</td>
            </tr>
            <th colspan="2" style="text-align: left; background-color: #fff;">TOTAL</th>
            <th class="center-text" style="background-color: #fff;">22</th>
            <th style="background-color: #fff;"></th>
            <th class="right-text" style="background-color: #fff;">2.50</th>
        </tr>
        </tbody>
    </table>

    <div class="bottom-split">
        <div class="bottom-left-col">
            <div class="info-row">
                <strong>Keterangan:</strong> Barang dagangan
            </div>
            <div class="info-row" style="text-align: right; font-weight: bold; font-size: 12px; padding: 8px 6px;">
                Total Berat Aktual: 3.25 Kg
            </div>
            <div class="cod-box">
                <div class="non-cod">NON COD</div>
                <div style="font-size: 11px;">Tidak perlu bayar apapun ke kurir</div>
            </div>
        </div>
        
        <div class="bottom-right-col">
            <div class="penerima-box">
                <div class="penerima-title">LEMBAR PENERIMA</div>
                <div class="penerima-line"></div>
                <div class="penerima-sub">Tanda Tangan & Nama Terang</div>
            </div>
            <div class="tracking-box">
                <div style="width: 70%; line-height: 1.3;">
                    Scan untuk tracking paket<br>atau kunjungi jtexpress.id/track
                </div>
                <div class="qr-placeholder" style="width: 45px; height: 45px;"></div>
            </div>
        </div>
    </div>

    <div class="footer-nav">
        <div class="footer-item">📞 021 8066 1888</div>
        <div class="footer-item">🌐 www.jtexpress.id</div>
        <div class="footer-item">f J&T Express Indonesia</div>
        <div class="footer-item">🐦 @jtexpressid</div>
        <div class="footer-item">📸 jtexpressid</div>
    </div>
</div>

</body>
</html>