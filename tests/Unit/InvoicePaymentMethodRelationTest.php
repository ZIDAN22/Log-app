<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\PaymentMethod;
use Tests\TestCase;

class InvoicePaymentMethodRelationTest extends TestCase
{
    public function test_invoice_can_store_payment_method_reference(): void
    {
        $invoice = new Invoice();
        $invoice->setAttribute('payment_method_id', 1);
        $invoice->setAttribute('payment_method', 'Bank BCA');

        $this->assertSame(1, $invoice->payment_method_id);
        $this->assertSame('Bank BCA', $invoice->payment_method);
    }
}
