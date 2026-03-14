@extends('admin.layouts.app')

@section('content')
<main class="app-main">

  <!-- HEADER -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Laporan Penjualan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Laporan Penjualan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="app-content">
    <div class="container-fluid">

      <!-- FILTER LAPORAN -->
      <div class="card card-primary card-outline mb-4">
        <div class="card-header">
          <h3 class="card-title">
            <i class="bi bi-funnel-fill"></i> Filter Laporan
          </h3>
        </div>
        <form method="GET" action="{{ route('admin.laporan.index') }}">
          <div class="card-body">
            <div class="row">

              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label">Tanggal Mulai</label>
                  <input type="date" class="form-control" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                </div>
              </div>

              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label">Tanggal Akhir</label>
                  <input type="date" class="form-control" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                </div>
              </div>

              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label">Produk</label>
                  <select class="form-select" name="produk">
                    <option value="">Semua Produk</option>
                    @foreach($produkList as $produk)
                      <option value="{{ $produk }}" {{ request('produk') == $produk ? 'selected' : '' }}>
                        {{ $produk }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select class="form-select" name="status">
                    <option value="">Semua Status</option>
                    <option value="Selesai" {{ request('status')=='Selesai'?'selected':'' }}>Selesai</option>
                    <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
                  </select>
                </div>
              </div>

            </div>
          </div>

          <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-search"></i> Tampilkan
            </button>
           <a href="{{ route('admin.laporan.export.excel', request()->query()) }}"
          class="btn btn-success">
          <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
            <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}"
              class="btn btn-danger">
              <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
          </div>
        </form>
      </div>

      <!-- RINGKASAN -->
      <div class="row mb-4">

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-primary">
            <div class="inner">
              <h3>{{ $totalTransaksi }}</h3>
              <p>Total Transaksi</p>
            </div>
            <i class="bi bi-receipt small-box-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-success">
            <div class="inner">
              <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
              <p>Total Pendapatan</p>
            </div>
            <i class="bi bi-cash-stack small-box-icon"></i>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-info">
              <div class="inner">
                  <h3>Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</h3>
                  <p>Rata-rata Pendapatan / Transaksi</p>
              </div>
          </div>
      </div>

        <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
          <div class="inner">
            <p class="mb-1 fw-semibold">Pendapatan Hari Ini</p>

            <h3 class="fw-bold mb-0">
               Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
            </h3>

            <small class="opacity-75">
              {{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}
            </small>
          </div>

          <div class="small-box-icon">
            <i class="bi bi-calendar-check"></i>
          </div>
        </div>
      </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3>{{ $produkTerjual }}</h3>
              <p>Produk Terjual</p>
            </div>
            <i class="bi bi-box-seam small-box-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-info">
            <div class="inner">
              <h3>{{ $pelangganAktif }}</h3>
              <p>Pelanggan Aktif</p>
            </div>
            <i class="bi bi-people-fill small-box-icon"></i>
          </div>
        </div>

      </div>

      <!-- TABEL LAPORAN -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="bi bi-table"></i> Data Penjualan
          </h3>
        </div>

        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-light">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Kode Transaksi</th>
                <th class="text-center">Produk</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Total</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <div class="mt-3">
                {{ $penjualan->links() }}
            </div>
              @forelse($penjualan as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                <td class="text-center">{{ $item->kode }}</td>
                <td class="text-center">{{ $item->produk }}</td>
                <td class="text-center">{{ $item->jumlah }}</td>
                <td class="text-center">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                <td class="text-center">
                  <span class="badge 
                    {{ $item->status == 'Selesai' ? 'text-bg-success' : 'text-bg-warning' }}">
                    {{ $item->status }}
                  </span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center text-muted">
                  Data tidak ditemukan
                </td>
              </tr>
              @endforelse
              <tfoot>
              <tr class="table-light fw-bold">
                  <td colspan="5" class="text-end">Total Pendapatan:</td>
                  <td class="text-center">
                      Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                  </td>
                  <td></td>
              </tr>
              </tfoot>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>

</main>
@endsection
