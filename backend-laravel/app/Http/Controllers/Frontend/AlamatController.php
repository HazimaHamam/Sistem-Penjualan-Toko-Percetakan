<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Menampilkan halaman Alamat.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Pastikan file Blade ada di resources/views/frontend/alamat/index.blade.php
        return view('frontend.alamat.index');
    }
}