<!-- Dashboard untuk Pasien -->
@php
    $pasienData = Auth::user()->pasien;
    $riwayatRawatJalan = \App\Models\RawatJalan::where("pasien_id", $pasienData->id ?? 0);
    $totalKunjungan = $riwayatRawatJalan->count();
    $kunjunganSelesai = $riwayatRawatJalan->where("status", "selesai")->count();
    $kunjunganMenunggu = $riwayatRawatJalan->where("status", "menunggu")->count();
    $totalPemeriksaan = \App\Models\RiwayatPemeriksaan::whereHas("rawatJalan", function ($q) use ($pasienData) {
        $q->where("pasien_id", $pasienData->id ?? 0);
    })->count();
    $antrian = $riwayatRawatJalan->where("status", "menunggu")->whereDate("tanggal_kunjungan", today())->first();
@endphp

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-hospital-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Kunjungan</h4>
                </div>
                <div class="card-body">
                    {{ $totalKunjungan }}
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
                    <h4>Kunjungan Selesai</h4>
                </div>
                <div class="card-body">
                    {{ $kunjunganSelesai }}
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
                    {{ $kunjunganMenunggu }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-stethoscope"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pemeriksaan</h4>
                </div>
                <div class="card-body">
                    {{ $totalPemeriksaan }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informasi Pasien -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Informasi Pasien</h4>
            </div>
            <div class="card-body">
                @if ($pasienData)
                    <div class="row">
                        <div class="col-md-3"><strong>NIK:</strong></div>
                        <div class="col-md-9">{{ $pasienData->nik }}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3"><strong>Nama:</strong></div>
                        <div class="col-md-9">{{ $pasienData->nama }}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3"><strong>Jenis Kelamin:</strong></div>
                        <div class="col-md-9">{{ $pasienData->jenis_kelamin === "L" ? "Laki-laki" : "Perempuan" }}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3"><strong>Tanggal Lahir:</strong></div>
                        <div class="col-md-9">{{ \Carbon\Carbon::parse($pasienData->tanggal_lahir)->format("d F Y") }}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3"><strong>Umur:</strong></div>
                        <div class="col-md-9">{{ \Carbon\Carbon::parse($pasienData->tanggal_lahir)->age }} tahun</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3"><strong>No. HP:</strong></div>
                        <div class="col-md-9">{{ $pasienData->no_hp ?? "-" }}</div>
                    </div>
                    @if ($pasienData->no_bpjs)
                        <div class="row mt-2">
                            <div class="col-md-3"><strong>No. BPJS:</strong></div>
                            <div class="col-md-9">
                                <span class="badge badge-success">{{ $pasienData->no_bpjs }}</span>
                            </div>
                        </div>
                    @endif
                @else
                    <p class="text-muted">Data pasien belum lengkap. <a href="{{ route("profile.index") }}">Lengkapi
                            sekarang</a></p>
                @endif
            </div>
        </div>
    </div>

    <!-- Antrian Hari Ini -->
    <div class="col-lg-4">
        @if ($antrian)
            <div class="card">
                <div class="card-header">
                    <h4>Antrian Hari Ini</h4>
                </div>
                <div class="card-body text-center">
                    <div class="h1 text-primary">{{ $antrian->nomor_antrian }}</div>
                    <div class="font-weight-600">Nomor Antrian Anda</div>
                    <div class="text-muted mt-2">{{ $antrian->poli->nama_poli }}</div>
                    <div class="text-muted">{{ $antrian->dokter->nama ?? "Dokter belum ditentukan" }}</div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <h4>Antrian Hari Ini</h4>
                </div>
                <div class="card-body text-center">
                    <div class="text-muted">Tidak ada antrian hari ini</div>
                    <a href="{{ route("rawat-jalan.pilih-pendaftaran") }}" class="btn btn-primary mt-3">
                        Daftar Rawat Jalan
                    </a>
                </div>
            </div>
        @endif
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
                        <a href="{{ route("rawat-jalan.pilih-pendaftaran") }}"
                            class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-plus-circle"></i> Daftar Rawat Jalan
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route("rawat-jalan.index") }}" class="btn btn-info btn-lg btn-block">
                            <i class="fas fa-history"></i> Riwayat Kunjungan
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route("profile.index") }}" class="btn btn-secondary btn-lg btn-block">
                            <i class="fas fa-user-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Alert -->
@if ($antrian)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Anda memiliki antrian hari ini!</div>
                    Nomor antrian Anda adalah <strong>{{ $antrian->nomor_antrian }}</strong> untuk
                    {{ $antrian->poli->nama_poli }}.
                    Pastikan Anda datang tepat waktu.
                </div>
            </div>
        </div>
    </div>
@endif

@if ($kunjunganMenunggu > 1)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Perhatian!</div>
                    Anda memiliki {{ $kunjunganMenunggu }} antrian yang masih menunggu.
                    <a href="{{ route("rawat-jalan.index") }}" class="alert-link">Lihat detail</a>
                </div>
            </div>
        </div>
    </div>
@endif
