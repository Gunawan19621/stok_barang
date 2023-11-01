<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.home.user') }}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SIOPAS</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Nav Item - Dashboard -->
<li class="nav-item {{ $active == 'menu-user' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.home.user') }}">
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

@php
    $isUserActive = in_array($active, ['menu-user', 'menu-role']);
@endphp

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="{{ $isUserActive ? 'true' : 'false' }}" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user"></i>
        <span>Manajemen User</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ $active == 'menu-user' ? 'active' : '' }}"
                href="{{ route('dashboard.user.index') }}">User</a>
            <a class="collapse-item {{ $active == 'menu-role' ? 'active' : '' }}"
                href="{{ route('dashboard.role.index') }}">Role</a>
        </div>
    </div>
</li>
<li class="nav-item {{ $active == 'menu-customer' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.customer.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Customer</span>
    </a>
</li>
@php
    $isPetiActive = in_array($active, ['menu-user', 'menu-role']);
@endphp

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepeti"
        aria-expanded="{{ $isPetiActive ? 'true' : 'false' }}" aria-controls="collapsepeti">
        <i class="fas fa-fw fa-user"></i>
        <span>Manajemen Peti</span>
    </a>
    <div id="collapsepeti" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ $active == 'menu-typepeti' ? 'active' : '' }}"
                href="{{ route('dashboard.typepeti.index') }}">Tipe Peti</a>
            <a class="collapse-item {{ $active == 'menu-peti' ? 'active' : '' }}"
                href="{{ route('dashboard.peti.index') }}">Peti</a>
        </div>
    </div>
</li>
<li class="nav-item {{ $active == 'menu-warehouse' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.warehouse.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Warehouse</span>
    </a>
</li>
