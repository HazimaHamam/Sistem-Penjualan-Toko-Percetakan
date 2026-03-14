<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'produk_id',
        'nama',
        'harga',
        'qty',
        'total'
    ];


    protected $casts = [
        'harga' => 'integer',
        'total' => 'integer',
        'qty' => 'integer'
    ];


    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }


    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga,0,',','.');
    }


    public function getTotalFormatAttribute()
    {
        return 'Rp ' . number_format($this->total,0,',','.');
    }

}