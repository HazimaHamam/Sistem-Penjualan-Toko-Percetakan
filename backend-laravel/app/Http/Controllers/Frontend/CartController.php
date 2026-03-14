<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);

        return view('frontend.cart.index', [
            'title' => 'Keranjang',
            'cart' => $cart
        ]);
    }


    public function add(Request $request)
    {
        $produk = Produk::findOrFail($request->id);

        $cart = session()->get('cart', []);

        if(isset($cart[$produk->id]))
        {
            $cart[$produk->id]['qty'] += $request->qty;
        }
        else
        {
            $cart[$produk->id] = [
                'id' => $produk->id,
                'nama' => $produk->nama,
                'harga' => $produk->harga,
                'qty' => $request->qty,
                'gambar' => $produk->gambar
            ];
        }

        session()->put('cart', $cart);

        return redirect('/cart')
        ->with('success','Produk ditambahkan ke keranjang');
    }


    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return back();
    }


    public function clear()
    {
        session()->forget('cart');

        return back();
    }

}