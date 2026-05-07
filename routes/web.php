<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Pengiriman Routes
Route::resource('pengiriman', ShipmentController::class);

// Warehouse Routes
Route::view('warehouse', 'warehouse.index')->name('warehouse.index');
// Inbound Routes (View routes for now, will be replaced with controller routes later)
Route::view('warehouse/inbound', 'warehouse.inbound.index')->name('warehouse.inbound.index');
Route::view('warehouse/inbound/create', 'warehouse.inbound.create')->name('warehouse.inbound.create');
Route::view('warehouse/inbound/{id}/edit', 'warehouse.inbound.edit')->name('warehouse.inbound.edit');
Route::view('warehouse/inbound/{id}/delete', 'warehouse.inbound.delete')->name('warehouse.inbound.delete');
// Outbound Routes (View routes for now, will be replaced with controller routes later)
Route::view('warehouse/outbound', 'warehouse.outbound.index')->name('warehouse.outbound.index');
Route::view('warehouse/outbound/create', 'warehouse.outbound.create')->name('warehouse.outbound.create');
Route::view('warehouse/outbound/{id}/edit', 'warehouse.outbound.edit')->name('warehouse.outbound.edit');
Route::view('warehouse/outbound/{id}/delete', 'warehouse.outbound.delete')->name('warehouse.outbound.delete');
Route::view('warehouse/history', 'warehouse.history')->name('warehouse.history');


// Invoice Routes
Route::get('packing-list', [InvoiceController::class, 'packingListHistory'])->name('packing-list.index');
Route::get('invoices/{invoice}/packing-list', [InvoiceController::class, 'packingList'])->name('invoices.packing-list');
Route::resource('invoices', InvoiceController::class);
