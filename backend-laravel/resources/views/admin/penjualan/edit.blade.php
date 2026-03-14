@extends('admin.layouts.app')

@section('content')
<main class="app-main">

  <!-- HEADER -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Edit Penjualan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('admin.penjualan.index') }}">Penjualan</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="app-content">
    <div class="container-fluid">

      <div class="card card-warning card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="bi bi-pencil"></i> Form Edit Penjualan
          </h3>
        </div>

        <form method="POST" action="{{ route('admin.penjualan.update', $penjualan->id) }}">
          @csrf
          @method('PUT')

          <div class="card-body">
            <div class="row">

              <!-- TANGGAL -->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Tanggal</label>
                  <input type="date"
                         name="tanggal"
                         class="form-control"
                         value="{{ old('tanggal', $penjualan->tanggal) }}"
                         required>
                </div>
              </div>

              <!-- PRODUK -->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Produk</label>
                  <select name="produk" class="form-select" required>
                    @foreach(['Stampel','Name Tag','MMT'] as $produk)
                      <option value="{{ $produk }}"
                        {{ $penjualan->produk === $produk ? 'selected' : '' }}>
                        {{ $produk }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <!-- JUMLAH -->
              <div class="col-md-2">
                <div class="mb-3">
                  <label class="form-label">Jumlah</label>
                  <input type="number"
                         name="jumlah"
                         class="form-control"
                         min="1"
                         value="{{ old('jumlah', $penjualan->jumlah) }}"
                         required>
                </div>
              </div>

              <!-- HARGA -->
              <div class="col-md-2">
                <div class="mb-3">
                  <label class="form-label">Harga</label>
                  <input type="number"
                         name="harga"
                         class="form-control"
                         min="0"
                         value="{{ old('harga', $penjualan->harga) }}"
                         required>
                </div>
              </div>

              <!-- PELANGGAN -->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Pelanggan</label>
                  <input type="text"
                         name="pelanggan"
                         class="form-control"
                         value="{{ old('pelanggan', $penjualan->pelanggan) }}">
                </div>
              </div>

              <!-- STATUS -->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" required>
                    <option value="Selesai" {{ $penjualan->status === 'Selesai' ? 'selected' : '' }}>
                      Selesai
                    </option>
                    <option value="Pending" {{ $penjualan->status === 'Pending' ? 'selected' : '' }}>
                      Pending
                    </option>
                  </select>
                </div>
              </div>

            </div>
          </div>

          <div class="card-footer text-end">
            <a href="{{ route('admin.penjualan.index') }}" class="btn btn-secondary">
              <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-warning">
              <i class="bi bi-save"></i> Update Data
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>

</main>
@endsection
