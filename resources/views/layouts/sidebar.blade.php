<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIOPAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/dashboard2') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard/transaksi') }}">
            <span class="ml-4">Transaksi</span>
        </a>
    </li>
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
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard/pengadaan') }}">
            <span class="ml-4">Pengadaan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard/settingPlatform') }}">
            <span class="ml-4">Setting Platform</span>
        </a>
    </li>
</ul>
