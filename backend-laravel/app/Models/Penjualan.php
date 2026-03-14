<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'kode',
        'tanggal',
        'produk',
        'jumlah',
        'harga',
        'total',
        'pelanggan',
        'metode_pembayaran',
        'status',
    ];
}
