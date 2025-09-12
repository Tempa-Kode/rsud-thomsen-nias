<!-- Dashboard untuk Kasir -->
@php
    $kasirData = Auth::user()->kasir;
    $pembayaranHariIni = \App\Models\Pembayaran::whereHas("rawatJalan", function ($q) {
        $q->whereDate("tanggal_kunjungan", today());
    })->count();
    $totalPembayaran = \App\Models\Pembayaran::count();
    $pasienSelesai = \App\Models\RawatJalan::where("status", "selesai")->count();
    $resepObat = \App\Models\ResepObat::count();
    $totalObat = \App\Models\Obat::count();
    $obatStokRendah = \App\Models\Obat::where("stok", "<", 10)->count();
@endphp

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-credit-card"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pembayaran Hari Ini</h4>
                </div>
                <div class="card-body">
                    {{ $pembayaranHariIni }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pembayaran</h4>
                </div>
                <div class="card-body">
                    {{ $totalPembayaran }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pasien Selesai</h4>
                </div>
                <div class="card-body">
                    {{ $pasienSelesai }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-prescription-bottle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Resep Obat</h4>
                </div>
                <div class="card-body">
                    {{ $resepObat }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Informasi Kasir</h4>
            </div>
            <div class="card-body">
                @if ($kasirData)
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Nama:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $kasirData->nama }}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <strong>Alamat:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $kasirData->alamat }}
                        </div>
                    </div>
                @else
                    <p class="text-muted">Data kasir belum lengkap. <a href="{{ route("profile.index") }}">Lengkapi
                            sekarang</a></p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Obat</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="font-weight-600 text-muted mb-2">Total Obat</div>
                            <div class="h4 mb-0 text-primary">{{ $totalObat }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="font-weight-600 text-muted mb-2">Stok Rendah</div>
                            <div class="h4 mb-0 text-danger">{{ $obatStokRendah }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Aksi Cepat</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route("pembayaran.index") }}" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-credit-card"></i> Pembayaran
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route("resep-obat.index") }}" class="btn btn-warning btn-lg btn-block">
                            <i class="fas fa-prescription-bottle"></i> Resep Obat
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route("obat.index") }}" class="btn btn-info btn-lg btn-block">
                            <i class="fas fa-pills"></i> Data Obat
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route("profile.index") }}" class="btn btn-secondary btn-lg btn-block">
                            <i class="fas fa-user-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alerts -->
@if ($obatStokRendah > 0)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Peringatan Stok Obat!</div>
                    Terdapat {{ $obatStokRendah }} jenis obat dengan stok rendah (kurang dari 10 unit).
                    <a href="{{ route("obat.index") }}" class="alert-link">Cek sekarang</a>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($pasienSelesai > 0)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Pasien Menunggu Pembayaran</div>
                    Ada {{ $pasienSelesai }} pasien yang telah selesai pemeriksaan dan mungkin memerlukan pembayaran.
                    <a href="{{ route("rawat-jalan.index") }}" class="alert-link">Lihat sekarang</a>
                </div>
            </div>
        </div>
    </div>
@endif
