<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Sepatu;
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
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jenis_transaksi' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jumlah_stok' => 'required|integer',
            'keterangan' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Buat transaksi baru
    $transaksi = Transaksi::create($request->all());

    // Update jumlah stok berdasarkan jenis transaksi
    $sepatu = Sepatu::where('nama', $request->nama)->first();
    if ($sepatu) {
        if ($request->jenis_transaksi == 'Masuk') {
            $sepatu->stok += $request->jumlah_stok;
        } elseif ($request->jenis_transaksi == 'Keluar') {
            if ($sepatu->stok >= $request->jumlah_stok) {
                $sepatu->stok -= $request->jumlah_stok;
            } else {
                return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi untuk transaksi keluar.']);
            }
        }
        $sepatu->save();
    } else {
        return redirect()->back()->withErrors(['error' => 'Barang tidak ditemukan.']);
    }

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        \Log::info('Data transaksi:', $transaksi->toArray());
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jenis_transaksi' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jumlah_stok' => 'required|integer',
            'keterangan' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        \Log::info($transaksi);
        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
