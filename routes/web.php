<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PackingListController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\InboundPackageLabelController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\VehicleController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Pengiriman Routes
Route::resource('pengiriman', ShipmentController::class);

// Delivery Orders Routes
Route::resource('delivery-orders', DeliveryOrderController::class);
Route::post('pengiriman/{shipment}/generate-delivery-order', [DeliveryOrderController::class, 'generate'])->name('delivery-orders.generate');
Route::get('delivery-orders/{deliveryOrder}/print-pdf', [DeliveryOrderController::class, 'printPdf'])->name('delivery-orders.print-pdf');

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

// Invoice Routes
Route::get('invoices/{invoice}/print-pdf', [InvoiceController::class, 'printPdf'])->name('invoices.print-pdf');
Route::resource('invoices', InvoiceController::class);
