<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SepatuController;

Route::get('/', function () {
    return view('welcome');});

Route::get('sepatu/print/(id)', [SepatuController::class, 'print'])->name('sepatu.print');

Route::resource('sepatu', SepatuController::class);
