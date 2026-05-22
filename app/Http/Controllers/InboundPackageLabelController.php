<?php

namespace App\Http\Controllers;

use App\Models\Inbound;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InboundPackageLabelController extends Controller
{
    // public function show(Inbound $inbound)
    // {
    //     $inbound->load('shipment', 'items');
    //     [$barcodeData, $qrData] = $this->generateBarcodeQr($inbound->shipment->receipt_number ?? '');

    //     return view('inbound.package_label', compact('inbound', 'barcodeData', 'qrData'));
    // }

    public function preview(Inbound $inbound)
    {
        $inbound->load('shipment', 'items');
        [$barcodeData, $qrData] = $this->generateBarcodeQr($inbound->shipment->receipt_number ?? '');

        return view('inbound.label_pdf', compact('inbound', 'barcodeData', 'qrData'));
    }

    public function pdf(Inbound $inbound)
    {
        $inbound->load('shipment', 'items');
        [$barcodeData, $qrData] = $this->generateBarcodeQr($inbound->shipment->receipt_number ?? '');

        $pdf = PDF::loadView('inbound.label_pdf', compact('inbound', 'barcodeData', 'qrData'))
            ->setPaper(array(0, 0, 283.46, 425.2), 'portrait');

        $filename = 'package-label-' . ($inbound->id ?? time()) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Generate barcode (1D) and QR code data URIs using installed libraries if available.
     * Returns array [barcodeData|null, qrData|null]
     */
    private function generateBarcodeQr(string $code): array
    {
        $barcodeData = null;
        $qrData = null;

        if (empty($code)) {
            return [$barcodeData, $qrData];
        }

        // Generate 1D barcode via milon/barcode if available
        if (class_exists('\Milon\Barcode\DNS1D')) {
            try {
                $d = new \Milon\Barcode\DNS1D();
                $png = $d->getBarcodePNG($code, 'C128');
                // getBarcodePNG returns base64 string already
                $barcodeData = 'data:image/png;base64,' . $png;
            } catch (\Exception $e) {
                $barcodeData = null;
            }
        }

        // Generate QR code via simple-qrcode if available
        if (class_exists('\\SimpleSoftwareIO\\QrCode\\Facades\\QrCode') || class_exists('\\SimpleSoftwareIO\\QrCode\\QrCode')) {
            try {
                if (class_exists('\\SimpleSoftwareIO\\QrCode\\Facades\\QrCode')) {
                    $png = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(200)->generate($code);
                } else {
                    // fallback to instantiating generator class
                    $generator = app()->make(\SimpleSoftwareIO\QrCode\QrCode::class);
                    $png = $generator->format('png')->size(200)->generate($code);
                }

                if (!empty($png)) {
                    $qrData = 'data:image/png;base64,' . base64_encode($png);
                }
            } catch (\Exception $e) {
                $qrData = null;
            }
        }

        // Fallback: use Google Chart API and embed as data URI
        if (empty($qrData)) {
            try {
                $qrUrl = 'https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=' . urlencode($code);
                $img = @file_get_contents($qrUrl);
                if ($img !== false) {
                    $qrData = 'data:image/png;base64,' . base64_encode($img);
                }
            } catch (\Exception $e) {
                $qrData = null;
            }
        }

        return [$barcodeData, $qrData];
    }
}
