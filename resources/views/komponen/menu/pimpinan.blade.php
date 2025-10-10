<li class="menu-header">Dashboard</li>
<li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
<li class="menu-header">Menu</li>
<li class="{{ Route::currentRouteName() == 'dokter.index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('dokter.index') }}"><i class="fas fa-stethoscope"></i> <span>Dokter</span></a></li>
<li class="{{ Route::currentRouteName() == 'pasien.index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pasien.index') }}"><i class="fas fa-bed"></i> <span>Pasien</span></a></li>
<li class="{{ Route::currentRouteName() == 'obat.index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('obat.index') }}"><i class="fas fa-pills"></i> <span>Obat</span></a></li>
<li class="{{ Route::currentRouteName() == 'rawat-jalan.index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('rawat-jalan.index') }}"><i class="fas fa-file-medical"></i> <span>Rawat Jalan</span></a></li>
<li class="{{ Route::currentRouteName() == 'riwayat-pemeriksaan.index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('riwayat-pemeriksaan.index') }}"><i class="fas fa-notes-medical"></i> <span>Pemeriksaan</span></a></li>
<li class="{{ Route::currentRouteName() == 'resep-obat.index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('resep-obat.index') }}"><i class="fas fa-pills"></i> <span>Resep Obat</span></a></li>
<li class="{{ Route::currentRouteName() == 'surat-rujukan.index' ? 'active' : '' }}"><a class="nav-link" href="{{  route('surat-rujukan.index') }}"><i class="fas fa-envelope"></i> <span>Surat Rujukan</span></a></li>