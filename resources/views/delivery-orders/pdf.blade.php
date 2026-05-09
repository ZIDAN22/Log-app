<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan - {{ $deliveryOrder->delivery_order_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #1f2937;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1f2937;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .company-info {
            font-size: 10px;
            color: #6b7280;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            text-decoration: underline;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            margin-bottom: 8px;
        }
        .info-label {
            width: 120px;
            font-weight: bold;
            flex-shrink: 0;
        }
        .info-value {
            flex: 1;
        }
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 30%;
            text-align: center;
        }
        .signature-line {
            border-bottom: 1px solid #1f2937;
            margin-top: 40px;
            padding-bottom: 5px;
        }
        .signature-label {
            font-size: 10px;
            margin-top: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">PT. LOGISTIK INDONESIA</div>
        <div class="company-info">
            Jl. Industri No. 123, Jakarta<br>
            Telp: (021) 12345678 | Email: info@logistik.id
        </div>
    </div>

    <div class="title">SURAT JALAN</div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-label">No. Surat Jalan:</div>
            <div class="info-value">{{ $deliveryOrder->delivery_order_number }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal:</div>
            <div class="info-value">{{ $deliveryOrder->order_date->format('d/m/Y') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">No. Resi:</div>
            <div class="info-value">{{ $deliveryOrder->shipment->receipt_number }}</div>
        </div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-label">Pengirim:</div>
            <div class="info-value">{{ $deliveryOrder->sender_name }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Alamat Pickup:</div>
            <div class="info-value">{{ $deliveryOrder->pickup_address }}</div>
        </div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-label">Penerima:</div>
            <div class="info-value">{{ $deliveryOrder->receiver_name }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tujuan:</div>
            <div class="info-value">{{ $deliveryOrder->destination_city }}</div>
        </div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-label">Jenis Transportasi:</div>
            <div class="info-value">{{ ucfirst($deliveryOrder->transportation_type) }}</div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Jenis Barang</th>
                <th>Berat (kg)</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $deliveryOrder->shipment->item_type ?? 'Barang Kiriman' }}</td>
                <td>{{ number_format($deliveryOrder->shipment->total_weight, 2) }}</td>
                <td>1</td>
                <td>{{ $deliveryOrder->notes ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
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
</body>
</html>