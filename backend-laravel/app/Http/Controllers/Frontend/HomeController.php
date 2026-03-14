<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class HomeController extends Controller
{

    public function index()
    {
        $produk = Produk::latest()->limit(6)->get();

        return view('frontend.home', compact('produk'));
    }

}