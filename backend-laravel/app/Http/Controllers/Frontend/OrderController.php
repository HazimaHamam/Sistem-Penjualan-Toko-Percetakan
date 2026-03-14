<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;

// WAJIB TAMBAHKAN INI
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::latest()->get();

    return view('frontend.orders.index', compact('orders'));
}

public function show(Order $order)
{
    $order->load('items');

    return view('frontend.orders.show', compact('order'));
}

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'hp' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if(empty($cart))
        {
            return redirect('/produk');
        }


        DB::beginTransaction();

        try {

            $order = Order::create([
                'kode' => 'ORD'.time(),
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'total' => collect($cart)
                    ->sum(fn($item) =>
                        $item['harga'] * $item['qty']
                    ),
                'status' => 'pending'
            ]);


            foreach($cart as $item)
            {
                OrderItem::create([
                    'order_id' => $order->id,
                    'produk_id' => $item['id'],
                    'nama' => $item['nama'],
                    'harga' => $item['harga'],
                    'qty' => $item['qty'],
                    'total' => $item['harga'] * $item['qty']
                ]);
            }


            DB::commit();

            session()->forget('cart');

            return redirect('/')
                ->with('success','Pesanan berhasil dibuat');


        }
        catch(\Exception $e)
        {
            DB::rollBack();

            return back()
                ->with('error',$e->getMessage());
        }

    }

}