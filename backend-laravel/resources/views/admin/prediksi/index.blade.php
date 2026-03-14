@extends('admin.layouts.app')

@section('content')
<main class="app-main">

  <!-- Header -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Prediksi Penjualan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Prediksi Penjualan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="app-content">
    <div class="container-fluid">

      <!-- FORM PREDIKSI -->
      <div class="card card-primary card-outline mb-4">
        <div class="card-header">
          <h3 class="card-title">
            <i class="bi bi-bar-chart-line"></i> Form Prediksi
          </h3>
        </div>
        <div class="row mb-4">

      <div class="col-md-4">
        <div class="small-box text-bg-secondary">
          <div class="inner">
            <h4>{{ $lastPenjualan ?? '-' }}</h4>
            <p>Penjualan Bulan Terakhir</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="small-box text-bg-dark">
          <div class="inner">
            <h4>{{ $jumlahData ?? 0 }}</h4>
            <p>Total Data Training</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h4>{{ $lastTrained ?? '-' }}</h4>
            <p>Terakhir Update Model</p>
          </div>
        </div>
      </div>

    </div>
        <form method="POST" action="{{ route('admin.prediksi.proses') }}">
          @csrf

          <div class="card-body">
            <div class="row">

              <!-- PRODUK -->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Produk</label>
                  <select class="form-select" name="produk" required>
                    <option value="" disabled selected>Pilih Produk</option>
                    @foreach($produk as $p)
                      <option value="{{ $p }}">{{ $p }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <!-- BULAN -->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Bulan</label>
                  <input type="month" name="bulan" class="form-control" required>
                </div>
              </div>

              <!-- METODE -->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Metode Prediksi</label>
                  <select class="form-select" name="metode" required>
                    <option value="RF" selected>Random Forest</option>
                  </select>
                </div>
              </div>

            </div>
          </div>

          <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-cpu"></i> Proses Prediksi
            </button>
          </div>
        </form>
      </div>

      {{-- ALERT WARNING --}}
      @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show">
          {{ session('warning') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      {{-- HASIL PREDIKSI --}}
      @if(isset($hasil))
      <div class="row mt-4">

        <!-- HASIL -->
        <div class="col-lg-4 col-12">
          <div class="small-box text-bg-success">
            <div class="inner">
              <h3>
                  {{ number_format($hasil) }}
                  @if(isset($persentase))
                    <small class="{{ $persentase >= 0 ? 'text-success' : 'text-danger' }}">
                      ({{ $persentase >= 0 ? '+' : '' }}{{ $persentase }}%)
                    </small>
                  @endif
                </h3>
                <div class="alert 
                  {{ $status === 'Naik' ? 'alert-success' : 
                    ($status === 'Turun' ? 'alert-danger' : 'alert-warning') }}">
                  @if($status === 'Naik')
                    📈 Prediksi menunjukkan peningkatan dibanding bulan sebelumnya.
                  @elseif($status === 'Turun')
                    📉 Prediksi menunjukkan penurunan dibanding bulan sebelumnya.
                  @else
                    ➖ Penjualan diprediksi stabil.
                  @endif

                </div>
              <p>Hasil Prediksi Penjualan</p>
            </div>
          </div>
        </div>

        <!-- AKURASI -->
        <div class="col-lg-4 col-12">
          <div class="small-box text-bg-info">
            <div class="inner">
              <h3>
              {{ $akurasiReal !== null ? $akurasiReal : '-' }}
              <sup>%</sup>
            </h3>
            <p>Akurasi Model</p>
            </div>
          </div>
        </div>

        <!-- STATUS -->
        <div class="col-lg-4 col-12">
          <div class="small-box
            {{ $status === 'Naik' ? 'text-bg-success' :
               ($status === 'Turun' ? 'text-bg-danger' : 'text-bg-warning') }}">
            <div class="inner">
              <h3>{{ $status }}</h3>
              <p>Status Penjualan</p>
            </div>
          </div>
        </div>

      </div>
      @endif

 {{-- =========================
     GRAFIK PREDIKSI
========================= --}}
@if(!empty($labels) && !empty($values))
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Grafik Prediksi Penjualan</h3>
    </div>
    <div class="card-body">
        <canvas id="chartPrediksi" height="120"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('chartPrediksi');
    if (!canvas) return;

    const labels = @json($labels);
    const values = @json($values);

    new Chart(canvas, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
{
    label: 'Data Aktual',
    data: values.slice(0, values.length - 1),
    borderColor: '#198754',
    tension: 0.3,
    fill: false
},
{
    label: 'Prediksi',
    data: [
        ...Array(values.length - 1).fill(null),
        values[values.length - 1]
    ],
    borderColor: '#dc3545',
    borderDash: [5,5],
    pointRadius: 6,
    fill: false
}
]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Jumlah: ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>
@endif

    </div>
</div>
</main>
@endsection
