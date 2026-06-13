<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PackingListController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\InboundPackageLabelController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\DeliveryManagementController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FinanceReportController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Pengiriman Routes
Route::get('pengiriman/manage', [ShipmentController::class, 'management'])->name('pengiriman.management');
Route::resource('pengiriman', ShipmentController::class);

// Delivery Orders Routes
Route::resource('delivery-orders', DeliveryOrderController::class);
Route::post('pengiriman/{shipment}/generate-delivery-order', [DeliveryOrderController::class, 'generate'])->name('delivery-orders.generate');
Route::get('delivery-orders/{deliveryOrder}/print-pdf', [DeliveryOrderController::class, 'printPdf'])->name('delivery-orders.print-pdf');

// Delivery Management Routes
Route::resource('delivery-management', DeliveryManagementController::class);
Route::post('delivery-management/{deliveryManagement}/status', [DeliveryManagementController::class, 'updateStatus'])->name('delivery-management.update-status');
Route::post('delivery-management/{deliveryManagement}/upload-pod', [DeliveryManagementController::class, 'uploadPOD'])->name('delivery-management.upload-pod');
Route::get('delivery-management/{deliveryManagement}/print-surat-jalan', [DeliveryManagementController::class, 'printSuratJalan'])->name('delivery-management.print-surat-jalan');
Route::get('delivery-management/{deliveryManagement}/print-pod', [DeliveryManagementController::class, 'printPOD'])->name('delivery-management.print-pod');

// Warehouse Routes
Route::view('warehouse', 'warehouse.index')->name('warehouse.index');
// Inbound Routes
Route::resource('inbound', InboundController::class);

// Driver Routes
Route::resource('drivers', DriverController::class);

// Vehicle Routes
Route::resource('vehicles', VehicleController::class);

// Package Label (Inbound)
Route::get('inbound/{inbound}/package-label', [InboundPackageLabelController::class, 'show'])->name('inbound.package-label.show');
Route::get('inbound/{inbound}/package-label/preview', [InboundPackageLabelController::class, 'preview'])->name('inbound.package-label.preview');
Route::get('inbound/{inbound}/package-label/pdf', [InboundPackageLabelController::class, 'pdf'])->name('inbound.package-label.pdf');

Route::prefix('warehouse')->name('warehouse.')->group(function () {
    Route::view('/', 'warehouse.index')->name('index');
    Route::resource('outbound', OutboundController::class);
    Route::post('outbound/{outbound}/status', [OutboundController::class, 'updateStatus'])->name('outbound.update-status');
    Route::get('outbound/{outbound}/print-pdf', [OutboundController::class, 'printPdf'])->name('outbound.print-pdf');
    Route::view('history', 'warehouse.history')->name('history');
});

// Packing List Routes
Route::get('packing-list/{packing_list}/print-pdf', [PackingListController::class, 'printPdf'])->name('packing-list.print-pdf');
Route::resource('packing-list', PackingListController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Payments Routes
|--------------------------------------------------------------------------
*/
Route::resource('payments', PaymentController::class);
Route::post('payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
Route::get('payments/{invoice}/get-invoice-data', [PaymentController::class, 'getInvoiceData'])->name('payments.get-invoice-data');

// Invoice Routes
Route::get('invoices/{invoice}/print-pdf', [InvoiceController::class, 'printPdf'])->name('invoices.print-pdf');
Route::resource('invoices', InvoiceController::class);

// Finance Report Routes
Route::get('finance/reports', [FinanceReportController::class, 'index'])->name('finance.reports.index');
Route::get('finance/reports/export-pdf', [FinanceReportController::class, 'exportPdf'])->name('finance.reports.export-pdf');

Route::resource(
    'payment-methods',
    PaymentMethodController::class
);