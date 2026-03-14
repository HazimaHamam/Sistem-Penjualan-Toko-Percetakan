@extends('admin.layouts.app')

@section('content')
<main class="app-main">

  <!-- HEADER -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Model & Akurasi</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Model & Akurasi</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="app-content">
    <div class="container-fluid">

      <div class="row">

        <!-- INFO MODEL -->
        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="bi bi-cpu"></i> Informasi Model
              </h3>
            </div>

            <div class="card-body">
              <table class="table table-bordered">
                <tr>
                  <th width="35%">Nama Model</th>
                  <td>{{ $model['nama'] }}</td>
                </tr>
                <tr>
                  <th>Versi</th>
                  <td>{{ $model['versi'] }}</td>
                </tr>
                <tr>
                  <th>Fitur Digunakan</th>
                  <td>
                    @foreach($model['fitur'] as $fitur)
                      <span class="badge bg-secondary">{{ $fitur }}</span>
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>
                    <span class="badge bg-success">{{ $model['status'] }}</span>
                  </td>
                </tr>
                <tr>
                  <th>Terakhir Update</th>
                  <td>{{ $model['updated'] }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <!-- AKURASI MODEL -->
        <div class="col-md-6">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="bi bi-graph-up"></i> Akurasi Model
              </h3>
            </div>

            <div class="card-body text-center">
              <h1 class="display-4 text-success">
                {{ $model['akurasi'] }}%
              </h1>

              <p class="text-muted">
                Berdasarkan evaluasi data real (MAPE)
              </p>

              <div class="progress">
                <div
                  class="progress-bar bg-success"
                  style="width: {{ $model['akurasi'] }}%">
                </div>
              </div>
            </div>
          </div>

          {{-- ========================= --}}
{{-- AKURASI PER PRODUK --}}
{{-- ========================= --}}
@if(!empty($akurasiProduk))
<div class="card mt-4">
  <div class="card-header">
    <h3 class="card-title">
      <i class="bi bi-bar-chart"></i> Akurasi Per Produk
    </h3>
  </div>

  <div class="card-body">
    <table class="table table-bordered text-center">
      <thead class="table-light">
        <tr>
          <th>Produk</th>
          <th>Akurasi (%)</th>
        </tr>
      </thead>
      <tbody>
        @foreach($akurasiProduk as $item)
        <tr>
          <td>{{ $item['produk'] }}</td>
          <td>
            <span class="badge bg-success">
              {{ $item['akurasi'] }}%
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif


{{-- ========================= --}}
{{-- ACTUAL VS PREDICTION --}}
{{-- ========================= --}}
@if(!empty($grafikData))
  @foreach($grafikData as $produk => $g)
  <div class="card mt-4">
    <div class="card-header">
      <h3 class="card-title">
        <i class="bi bi-graph-up"></i>
        Actual vs Prediction – {{ $produk }}
      </h3>
    </div>

    <div class="card-body">
      <canvas id="chart-{{ Str::slug($produk) }}" height="120"></canvas>
    </div>
  </div>
  @endforeach

  <script>
    document.addEventListener('DOMContentLoaded', function () {

      @foreach($grafikData as $produk => $g)
        new Chart(
          document.getElementById('chart-{{ Str::slug($produk) }}'),
          {
            type: 'line',
            data: {
              labels: @json($g['bulan']),
              datasets: [
                {
                  label: 'Actual',
                  data: @json($g['actual']),
                  borderWidth: 3,
                  tension: 0.4
                },
                {
                  label: 'Prediction',
                  data: @json($g['prediction']),
                  borderDash: [6, 6],
                  borderWidth: 3,
                  tension: 0.4
                }
              ]
            },
            options: {
              responsive: true,
              plugins: {
                legend: { position: 'top' }
              },
              scales: {
                y: { beginAtZero: true }
              }
            }
          }
        );
      @endforeach

    });
  </script>
@endif
    </div>

    </div>
  </div>
</main>
@endsection
