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
    <li class="nav-item {{ $active == 'menu-dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ $active == 'menu-peminjaman' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.peminjaman.index') }}">
            <i class="fas fa-fw fa-upload"></i>
            <span>Peminjaman</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-pengembalian' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.pengembalian.index') }}">
            <i class="fas fa-fw fa-download"></i>
            <span>Pengembalian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $active == 'menu-role' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.role.index') }}">
            <i class="fas fa-solid fa-key"></i>
            <span>Role</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-user' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.user.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-asset' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.asset.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Asset</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-warehouse' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.warehouse.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Warehouse</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
