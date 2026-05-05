<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all pengiriman records
        // $pengiriman = Pengiriman::paginate(10);
        // return view('pengiriman.index', compact('pengiriman'));
        
        return view('pengiriman.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengiriman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'no_invoice' => 'required|string|unique:pengiriman',
            'no_resi' => 'required|string|unique:pengiriman',
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'tujuan' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'berat' => 'required|numeric|min:0',
            'harga_per_kg' => 'required|numeric|min:0',
            'transportasi' => 'required|in:darat,laut,udara',
            'total_amount' => 'required|numeric|min:0',
            // Transportation specific fields
            'ekspedisi' => 'nullable|string|max:255',
            'estimasi_hari' => 'nullable|integer|min:1',
            'nama_kapal' => 'nullable|string|max:255',
            'jadwal_kapal' => 'nullable|datetime',
            'maskapai' => 'nullable|string|max:255',
            'nomor_flight' => 'nullable|string|max:255',
        ]);

        // Save to database
        // Pengiriman::create($validated);
        
        // Redirect with success message
        return redirect()->route('pengiriman.index')
                       ->with('success', 'Pengiriman berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $pengiriman = Pengiriman::findOrFail($id);
        // return view('pengiriman.show', compact('pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $pengiriman = Pengiriman::findOrFail($id);
        // return view('pengiriman.edit', compact('pengiriman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate and update
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $pengiriman = Pengiriman::findOrFail($id);
        // $pengiriman->delete();
        
        // return redirect()->route('pengiriman.index')
        //                ->with('success', 'Pengiriman berhasil dihapus');
    }
}
