<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // ── Satu query, semua data diambil sekaligus ──
        $orders = Order::where('user_id', $userId)->get();

        $totalOrders      = $orders->count();
        $processingOrders = $orders->where('status', 'processing')->count();
        $completedOrders  = $orders->where('status', 'completed')->count();
        $pendingOrders    = $orders->where('status', 'pending')->count();
        $totalSpending    = $orders->whereIn('status', ['processing', 'completed'])
                                   ->sum('total_price');

        $recentOrders = $orders->sortByDesc('created_at')->take(5);

        // ── Chart: 30 hari berurutan (isi 0 jika tidak ada pesanan) ──
        $last30Days = collect();
        for ($i = 29; $i >= 0; $i--) {
            $last30Days->put(
                Carbon::now()->subDays($i)->format('d M'),
                0
            );
        }

        $ordersByDate = $orders
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy(fn($order) => $order->created_at->format('d M'))
            ->map(fn($group) => $group->count());

        // Merge: semua 30 hari tetap ada, hari dengan pesanan diisi jumlahnya
        $chartData   = $last30Days->merge($ordersByDate)->values()->toArray();
        $chartLabels = $last30Days->keys()->toArray();

        return view('frontend.dashboard.pages.index', compact(
            'totalOrders',
            'processingOrders',
            'completedOrders',
            'pendingOrders',
            'totalSpending',
            'recentOrders',
            'chartLabels',
            'chartData'
        ));
    }
}