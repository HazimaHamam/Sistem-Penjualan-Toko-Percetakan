<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualanExport;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $query = Penjualan::query();

    // =====================
    // FILTER
    // =====================
    if ($request->filled('tanggal_mulai')) {
        $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
    }

    if ($request->filled('tanggal_akhir')) {
        $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
    }

    if ($request->filled('produk')) {
        $query->where('produk', $request->produk);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // =====================
    // DATA UTAMA
    // =====================
    $penjualan = $query->orderBy('tanggal', 'asc')->get();
    $penjualan = $query->paginate(10)->withQueryString();

    // =====================
    // RINGKASAN (BERDASARKAN FILTER)
    // =====================
    $totalTransaksi   = $penjualan->count();
    $totalPendapatan = $penjualan
    ->where('status', 'Selesai')
    ->sum('total');
    $penjualanSelesai = $penjualan->where('status', 'Selesai');
    $jumlahSelesai = $penjualanSelesai->count();
    $rataRataTransaksi = $jumlahSelesai > 0 
    ? round($penjualanSelesai->sum('total') / $jumlahSelesai, 2)
    : 0;
    $produkTerjual    = $penjualan
    ->where('status', 'Selesai')
    ->sum('jumlah');
    $pelangganAktif   = $penjualan
    ->where('status', 'Selesai')
    ->groupBy('pelanggan')->count();
    

    // =====================
    // PENDAPATAN HARI INI (GLOBAL, TIDAK TERPENGARUH FILTER)
    // =====================
    $pendapatanHariIni = Penjualan::whereBetween('tanggal', [
        Carbon::now()->startOfDay(),
        Carbon::now()->endOfDay()
    ])
    ->where('status', 'Selesai')
    ->sum('total');

    // =====================
    // DATA DROPDOWN PRODUK
    // =====================
    $produkList = Penjualan::select('produk')
        ->distinct()
        ->orderBy('produk')
        ->pluck('produk');

    return view('admin.laporan.index', compact(
        'penjualan',
        'totalTransaksi',
        'totalPendapatan',
        'produkTerjual',
        'pelangganAktif',
        'pendapatanHariIni',
        'produkList',
        'rataRataTransaksi',
    ));
}
    public function exportExcel(Request $request)
    {
        return Excel::download(
        new LaporanPenjualanExport,
        'laporan-penjualan.xlsx'
    );
    }
}
