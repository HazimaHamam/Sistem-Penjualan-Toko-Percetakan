<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Carbon\Carbon;

class PrediksiController extends Controller
{
    /**
     * Halaman Form Prediksi
     */
    public function index()
    {
        $produk = Penjualan::distinct()->pluck('produk');

        $akurasiReal = null;
        $lastTrained = null;

        try {
            /** @var Response $response */
            $response = Http::timeout(5)
                ->get('http://ml-service:5000/model-info');

            if ($response->successful()) {
                $akurasiReal = $response->json('akurasi');
                $lastTrained = $response->json('last_trained_at');
            }
        } catch (\Exception $e) {
            // ML tidak aktif → biarkan null
        }

        return view('admin.prediksi.index', compact(
            'produk',
            'akurasiReal',
            'lastTrained'
        ));
    }

    /**
     * Proses Prediksi + Auto Retrain
     */
    public function proses(Request $request)
    {
        $request->validate([
            'produk' => 'required',
            'bulan'  => 'required|date',
            'metode' => 'required'
        ]);

        $hasil = 0;

        // =========================
        // AUTO RETRAIN MODEL
        // =========================
        try {
            /** @var Response $response */
            $response = Http::timeout(10)
                ->post('http://ml-service:5000/retrain');

            if (!$response->successful()) {
                return back()->with('warning', 'Gagal retrain model ML.');
            }
        } catch (\Exception $e) {
            return back()->with('warning', 'ML Service tidak aktif.');
        }

        // =========================
        // DATA HISTORIS BULANAN
        // =========================
        $target = Carbon::parse($request->bulan);

        $data = Penjualan::where('produk', $request->produk)
            ->where('status', 'Selesai')
            ->where('tanggal', '<', $target->startOfMonth()) // BATASI DI SINI
            ->selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(jumlah) as total')
            ->groupByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->orderByRaw('tahun, bulan')
            ->get();

        $jumlahData = $data->count();

        if ($jumlahData < 3) {
            return back()->with('warning', 'Minimal 3 bulan data diperlukan untuk prediksi.');
        }

        $last  = $data->last();
        $prev1 = $data[$jumlahData - 2];
        $prev2 = $data[$jumlahData - 3];

        $target = Carbon::parse($request->bulan);

        // =========================
        // REQUEST KE ML SERVICE
        // =========================
        try {
            /** @var Response $response */
            $response = Http::timeout(5)->post(
                'http://ml-service:5000/predict',
                [
                    'bulan' => (int) $target->month,
                    'tahun' => (int) $target->year,
                    'lag_1' => (float) $last->total,
                    'lag_2' => (float) $prev1->total,
                    'lag_3' => (float) $prev2->total,
                ]
            );

            if ($response->successful()) {
                $hasil = $response->json('prediksi_penjualan') ?? 0;
            } else {
                return back()->with('warning', 'Gagal mendapatkan prediksi dari ML.');
            }

        } catch (\Exception $e) {
            return back()->with('warning', 'ML Service tidak merespon.');
        }

        // =========================
        // STATUS & PERSENTASE
        // =========================
        if ($hasil > $last->total) {
            $status = 'Naik';
        } elseif ($hasil < $last->total) {
            $status = 'Turun';
        } else {
            $status = 'Stabil';
        }

        $persentase = 0;
        if ($last->total > 0) {
            $persentase = round(
                (($hasil - $last->total) / $last->total) * 100,
                2
            );
        }

        // =========================
        // DATA GRAFIK
        // =========================
        $labels = $data->map(function ($item) {
            return $item->bulan . '-' . $item->tahun;
        })->toArray();

        $values = $data->pluck('total')->toArray();

        $labels[] = 'Prediksi';
        $values[] = $hasil;

        // =========================
        // AKURASI GLOBAL MODEL
        // =========================
        $akurasiReal = null;
        $lastTrained = null;

        try {
            /** @var Response $akurasiResponse */
            $akurasiResponse = Http::timeout(5)
                ->get('http://ml-service:5000/model-info');

            if ($akurasiResponse->successful()) {
                $akurasiReal = $akurasiResponse->json('akurasi');
                $lastTrained = $akurasiResponse->json('last_trained_at');
            }
        } catch (\Exception $e) {
            // biarkan null
        }

        return view('prediksi.index', [
            'produk'        => Penjualan::distinct()->pluck('produk'),
            'hasil'         => $hasil,
            'status'        => $status,
            'persentase'    => $persentase,
            'labels'        => $labels,
            'values'        => $values,
            'akurasiReal'   => $akurasiReal,
            'lastPenjualan' => $last->total,
            'jumlahData'    => $jumlahData,
            'lastTrained'   => $lastTrained
        ]);
    }
}
