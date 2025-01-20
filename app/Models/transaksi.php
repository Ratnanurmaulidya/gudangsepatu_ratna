<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_transaksi',
        'jenis_transaksi',
        'nama',
        'jumlah_stok',
        'keterangan'
    ];
        protected $primaryKey = 'id'; // Sesuaikan jika berbeda
}
