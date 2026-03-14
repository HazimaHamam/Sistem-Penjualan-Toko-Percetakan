@extends('admin.layouts.app')

@section('content')

<main class="app-main">

    <!-- ================= HEADER ================= -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-sm-6">
                    <h3 class="mb-0">Penjualan</h3>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Penjualan</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <!-- ================= CONTENT ================= -->
    <div class="app-content">
        <div class="container-fluid">

            <!-- ================= FORM INPUT PENJUALAN ================= -->
            <div class="card card-primary card-outline mb-4">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-cart-plus"></i> Input Penjualan
                    </h3>
                </div>

                <form method="POST" action="{{ route('admin.penjualan.store') }}">
                    @csrf

                    <div class="card-body">
                        <div class="row">

                            <!-- TANGGAL -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Transaksi</label>
                                    <input type="date"
                                           name="tanggal"
                                           class="form-control"
                                           value="{{ now()->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>

                            <!-- PRODUK -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Produk</label>
                                    <select name="produk" class="form-select" required>
                                        <option value="">Pilih Produk</option>
                                        <option value="Stampel">Stampel</option>
                                        <option value="Name Tag">Name Tag</option>
                                        <option value="MMT">MMT</option>
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
                                           required>
                                </div>
                            </div>

                            <!-- PELANGGAN -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Nama Pelanggan</label>
                                    <input type="text"
                                           name="pelanggan"
                                           class="form-control">
                                </div>
                            </div>

                            <!-- METODE -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Metode Pembayaran</label>
                                    <select name="metode" class="form-select" required>
                                        <option value="Tunai">Tunai</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="E-Wallet">E-Wallet</option>
                                    </select>
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Penjualan
                        </button>
                    </div>

                </form>
            </div>


            <!-- ================= TABEL DATA PENJUALAN ================= -->
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-table"></i> Data Penjualan
                    </h3>
                </div>

                <div class="card-body table-responsive">

                    <!-- SEARCH + DELETE -->
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.penjualan.index') }}">
                                <div class="input-group">
                                    <input type="text"
                                           name="search"
                                           class="form-control"
                                           placeholder="Cari kode / produk / pelanggan..."
                                           value="{{ request('search') }}">

                                    <button class="btn btn-primary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6 text-end">
                            <button type="submit"
                                    form="form-mass-delete"
                                    class="btn btn-danger"
                                    onclick="return confirm('Hapus data terpilih?')">
                                <i class="bi bi-trash"></i> Hapus Terpilih
                            </button>
                        </div>

                    </div>


                    <!-- FORM MASS DELETE -->
                    <form action="{{ route('admin.penjualan.bulkDelete') }}"
                          method="POST"
                          id="form-mass-delete">

                        @csrf

                        <!-- ALERT -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show">
                                {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif


                        <!-- TABLE -->
                        <table class="table table-bordered table-striped table-hover align-middle text-nowrap">

                            <thead class="table-light">
                                <tr>
                                    <th width="3%" class="text-center">
                                        <input type="checkbox" id="checkAll">
                                    </th>

                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="10%">Tanggal</th>
                                    <th class="text-center" width="18%">Kode</th>
                                    <th class="text-center" width="12%">Produk</th>
                                    <th class="text-center" width="8%">Jumlah</th>
                                    <th class="text-center" width="12%">Total</th>
                                    <th class="text-center" width="15%">Pelanggan</th>
                                    <th class="text-center" width="8%">Status</th>
                                    <th class="text-center" width="9%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($penjualan as $index => $item)

                                <tr>

                                    <td class="text-center">
                                        <input type="checkbox"
                                               name="ids[]"
                                               value="{{ $item->id }}"
                                               class="checkItem">
                                    </td>

                                    <td class="text-center">{{ $index + 1 }}</td>

                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    </td>

                                    <td class="text-center">{{ $item->kode }}</td>

                                    <td class="text-center">{{ $item->produk }}</td>

                                    <td class="text-center">{{ $item->jumlah }}</td>

                                    <td class="text-center">
                                        Rp {{ number_format($item->total,0,',','.') }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->pelanggan ?? '-' }}
                                    </td>

                                    <td class="text-center">
                                        <span class="badge {{ $item->status === 'Selesai' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-center">

                                        <a href="{{ route('admin.penjualan.edit',$item->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="hapusSatu('{{ route('admin.penjualan.destroy',$item->id) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="10" class="text-center text-muted">
                                        Data penjualan belum tersedia
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </form>


                    <!-- PAGINATION -->
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $penjualan->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

        </div>
    </div>

</main>


<!-- FORM DELETE SATUAN -->
<form id="form-delete-satuan" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>


<script>
function hapusSatu(url)
{
    if(confirm('Yakin ingin menghapus data ini?'))
    {
        const form = document.getElementById('form-delete-satuan');
        form.action = url;
        form.submit();
    }
}
</script>

@endsection