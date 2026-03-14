@extends('frontend.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold mb-6">
        Detail Pesanan {{ $order->kode }}
    </h1>

    <div class="bg-white rounded-2xl shadow p-6">

        <div class="mb-6">
            <p><strong>Nama:</strong> {{ $order->nama }}</p>
            <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
            <p><strong>HP:</strong> {{ $order->hp }}</p>
        </div>

        <table class="w-full text-left">
            <thead class="bg-slate-50 text-sm text-slate-600">
                <tr>
                    <th class="p-3">Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->nama }}</td>
                    <td>Rp {{ number_format($item->harga) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-6 text-lg font-bold">
            Total: Rp {{ number_format($order->total) }}
        </div>

    </div>

</div>
@endsection