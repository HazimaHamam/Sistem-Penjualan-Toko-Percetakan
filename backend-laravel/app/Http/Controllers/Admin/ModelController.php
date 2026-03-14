<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Prediction;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ModelController extends Controller
{
    public function index()
{
    /**
     * =========================================
     * DEFAULT (FALLBACK)
     * =========================================
     */
    $model         = $this->fallbackModel('ML Service Offline');
    $akurasiProduk = [];
    $grafikData    = [];

    try {
        /**
         * =========================================
         * 1. AMBIL DATA PENJUALAN REAL
         * =========================================
         */
        $penjualan = Penjualan::select('produk', 'tanggal', 'jumlah')
            ->where('status', 'Selesai')
            ->orderBy('produk')
            ->orderBy('tanggal')
            ->get();

        /**
         * =========================================
         * 2. BENTUK PAYLOAD KE ML SERVICE
         * =========================================
         */
        $payload = [];

        foreach ($penjualan as $item) {
            $payload[] = [
                'produk'    => $item->produk,
                'bulan'     => (int) date('n', strtotime($item->tanggal)),
                'penjualan' => (float) $item->jumlah,
            ];
        }

        /**
         * =========================================
         * 3. REQUEST AKURASI PER PRODUK
         * =========================================
         */
        if (!empty($payload)) {

            /** @var Response $accuracyResponse */
            $accuracyResponse = Http::timeout(10)
                ->acceptJson()
                ->post('http://ml:5000/model-accuracy', [
                    'data' => $payload
                ]);

            if ($accuracyResponse->ok()) {
                $akurasiProduk = $accuracyResponse->json('akurasi_per_produk') ?? [];
            }

            /**
             * =========================================
             * 4. REQUEST DATA GRAFIK ACTUAL vs PREDICTION
             * =========================================
             */
            /** @var Response $grafikResponse */
            $grafikResponse = Http::timeout(10)
                ->acceptJson()
                ->post('http://ml:5000/actual-vs-prediction', [
                    'data' => $payload
                ]);

            if ($grafikResponse->ok()) {
                $grafikData = $grafikResponse->json('data') ?? [];
            }
        }

        /**
         * =========================================
         * 5. INFO MODEL + AKURASI GLOBAL
         * =========================================
         */
        /** @var Response $modelResponse */
        $modelResponse = Http::timeout(5)
            ->acceptJson()
            ->get('http://ml:5000/model-info');

        if ($modelResponse->ok()) {
            $data = $modelResponse->json();

            $model = [
                'nama'    => $data['model']   ?? 'Random Forest Regressor',
                'versi'   => $data['versi']   ?? 'v1.0',
                'fitur'   => $data['fitur']   ?? ['bulan', 'lag_1', 'lag_2'],
                'akurasi' => $data['akurasi'] ?? 0,
                'status'  => $data['status']  ?? 'Aktif',
                'updated' => now()->format('d M Y H:i'),
            ];
        }

    } catch (\Throwable $e) {
        // ML mati / error → fallback aktif
    }

    return view('admin.model.index', compact(
        'model',
        'akurasiProduk',
        'grafikData'
    ));
}

    /**
     * =========================================
     * FALLBACK DATA MODEL
     * =========================================
     */
    private function fallbackModel(string $status): array
    {
        return [
            'nama'    => 'Random Forest Regressor',
            'versi'   => 'v1.0',
            'fitur'   => ['bulan', 'lag_1', 'lag_2'],
            'akurasi' => 0,
            'status'  => $status,
            'updated' => now()->format('d M Y H:i'),
        ];
    }

    /**
     * =========================================
     * OPSIONAL: AKURASI LANGSUNG DARI DB
     * (Dipakai jika ML Service OFF)
     * =========================================
     */
    private function hitungAkurasiPerProduk(): array
    {
        $produkList = Penjualan::where('status', 'Selesai')
            ->select('produk')
            ->distinct()
            ->pluck('produk');

        $hasil = [];

        foreach ($produkList as $produk) {

            $actuals = Penjualan::where('produk', $produk)
                ->where('status', 'Selesai')
                ->orderBy('tanggal')
                ->pluck('jumlah')
                ->toArray();

            $predictions = Prediction::where('produk', $produk)
                ->orderBy('tanggal')
                ->pluck('prediksi')
                ->toArray();

            $n = min(count($actuals), count($predictions));
            if ($n === 0) continue;

            $mape = 0;

            for ($i = 0; $i < $n; $i++) {
                if ($actuals[$i] == 0) continue;
                $mape += abs($actuals[$i] - $predictions[$i]) / $actuals[$i];
            }

            $mape = ($mape / $n) * 100;

            $hasil[] = [
                'produk'  => $produk,
                'akurasi' => round(100 - $mape, 2),
            ];
        }
        return $hasil;
    }
}
