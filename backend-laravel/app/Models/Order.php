<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'hp',
        'total',
        'status'
    ];


    protected $casts = [
        'total' => 'integer'
    ];


    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getTotalFormatAttribute()
    {
        return 'Rp ' . number_format($this->total,0,',','.');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}