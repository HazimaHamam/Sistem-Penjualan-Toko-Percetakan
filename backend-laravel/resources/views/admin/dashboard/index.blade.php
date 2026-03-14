@extends('admin.layouts.app')

@section('content')
<main class="app-main">

  <!-- Header -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Dashboard Penjualan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row">

        <!-- Total Transaksi -->
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-primary">
            <div class="inner">
              <h3>{{ $totalTransaksi }}</h3>
              <p>Total Transaksi</p>
            </div>
            <i class="bi bi-receipt small-box-icon"></i>
          </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-success">
            <div class="inner">
              <p class="mb-1 fw-semibold">Total Pendapatan</p>
              <h3 class="fw-bold">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
              </h3>
            </div>
            <i class="bi bi-cash-stack small-box-icon"></i>
          </div>
        </div>

        <!-- Pendapatan Hari Ini -->
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-info">
            <div class="inner">
              <p class="mb-1 fw-semibold">Pendapatan Hari Ini</p>
              <h3 class="fw-bold mb-0">
                Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
              </h3>
              <small class="opacity-75">
                {{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}
              </small>
            </div>
            <i class="bi bi-calendar-check small-box-icon"></i>
          </div>
        </div>

        <!-- Produk Terjual -->
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3>{{ $produkTerjual }}</h3>
              <p>Produk Terjual</p>
            </div>
            <i class="bi bi-box-seam small-box-icon"></i>
          </div>
        </div>

        <!-- Prediksi Penjualan -->
          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
              <div class="inner">
                <h3>
                  {{ $prediksiBulanIni ? number_format($prediksiBulanIni) : '-' }}
                </h3>
                <p>Prediksi Penjualan Bulan Ini</p>
              </div>
              <i class="bi bi-bar-chart-line small-box-icon"></i>
            </div>
          </div>

        <!-- Pelanggan Aktif -->
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-secondary">
            <div class="inner">
              <h3>{{ $pelangganAktif }}</h3>
              <p>Pelanggan Aktif</p>
            </div>
            <i class="bi bi-people-fill small-box-icon"></i>
          </div>
        </div>

      </div>
    </div>
  </div>

</main>
@endsection
