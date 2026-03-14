@extends('frontend.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold mb-6">Pesanan Saya</h1>

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-sm text-slate-600">
                <tr>
                    <th class="p-4">Kode</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-t">
                    <td class="p-4 font-medium">{{ $order->kode }}</td>
                    <td>Rp {{ number_format($order->total) }}</td>
                    <td>
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="text-blue-600 hover:underline">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-slate-500">
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection