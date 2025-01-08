<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua transaksi yang terkait dengan user yang login
        $transaksis = Transaksi::where('user_id', auth()->id())->get();

        // Menampilkan halaman dengan daftar transaksi
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua sepatu yang tersedia di gudang
        $sepatus = Sepatu::all();

        // Menampilkan form pembelian sepatu
        return view('transaksi.create', compact('sepatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input untuk memastikan data yang dikirim valid
        $validated = $request->validate([
            'sepatu.*' => 'required|integer|min:1',  // Validasi jumlah sepatu yang dibeli
        ]);

        // Membuat transaksi baru untuk user yang sedang login
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),  // Ambil ID user yang sedang login
            'tanggal_transaksi' => now(),  // Waktu transaksi saat ini
            'total' => 0  // Total transaksi, diupdate setelah nota transaksi dibuat
        ]);

        // Variabel untuk menyimpan total harga transaksi
        $total = 0;

        // Proses pembelian untuk setiap sepatu yang dibeli
        foreach ($request->sepatu as $sepatu_id => $jumlah) {
            // Ambil data sepatu berdasarkan ID
            $sepatu = Sepatu::find($sepatu_id);

            // Pastikan stok sepatu cukup untuk transaksi
            if ($sepatu && $sepatu->stok >= $jumlah) {
                // Hitung subtotal untuk sepatu ini
                $subtotal = $sepatu->harga * $jumlah;

                // Simpan data nota transaksi untuk sepatu ini
                NotaTransaksi::create([
                    'transaksi_id' => $transaksi->id,  // Menghubungkan nota dengan transaksi
                    'sepatu_id' => $sepatu_id,         // Menghubungkan nota dengan sepatu yang dibeli
                    'jumlah' => $jumlah,               // Jumlah sepatu yang dibeli
                    'subtotal' => $subtotal,           // Subtotal harga sepatu
                ]);

                // Tambahkan subtotal ke total transaksi
                $total += $subtotal;

                // Kurangi stok sepatu yang terjual
                $sepatu->stok -= $jumlah;
                $sepatu->save(); // Simpan perubahan stok
            } else {
                // Jika stok tidak cukup, kembalikan dengan error
                return back()->withErrors(['error' => 'Stok sepatu tidak mencukupi untuk transaksi ini.']);
            }
        }

        // Update total transaksi setelah semua nota ditambahkan
        $transaksi->update(['total' => $total]);

        // Redirect ke halaman transaksi dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi $transaksi)
    {
        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Pastikan transaksi milik user yang sedang login
        if ($transaksi->user_id != auth()->id()) {
            abort(403);  // Unauthorized access
        }

        // Ambil semua nota transaksi yang terkait dengan transaksi ini
        $nota_transaksis = $transaksi->notaTransaksis;

        // Menampilkan halaman detail transaksi
        return view('transaksi.show', compact('transaksi', 'nota_transaksis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi $transaksi)
    {
        $this->authorize('delete', $transaksi);

        // Kembalikan stok sepatu
        foreach ($transaksi->notaTransaksis as $nota) {
            $sepatu = $nota->sepatu;
            $sepatu->stok += $nota->jumlah;
            $sepatu->save();
        }

        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
