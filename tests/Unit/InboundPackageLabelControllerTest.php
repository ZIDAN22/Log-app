<?php

namespace Tests\Unit;

use App\Http\Controllers\InboundPackageLabelController;
use PHPUnit\Framework\TestCase;

class InboundPackageLabelControllerTest extends TestCase
{
    public function test_it_can_generate_svg_qr_data_when_png_generation_is_unavailable(): void
    {
        $controller = new InboundPackageLabelController();
        $method = new \ReflectionMethod($controller, 'generateBarcodeQr');
        $method->setAccessible(true);

        [$barcodeData, $qrData] = $method->invoke($controller, 'TEST-CODE-001');

        $this->assertNull($barcodeData);
        $this->assertNotNull($qrData);
        $this->assertStringStartsWith('data:image/svg+xml;base64,', $qrData);
    }
}
