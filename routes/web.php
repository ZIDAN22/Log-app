<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PackingListController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\InboundPackageLabelController;

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

// Package Label (Inbound)
Route::get('inbound/{inbound}/package-label', [InboundPackageLabelController::class, 'show'])->name('inbound.package-label.show');
Route::get('inbound/{inbound}/package-label/preview', [InboundPackageLabelController::class, 'preview'])->name('inbound.package-label.preview');
Route::get('inbound/{inbound}/package-label/pdf', [InboundPackageLabelController::class, 'pdf'])->name('inbound.package-label.pdf');
// Outbound Routes (View routes for now, will be replaced with controller routes later)
Route::view('warehouse/outbound', 'warehouse.outbound.index')->name('warehouse.outbound.index');
Route::view('warehouse/outbound/create', 'warehouse.outbound.create')->name('warehouse.outbound.create');
Route::view('warehouse/outbound/{id}/edit', 'warehouse.outbound.edit')->name('warehouse.outbound.edit');
Route::view('warehouse/outbound/{id}/delete', 'warehouse.outbound.delete')->name('warehouse.outbound.delete');
Route::view('warehouse/history', 'warehouse.history')->name('warehouse.history');


// Packing List Routes
Route::get('packing-list/{packing_list}/print-pdf', [PackingListController::class, 'printPdf'])->name('packing-list.print-pdf');
Route::resource('packing-list', PackingListController::class)->only(['index', 'show']);

// Invoice Routes
Route::get('invoices/{invoice}/print-pdf', [InvoiceController::class, 'printPdf'])->name('invoices.print-pdf');
Route::resource('invoices', InvoiceController::class);
