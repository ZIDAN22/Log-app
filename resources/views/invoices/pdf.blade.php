<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>

    <style>
        @page {
            margin: 18px;
        }

        body {
            font-family: Arial, sans-serif;
            color: #111827;
            font-size: 11px;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        .container {
            width: 100%;
        }

        .header {
            width: 100%;
            margin-bottom: 12px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .company-info {
            font-size: 11px;
            color: #374151;
            line-height: 1.6;
        }

        .invoice-title {
            font-size: 36px;
            font-weight: bold;
            color: #0f2d62;
        }

        .text-right {
            text-align: right;
        }

        .divider {
            border-top: 3px solid #0f2d62;
            margin: 14px 0 18px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 18px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 4px 6px;
            vertical-align: top;
            font-size: 11px;
        }

        .label {
            width: 120px;
            font-weight: bold;
        }

        .colon {
            width: 10px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table.items th {
            background: #0f2d62;
            color: white;
            padding: 8px 6px;
            border: 1px solid #d1d5db;
            font-size: 11px;
            text-align: center;
        }

        table.items td {
            padding: 7px 6px;
            border: 1px solid #d1d5db;
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            width: 42%;
            margin-left: auto;
            margin-top: 14px;
            border-collapse: collapse;
        }

        .summary td {
            padding: 5px 6px;
            font-size: 11px;
        }

        .summary .grand-total td {
            border-top: 2px solid #0f2d62;
            font-weight: bold;
            font-size: 13px;
            padding-top: 8px;
        }

        .terbilang {
            margin-top: 20px;
            font-size: 11px;
        }

        .note-box {
            margin-top: 18px;
            border: 1px solid #0f2d62;
            border-radius: 10px;
            padding: 12px;
        }

        .note-title {
            font-weight: bold;
            color: #0f2d62;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .note-table {
            width: 100%;
            border-collapse: collapse;
        }

        .note-table td {
            padding: 3px 0;
            font-size: 11px;
        }

        .signature {
            width: 100%;
            margin-top: 45px;
            text-align: center;
        }

        .signature td {
            width: 50%;
            vertical-align: top;
            font-size: 11px;
        }

        .sign-space {
            height: 65px;
        }

        .sign-line {
            width: 180px;
            border-top: 1px solid #111827;
            margin: 0 auto;
            padding-top: 5px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            margin-top: 8px;
        }

        .unpaid {
            background: #fee2e2;
            color: #b91c1c;
        }

        .paid {
            background: #dcfce7;
            color: #166534;
        }

        .dp {
            background: #fef3c7;
            color: #92400e;
        }
    </style>
</head>
<body>

<div class="container">

    {{-- HEADER --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td width="20%">
                    <img src="{{ public_path('images/bll.png') }}" alt="Logo" style="max-height: 72px; width: auto;" />
                </td>
                <td width="80%">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <div class="company-name">PT. BERLIAN LINTAS LOGISTIK</div>
                            <div class="company-info">
                                Ruko Karang Anyar Permai 55 Blok B 18-19<br>
                                Jl. Karang Anyar Raya Jakarta Pusat 10750<br>
                                Email : https://berlianlintaslogistik.com
                            </div>
                        </div>

                        <div class="text-right">
                            <div class="invoice-title">INVOICE</div>
   
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="divider"></div>
    </div>

    {{-- INFORMASI --}}
    <table class="info-table">
        <tr>
            <td class="label">NO INVOICE</td>
            <td class="colon">:</td>
            <td>{{ $invoice->invoice_number }}</td>
        </tr>

        <tr>
            <td class="label">KEPADA</td>
            <td class="colon">:</td>
            <td>{{ $invoice->customer_name }}</td>
        </tr>

        <tr>
            <td class="label">ALAMAT KIRIM</td>
            <td class="colon">:</td>
            <td>{{ $invoice->packingList->shipment->destination_address ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">TGL INVOICE</td>
            <td class="colon">:</td>
            <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
        </tr>
    </table>

    {{-- TABLE BARANG --}}
    <table class="items">
        <thead>
        <tr>
            <th>NO</th>
            <th>NAMA BARANG</th>
            <th>QTY</th>
            <th>PACKAGING</th>
            <th>BERAT/KG</th>
            <th>NO RESI</th>
            <th>HARGA /KG</th>
            <th>SUBTOTAL</th>
        </tr>
        </thead>

        <tbody>
        @foreach($invoice->packingList->items as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->item_name }}</td>
                <td class="text-center">{{ $item->qty }}</td>
                <td class="text-center">{{ $item->packaging_type }}</td>
                <td class="text-right">
                    {{ number_format($item->weight, 2, ',', '.') }}
                </td>
                <td class="text-center">{{ $invoice->receipt_number }}</td>
                <td class="text-right">
                    Rp {{ number_format($invoice->packingList->shipment->price_per_kg ?? 0, 0, ',', '.') }}
                </td>
                <td class="text-right">
                    Rp {{ number_format(($invoice->packingList->shipment->price_per_kg ?? 0) * $item->weight, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- SUMMARY --}}
    <table class="summary">
        <tr>
            <td>PPN 1.1%</td>
            <td class="text-right">
                Rp {{ number_format($invoice->ppn_amount, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td>PPH 2%</td>
            <td class="text-right">
                Rp {{ number_format($invoice->pph_amount, 0, ',', '.') }}
            </td>
        </tr>

        <tr class="grand-total">
            <td>GRAND TOTAL</td>
            <td class="text-right">
                Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    {{-- TERBILANG --}}
    <div class="terbilang">
        <strong>TERBILANG :</strong>
        {{ $invoice->terbilang ?? '-' }}
    </div>

    {{-- NOTE --}}
    <div class="note-box">
        <div class="note-title">
            NOTE : PEMBAYARAN MELALUI REKENING
        </div>

        <table class="note-table">
            <tr>
                <td width="70">BANK</td>
                <td width="10">:</td>
                <td>{{ $invoice->bank_name ?? '-' }}</td>
            </tr>

            <tr>
                <td>REK</td>
                <td>:</td>
                <td>{{ $invoice->bank_account_number ?? '-' }}</td>
            </tr>

            <tr>
                <td>AN</td>
                <td>:</td>
                <td>{{ $invoice->bank_account_name ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- TTD --}}
    <table class="signature">
        <tr>
            <td>
                Mengetahui
                <div class="sign-space"></div>
                <div class="sign-line">(__________________)</div>
            </td>

            <td>
                Diterima Oleh
                <div class="sign-space"></div>
                <div class="sign-line">(__________________)</div>
            </td>
        </tr>
    </table>

</div>

</body>
</html>