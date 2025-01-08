<?php

namespace App\Http\Controllers;

use App\Models\sepatu;
use Illuminate\Http\Request;

class SepatuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data sepatu dari database
        $sepatu = Sepatu::all();

        // Mengirimkan data sepatu ke view
        return view('sepatu.index', compact('sepatu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('sepatu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi input, memastikan 'sepatu' dan jumlahnya ada dalam request
        $validated = $request->validate([
            'nama.*' => 'required|string|max:255',
            'harga.*' => 'required|integer',
            'stok.*' => 'required|integer',
        ]);

         // Menyimpan sepatu baru
         Sepatu::create([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga
         ]);

            // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(sepatu $sepatu)
    {
        return view(view: 'sepatu.show', data: compact(var_name: 'sepatu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sepatu $sepatu)
    {
         // Mengambil data sepatu berdasarkan ID
         $sepatu = Sepatu::findOrFail($id);

         // Menampilkan form edit dengan data sepatu
         return view('sepatu.edit', compact('sepatu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sepatu $sepatu)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:1000',
        ]);

        // Mencari sepatu berdasarkan ID
        $sepatu = Sepatu::findOrFail($id);

        // Mengupdate data sepatu
        $sepatu->update([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sepatu $sepatu)
    {
        // Mencari sepatu berdasarkan ID
        $sepatu = Sepatu::findOrFail($id);

        // Menghapus sepatu dari database
        $sepatu->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil dihapus!');
    }
}
