<li class="menu-header">Dashboard</li>
<li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
<li class="menu-header">Menu</li>
<li class=""><a class="nav-link" href="#"><i class="fas fa-file-medical"></i> <span>Rawat Jalan</span></a></li>
<li class=""><a class="nav-link" href="#"><i class="fas fa-notes-medical"></i> <span>Pemeriksaan</span></a></li>
<li class=""><a class="nav-link" href="#"><i class="fas fa-pills"></i> <span>Resep Obat</span></a></li>
