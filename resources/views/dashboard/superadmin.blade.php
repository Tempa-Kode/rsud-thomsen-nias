<!-- Dashboard untuk Superadmin dan Pimpinan -->
<div class="row">
    <!-- Card Statistik Utama -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengguna</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_pengguna"] }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Dokter</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_dokter"] }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-cash-register"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Kasir</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_kasir"] }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-pills"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Obat</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_obat"] }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-secondary">
                <i class="fas fa-user-injured"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pasien</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_pasien"] }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-procedures"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Rawat Jalan</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_rawat_jalan"] }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-stethoscope"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pemeriksaan</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_pemeriksaan"] }}
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
                    {{ $statistik["total_resep_obat"] }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-credit-card"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pembayaran</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_pembayaran"] }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-hospital"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Poli</h4>
                </div>
                <div class="card-body">
                    {{ $statistik["total_poli_aktif"] }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Poli Dinamis -->
@if ($dataPoli->count() > 0)
    <div class="row">
        @foreach ($dataPoli as $poli)
            @php
                $jumlahRawatJalan = \App\Models\RawatJalan::where("poli_id", $poli->id)->count();
                $iconClass = match (strtolower($poli->nama_poli)) {
                    "poli umum", "umum" => "fas fa-hospital",
                    "poli gigi", "gigi" => "fas fa-teeth",
                    "poli mata", "mata" => "fas fa-eye",
                    "poli anak", "anak" => "fas fa-baby",
                    "poli kandungan", "kandungan", "kebidanan" => "fas fa-female",
                    "poli jantung", "jantung", "kardiologi" => "fas fa-heartbeat",
                    "poli paru", "paru", "pulmonologi" => "fas fa-lungs",
                    "poli saraf", "saraf", "neurologi" => "fas fa-brain",
                    "poli kulit", "kulit", "dermatologi" => "fas fa-hand-paper",
                    "poli bedah", "bedah" => "fas fa-cut",
                    "poli dalam", "dalam", "penyakit dalam" => "fas fa-user-md",
                    "rehabilitas medik", "rehabilitasi" => "fas fa-tools",
                    "gizi" => "fas fa-apple-alt",
                    "okupasi kerja", "okupasi" => "fas fa-user-friends",
                    default => "fas fa-stethoscope",
                };

                $colorClass = match ($loop->index % 6) {
                    0 => "bg-primary",
                    1 => "bg-success",
                    2 => "bg-info",
                    3 => "bg-warning",
                    4 => "bg-danger",
                    5 => "bg-secondary",
                    default => "bg-primary",
                };
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon {{ $colorClass }}">
                        <i class="{{ $iconClass }}"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ $poli->nama_poli }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $jumlahRawatJalan }}
                        </div>
                    </div>
                </div>
            </div>
            @if (($loop->index + 1) % 4 == 0 && !$loop->last)
    </div>
    <div class="row">
@endif
@endforeach
</div>
@else
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-hospital"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Poli Umum</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-teeth"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Poli Gigi</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-heart"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Paru</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jantung</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Okupasi Kerja</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-tools"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Rehabilitas Medik</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-eye"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Gizi</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Alert untuk informasi penting -->
@if ($statistik["obat_stok_rendah"] > 0)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Peringatan Stok Obat!</div>
                    Terdapat {{ $statistik["obat_stok_rendah"] }} jenis obat dengan stok rendah (kurang dari 10 unit).
                    <a href="{{ route("obat.index") }}" class="alert-link">Cek sekarang</a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Statistik Hari Ini -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Hari Ini</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="font-weight-600 text-muted mb-2">Rawat Jalan Hari Ini</div>
                            <div class="h4 mb-0">{{ $statistik["rawat_jalan_hari_ini"] }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="font-weight-600 text-muted mb-2">Pemeriksaan Hari Ini</div>
                            <div class="h4 mb-0">{{ $statistik["pemeriksaan_hari_ini"] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Status Pasien</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="font-weight-600 text-muted mb-2">Menunggu</div>
                            <div class="h4 mb-0 text-warning">{{ $statistik["pasien_menunggu"] }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="font-weight-600 text-muted mb-2">Dalam Perawatan</div>
                            <div class="h4 mb-0 text-info">{{ $statistik["pasien_dalam_perawatan"] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
