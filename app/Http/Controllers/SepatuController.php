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
            'stok.*' => 'required|integer',
        ]);

         // Menyimpan sepatu baru
         Sepatu::create([
            'nama' => $request->nama,
            'stok' => $request->stok,
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
    public function edit($id)
    {
        // Temukan data sepatu berdasarkan ID
        $sepatu = Sepatu::findOrFail($id);

        // Kirim data ke view
        return view('sepatu.edit', compact('sepatu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
        ]);

        // Mencari sepatu berdasarkan ID
        $sepatu = Sepatu::findOrFail($id);

        // Mengupdate data sepatu
        $sepatu->update([
            'nama' => $request->nama,
            'stok' => $request->stok,
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request, $id)
    {
        // Mencari sepatu berdasarkan ID
        $sepatu = Sepatu::findOrFail($id);

        // Menghapus sepatu dari database
        $sepatu->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil dihapus!');
    }
    public function print($id)
    {
       // Temukan data sepatu berdasarkan ID
        $sepatu = Sepatu::findOrFail($id);

       // Misal, kembalikan ke view print khusus
       return view('sepatu.print', compact('sepatu'));
    }
}
