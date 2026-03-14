<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $penjualan = Penjualan::when($search, function ($query, $search) {
                $query->where('kode', 'like', "%{$search}%")
                      ->orWhere('produk', 'like', "%{$search}%")
                      ->orWhere('pelanggan', 'like', "%{$search}%");
            })
            ->orderBy('tanggal', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.penjualan.index', compact('penjualan', 'search'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required|date',
            'produk'    => 'required|string',
            'jumlah'    => 'required|integer|min:1',
            'harga'     => 'required|numeric|min:0',
            'pelanggan' => 'nullable|string',
            'metode'    => 'required|string',
            'status'    => 'required|string',
        ]);

        DB::transaction(function () use ($request) {

            Penjualan::create([
                'tanggal'            => Carbon::parse($request->tanggal)->timezone('Asia/Jakarta'),
                'kode'               => 'TRX-' . strtoupper(Str::random(8)),
                'produk'             => $request->produk,
                'jumlah'             => $request->jumlah,
                'harga'              => $request->harga,
                'total'              => $request->jumlah * $request->harga,
                'pelanggan'          => $request->pelanggan,
                'metode_pembayaran'  => $request->metode,
                'status'             => $request->status,
            ]);

            $this->triggerRetrain();
        });

        return redirect()
            ->route('admin.penjualan.index')
            ->with('success', 'Data penjualan berhasil disimpan & model diperbarui');
    }
    public function edit($id)
{
    $penjualan = Penjualan::findOrFail($id);

    return view('admin.penjualan.edit', compact('penjualan'));
}
    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'produk'  => 'required',
            'jumlah'  => 'required|integer|min:1',
            'harga'   => 'required|numeric|min:0',
            'status'  => 'required',
        ]);

        DB::transaction(function () use ($request, $penjualan) {

            $penjualan->update([
                'tanggal'   => Carbon::parse($request->tanggal)->timezone('Asia/Jakarta'),
                'produk'    => $request->produk,
                'jumlah'    => $request->jumlah,
                'harga'     => $request->harga,
                'total'     => $request->jumlah * $request->harga,
                'pelanggan' => $request->pelanggan,
                'status'    => $request->status,
            ]);

            $this->triggerRetrain();
        });

        return redirect()
            ->route('admin.penjualan.index')
            ->with('success', 'Data berhasil diperbarui & model diperbarui');
    }
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        $this->triggerRetrain();

        return redirect()
            ->route('admin.penjualan.index')
            ->with('success', 'Data berhasil dihapus & model diperbarui');
    }
    public function bulkDelete(Request $request)
{
    $ids = $request->ids;

    if (!$ids) {
        return back()->with('warning', 'Tidak ada data dipilih');
    }

    Penjualan::whereIn('id', $ids)->delete();

    $this->triggerRetrain();

    return back()->with('success', 'Data terpilih berhasil dihapus');
}

    private function triggerRetrain()
    {
        try {
            Http::timeout(5)->post('http://ml-service:5000/retrain');
        } catch (\Exception $e) {
            logger()->warning('Gagal retrain ML: ' . $e->getMessage());
        }
    }
}
