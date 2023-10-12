<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIOPAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard/transaksi') }}">
            <span class="ml-4">Transaksi</span>
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <span class="ml-4">Transaksi</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/dashboard/barangMasuk') }}">Barang Masuk</a>
                <a class="collapse-item" href="{{ url('/dashboard/barangKeluar') }}">Barang Keluar</a>
            </div>
        </div>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard/peminjaman') }}">
            <span class="ml-4">Peminjaman</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard/pengembalian') }}">
            <span class="ml-4">Pengembalian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('asset.index') }}">
            <span class="ml-4">Asset</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <span class="ml-4">User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('warehouse.index') }}">
            <span class="ml-4">Warehouse</span>
        </a>
    </li>
</ul>
