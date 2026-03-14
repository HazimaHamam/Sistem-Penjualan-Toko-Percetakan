<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Response;

class DashboardController extends Controller
{
    /**
     * Halaman Dashboard
     */
    public function index()
    {
        // ======================
        // DATA STATISTIK
        // ======================
        $totalTransaksi   = Penjualan::count();
        $totalPendapatan  = Penjualan::where('status', 'Selesai')->sum('total');

        $pendapatanHariIni = Penjualan::whereBetween('tanggal', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->where('status', 'Selesai')
            ->sum('total');

        $produkTerjual  = Penjualan::where('status', 'Selesai')->sum('jumlah');
        $pelangganAktif = Penjualan::where('status', 'Selesai')
                            ->distinct('pelanggan')
                            ->count('pelanggan');

        // ======================
        // CEK STATUS MODEL ML
        // ======================
        $modelUpdated = false;
        $lastTrained  = null;

        try {
            /** @var Response $response */
            $response = Http::timeout(3)->get('http://ml-service:5000/model-info');

            if ($response->successful()) {
                $lastTrained = $response->json('last_trained_at');

                if ($lastTrained) {
                    $diff = Carbon::parse($lastTrained)->diffInSeconds(now());
                    $modelUpdated = $diff <= 60;
                }
            }
        } catch (\Exception $e) {
            // Jika ML mati, dashboard tetap jalan
        }

        // ======================
        // PREDIKSI BULAN DEPAN
        // ======================
        $prediksiBulanIni = null;

        $dataBulanan = Penjualan::select(
                DB::raw('YEAR(tanggal) as tahun'),
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as penjualan')
            )
            ->where('status', 'Selesai')
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->orderByRaw('tahun, bulan')
            ->get();

        if ($dataBulanan->count() >= 3) {

            $last  = $dataBulanan->last();
            $prev1 = $dataBulanan[$dataBulanan->count() - 2];
            $prev2 = $dataBulanan[$dataBulanan->count() - 3];

            $bulanPrediksi = $last->bulan + 1;
            $tahunPrediksi = $last->tahun;

            if ($bulanPrediksi > 12) {
                $bulanPrediksi = 1;
                $tahunPrediksi += 1;
            }

            try {
                /** @var Response $response */
                $response = Http::timeout(5)->post(
                    'http://ml-service:5000/predict',
                    [
                        'bulan' => (int) $bulanPrediksi,
                        'tahun' => (int) $tahunPrediksi,
                        'lag_1' => (float) $last->penjualan,
                        'lag_2' => (float) $prev1->penjualan,
                        'lag_3' => (float) $prev2->penjualan,
                    ]
                );

                if ($response->successful()) {
                    $prediksiBulanIni = $response->json('prediksi_penjualan');
                }

            } catch (\Exception $e) {
                $prediksiBulanIni = null;
            }
        }

        // ======================
        // RETURN VIEW
        // ======================
        return view('admin.dashboard.index', compact(
            'totalTransaksi',
            'totalPendapatan',
            'pendapatanHariIni',
            'produkTerjual',
            'pelangganAktif',
            'prediksiBulanIni',
            'modelUpdated',
            'lastTrained'
        ));
    }

    
    /**
     * Halaman Settings
     */
    public function settings()
    {
        return view('admin.settings.index');
    }
}
