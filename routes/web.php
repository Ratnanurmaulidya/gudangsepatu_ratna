<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('sepatu/print/{id}', [SepatuController::class, 'print'])->name('sepatu.print');
Route::resource('sepatu', SepatuController::class);
Route::resource('transaksi',TransaksiController::class);
Route::get('transaksi}', [TransaksiController::class, 'print'])->name('transaksi.print');
