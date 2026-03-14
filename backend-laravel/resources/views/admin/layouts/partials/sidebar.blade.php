<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img
        src="{{ asset('assets/img/AdminLTELogo.png') }}"
        alt="Logo"
        class="brand-image opacity-75 shadow"
      />
      <span class="brand-text fw-light">Sistem Penjualan</span>
    </a>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">

      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
      >

        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }} " class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- Data Penjualan --}}
        <li class="nav-item">
          <a href="{{ route('admin.penjualan.index') }}" class="nav-link {{ request()->routeIs('admin.penjualan.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-database"></i>
            <p>Data Penjualan</p>
          </a>
        </li>

        {{-- Produk --}}
        <li class="nav-item">
          <a href="{{ route('admin.produk.index') }}" 
          class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}"> 
            <i class="nav-icon bi bi-box-seam"></i>
            <p>Manajemen Produk</p>
          </a>
        </li>

        {{-- Prediksi --}}
        <li class="nav-item">
          <a href="{{ route('admin.prediksi.index') }}" class="nav-link {{ request()->routeIs('admin.prediksi.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-graph-up-arrow"></i>
            <p>Prediksi Penjualan</p>
          </a>
        </li>

        {{-- Laporan --}}
        <li class="nav-item">
          <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-earmark-text"></i>
            <p>Laporan</p>
          </a>
        </li>

        {{-- Model & Akurasi --}}
        <li class="nav-item">
          <a href="{{ route('admin.model.index') }}" class="nav-link {{ request()->routeIs('admin.model.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-cpu"></i>
            <p>Model & Akurasi</p>
          </a>
        </li>

        <li class="nav-header">SISTEM</li>

        {{-- Pengguna --}}
        <li class="nav-item">
          <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-people"></i>
            <p>Manajemen User</p>
          </a>
        </li>

        {{-- Pengaturan --}}
        <li class="nav-item">
          <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-gear"></i>
            <p>Pengaturan</p>
          </a>
        </li>

        {{-- Logout --}}
        <li class="nav-item">
          <a
            href="{{ route('logout') }}"
            class="nav-link text-danger"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          >
            <i class="nav-icon bi bi-box-arrow-right"></i>
            <p>Logout</p>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>

      </ul>
      <!--end::Sidebar Menu-->

    </nav>
  </div>
  <!--end::Sidebar Wrapper-->

</aside>
<!--end::Sidebar-->
