<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Nanti akan mengambil data dari database
        // Untuk saat ini hanya menampilkan view
        return view('invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Nanti akan mengambil data spesifik dari database
        // Untuk saat ini hanya menampilkan view
        return view('invoices.show');
    }

    /**
     * Display a packing list related to an invoice.
     */
    public function packingList(string $id)
    {
        $invoiceNumber = strtoupper($id ?: 'INV-2026-0001');
        $packingItems = [
            ['description' => 'Kursi Lipat Plastik', 'qty' => 10, 'koli' => 2, 'unit_price' => 75000],
            ['description' => 'Meja Kayu Portable', 'qty' => 5, 'koli' => 3, 'unit_price' => 120000],
            ['description' => 'Pallet Kayu', 'qty' => 2, 'koli' => 1, 'unit_price' => 350000],
        ];

        $summary = [
            'total_items' => collect($packingItems)->sum('qty'),
            'total_koli' => collect($packingItems)->sum('koli'),
            'grand_total' => collect($packingItems)->reduce(function ($carry, $item) {
                return $carry + ($item['qty'] * $item['unit_price']);
            }, 0),
        ];

        return view('packing-list.show', compact('invoiceNumber', 'packingItems', 'summary'));
    }

    public function packingListHistory()
    {
        return view('packing-list.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Export invoice to PDF
     */
    public function exportPDF(string $id)
    {
        // Implementasi export PDF menggunakan DomPDF
        // Nanti akan ditambahkan
    }

    /**
     * Print invoice
     */
    public function print(string $id)
    {
        // Redirect ke show dengan print mode
        return redirect()->route('invoices.show', $id);
    }
}
