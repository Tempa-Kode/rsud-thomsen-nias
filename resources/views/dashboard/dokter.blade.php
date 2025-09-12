<!-- Dashboard untuk Dokter -->
@php
    $dokterData = Auth::user()->dokter;
    $rawatJalanDokter = \App\Models\RawatJalan::where("dokter_id", $dokterData->id ?? 0);
    $pasienHariIni = $rawatJalanDokter->whereDate("tanggal_kunjungan", today())->count();
    $pasienMenunggu = $rawatJalanDokter->where("status", "menunggu")->count();
    $pasienDalamPerawatan = $rawatJalanDokter->where("status", "dalam_perawatan")->count();
    $pasienSelesai = $rawatJalanDokter->where("status", "selesai")->count();
    $totalPemeriksaan = \App\Models\RiwayatPemeriksaan::whereHas("rawatJalan", function ($q) use ($dokterData) {
        $q->where("dokter_id", $dokterData->id ?? 0);
    })->count();
@endphp

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pasien Hari Ini</h4>
                </div>
                <div class="card-body">
                    {{ $pasienHariIni }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Menunggu</h4>
                </div>
                <div class="card-body">
                    {{ $pasienMenunggu }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Dalam Perawatan</h4>
                </div>
                <div class="card-body">
                    {{ $pasienDalamPerawatan }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Selesai</h4>
                </div>
                <div class="card-body">
                    {{ $pasienSelesai }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Informasi Dokter</h4>
            </div>
            <div class="card-body">
                @if ($dokterData)
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Nama:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $dokterData->nama }}
                        </div>
                    </div>
                    {{-- <div class="row mt-2">
                        <div class="col-md-4">
                            <strong>Spesialis:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $dokterData->spesialis }}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <strong>No. HP:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $dokterData->no_hp }}
                        </div>
                    </div> --}}
                @else
                    <p class="text-muted">Data dokter belum lengkap. <a href="{{ route("profile.index") }}">Lengkapi
                            sekarang</a></p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Pemeriksaan</h4>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="font-weight-600 text-muted mb-2">Total Pemeriksaan</div>
                    <div class="h2 mb-0 text-primary">{{ $totalPemeriksaan }}</div>
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
                    <div class="col-md-4 mb-3">
                        <a href="{{ route("rawat-jalan.index") }}" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-procedures"></i> Lihat Rawat Jalan
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route("riwayat-pemeriksaan.index") }}" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-history"></i> Riwayat Pemeriksaan
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route("profile.index") }}" class="btn btn-info btn-lg btn-block">
                            <i class="fas fa-user-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($pasienMenunggu > 0)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Ada Pasien Menunggu!</div>
                    Anda memiliki {{ $pasienMenunggu }} pasien yang sedang menunggu untuk diperiksa.
                    <a href="{{ route("rawat-jalan.index") }}" class="alert-link">Lihat sekarang</a>
                </div>
            </div>
        </div>
    </div>
@endif
