<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Pengiriman Routes
Route::resource('pengiriman', PengirimanController::class);

// Invoice Routes
Route::resource('invoices', InvoiceController::class);
