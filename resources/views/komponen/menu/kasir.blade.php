<li class="menu-header">Dashboard</li>
<li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
<li class="menu-header">Menu</li>
<li class=""><a class="nav-link" href="{{ route('rawat-jalan.index') }}"><i class="fas fa-file-medical"></i> <span>Rawat Jalan</span></a></li>
<li class=""><a class="nav-link" href="{{ route('riwayat-pemeriksaan.index') }}"><i class="fas fa-notes-medical"></i> <span>Pemeriksaan</span></a></li>
<li class="{{ str_contains(Route::currentRouteName(), 'resep-obat') ? 'active' : '' }}"><a class="nav-link" href="{{ route('resep-obat.index') }}"><i class="fas fa-pills"></i> <span>Resep Obat</span></a></li>
<li class="{{ Route::currentRouteName() == 'pembayaran.index' ? 'active' : '' }}"><a class="nav-link" href="{{  route('pembayaran.index') }}"><i class="fas fa-money-bill-wave"></i> <span>Pembayaran</span></a></li>
