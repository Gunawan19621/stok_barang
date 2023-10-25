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
            <span class="ml-4">Peminjaman</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-pengembalian' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.pengembalian.index') }}">
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
    <li class="nav-item {{ $active == 'menu-role' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.role.index') }}">
            <span class="ml-4">Role</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-user' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.user.index') }}">
            <span class="ml-4">User</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-asset' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.asset.index') }}">
            <span class="ml-4">Asset</span>
        </a>
    </li>
    <li class="nav-item {{ $active == 'menu-warehouse' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.warehouse.index') }}">
            <span class="ml-4">Warehouse</span>
        </a>
    </li>
</ul>
