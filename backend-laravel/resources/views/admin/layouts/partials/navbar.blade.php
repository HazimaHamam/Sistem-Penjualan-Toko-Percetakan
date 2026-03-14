<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">

    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">

        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
          </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.laporan.index') }}" class="nav-link">Laporan</a>
          </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">

          <!--begin::Navbar Search-->
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="bi bi-search"></i>
            </a>
          </li>
          <!--end::Navbar Search-->

          <!--begin::Prediksi Dropdown-->
          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="{{ route('admin.prediksi.index') }}" role="button">
              Prediksi
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <a href="#" class="dropdown-item">
              <h3 class="dropdown-item-title">
                Prediksi Bulan Depan
                <span class="float-end fs-7 text-success">
                  <i class="bi bi-arrow-up"></i>
                </span>
              </h3>
              <p class="fs-7">Estimasi: Rp 14.200.000</p>
              <p class="fs-7 text-secondary">
                <i class="bi bi-clock-fill me-1"></i> Sistem ML
              </p>
            </a>

          </div>
        </li>
          <!--end::Prediksi Dropdown-->

          <!--begin::Notifications Dropdown-->
          <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#">
              <i class="bi bi-bell-fill"></i>
              @if($jumlahNotifikasi > 0)
                <span class="navbar-badge badge text-bg-warning">
                    {{ $jumlahNotifikasi }}
                </span>
            @endif
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <span class="dropdown-item dropdown-header">Notifikasi Sistem</span>

              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="bi bi-database me-2"></i> Data penjualan diperbarui
                <span class="float-end text-secondary fs-7">10 menit</span>
              </a>

              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="bi bi-cpu me-2"></i> Model prediksi dijalankan
                <span class="float-end text-secondary fs-7">1 jam</span>
              </a>

              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">Lihat Semua</a>
            </div>
          </li>
          <!--end::Notifications Dropdown-->

          <!--begin::Fullscreen-->
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="fullscreen" href="#">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
            </a>
          </li>
          <!--end::Fullscreen-->

          <!--begin::User Menu-->
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img
                src="{{ asset('assets/img/user2-160x160.jpg') }}"
                class="user-image rounded-circle shadow"
                alt="User Image"
              >
              <span class="d-none d-md-inline">Admin Penjualan</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-header text-bg-primary">
                <img
                  src="{{ asset('assets/img/user2-160x160.jpg') }}"
                  class="rounded-circle shadow"
                  alt="User Image"
                >
                <p>
                  Admin Sistem Prediksi
                  <small>Aplikasi Prediksi Penjualan</small>
                </p>
              </li>

              <li class="user-body">
                <div class="row">
                  <div class="col-4 text-center"><a href="{{ route('admin.penjualan.index') }}">Data</a></div>
                  <div class="col-4 text-center"><a href="{{ route('admin.prediksi.index') }}">Prediksi</a></div>
                  <div class="col-4 text-center"><a href="{{ route('admin.laporan.index') }}">Laporan</a></div>
                </div>
              </li>

              <li class="user-footer">
                <a href="#" class="btn btn-outline-secondary">Profil</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline float-end">
                  @csrf
                  <button type="submit" class="btn btn-outline-danger">
                      Logout
                  </button>
              </form>
              </li>
            </ul>
          </li>
          <!--end::User Menu-->

        </ul>
        <!--end::End Navbar Links-->

      </div>
      <!--end::Container-->
    </nav>
    <!--end::Header-->
