<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nota_transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'sepatu_id',
        'jumlah',
        'subtotal'
    ];
}
