<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda.
     */
    public function index()
    {
        // Kirim data ke view, jika diperlukan
        $title = "Selamat Datang di Gudang Sepatu";

        // Tampilkan view untuk halaman beranda
        return view('home', compact('title'));
    }
}
