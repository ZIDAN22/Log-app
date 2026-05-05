<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PengirimanController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Pengiriman Routes
Route::resource('pengiriman', PengirimanController::class);
