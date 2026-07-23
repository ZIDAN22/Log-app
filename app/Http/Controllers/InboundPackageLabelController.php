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
            ->setPaper('a4', 'portrait');

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
                $barcodeData = 'data:image/png;base64,' . $png;
            } catch (\Exception $e) {
                $barcodeData = null;
            }
        }

        // Generate QR code using simple-qrcode with a safe fallback.
        // PNG generation may fail on servers without Imagick, so SVG is used first.
        if (class_exists('\SimpleSoftwareIO\QrCode\Generator')) {
            $generator = null;

            try {
                $generator = app()->make(\SimpleSoftwareIO\QrCode\Generator::class);

                $svg = $generator->format('svg')->size(200)->generate($code);
                $svgPayload = (string) $svg;

                if (!empty($svgPayload)) {
                    $qrData = 'data:image/svg+xml;base64,' . base64_encode($svgPayload);
                }
            } catch (\Throwable $e) {
                $qrData = null;
            }

            if (empty($qrData) && $generator !== null) {
                try {
                    $png = $generator->format('png')->size(200)->generate($code);
                    $pngPayload = (string) $png;

                    if (!empty($pngPayload)) {
                        $qrData = 'data:image/png;base64,' . base64_encode($pngPayload);
                    }
                } catch (\Throwable $e) {
                    $qrData = null;
                }
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
            } catch (\Throwable $e) {
                $qrData = null;
            }
        }

        return [$barcodeData, $qrData];
    }
}
