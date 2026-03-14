<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::query()->where('is_active', true);

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // 📊 Sorting
        switch ($request->sort) {
            case 'harga_asc':
                $query->orderBy('harga', 'asc');
                break;

            case 'harga_desc':
                $query->orderBy('harga', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        $produk = $query->paginate(12)->withQueryString();

        return view('frontend.produk.index', [
            'title'  => 'Produk',
            'produk' => $produk
        ]);
    }


    public function show(Produk $produk)
    {
        // 🔥 Related Produk (simple logic)
        $related = Produk::where('id', '!=', $produk->id)
            ->where('is_active', true)
            ->latest()
            ->limit(4)
            ->get();

        return view('frontend.produk.show', [
            'produk'  => $produk,
            'related' => $related
        ]);
    }
}