<li class="menu-header">Dashboard</li>
<li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
<li class="menu-header">Master Data</li>
<li class="nav-item dropdown {{ request()->is('pengguna/*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-users"></i> <span>Data Pengguna</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link {{ Route::currentRouteName() == 'superadmin.index' ? 'text-primary' : '' }}" href="{{ route('superadmin.index') }}">Superadmin</a></li>
        <li><a class="nav-link {{ Route::currentRouteName() == 'pimpinan.index' ? 'text-primary' : '' }}" href="{{ route('pimpinan.index') }}">Pimpinan</a></li>
        <li><a class="nav-link" href="">Dokter</a></li>
        <li><a class="nav-link" href="">Kasir</a></li>
        <li><a class="nav-link" href="">Pasien</a></li>
    </ul>
</li>
<li class=""><a class="nav-link" href=""><i class="fas fa-pills"></i> <span>Data Obat</span></a></li>
<li class=""><a class="nav-link" href=""><i class="far fa-solid fa-hospital"></i> <span>Data Poli</span></a></li>
