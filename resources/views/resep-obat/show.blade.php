@extends("template")
@section("title", "Detail Resep Obat")
@section("header", "Detail Resep Obat")
@section("body")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Resep Obat</h4>
                    <div class="card-header-action">
                        <a href="{{ route("resep-obat.index") }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tanggal Kunjungan:</strong></label>
                                <p>{{ \Carbon\Carbon::parse($rawatJalan->tanggal_kunjungan)->format("d F Y") }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>NIK Pasien:</strong></label>
                                <p>{{ $rawatJalan->pasien->nik }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Nama Pasien:</strong></label>
                                <p>{{ $rawatJalan->pasien->nama }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Poli:</strong></label>
                                <p>{{ $rawatJalan->poli->nama_poli }}</p>
                            </div>

                            @if ($rawatJalan->bpjs == 1)
                                <div class="form-group">
                                    <label><strong>No BPJS:</strong></label>
                                    <p>{{ $rawatJalan->pasien->no_bpjs ?? "-" }}</p>
                                </div>
                            @endif

                            <div class="form-group">
                                <label><strong>Dokter:</strong></label>
                                <p>{{ $rawatJalan->dokter->nama ?? "-" }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            @if ($rawatJalan->riwayatPemeriksaan)
                                <div class="form-group">
                                    <label><strong>Diagnosa:</strong></label>
                                    <p>{{ $rawatJalan->riwayatPemeriksaan->diagnosa }}</p>
                                </div>

                                <div class="form-group">
                                    <label><strong>Penyakit:</strong></label>
                                    <p>{{ $rawatJalan->riwayatPemeriksaan->penyakit }}</p>
                                </div>
                            @endif

                            <div class="form-group">
                                <label><strong>Status Rawat Jalan:</strong></label>
                                <span
                                    class="badge
                                    @if ($rawatJalan->status == "menunggu") badge-warning
                                    @elseif($rawatJalan->status == "dalam_perawatan") badge-info
                                    @elseif($rawatJalan->status == "selesai") badge-success
                                    @else badge-secondary @endif">
                                    {{ ucfirst(str_replace("_", " ", $rawatJalan->status)) }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label><strong>Status Pengambilan Obat:</strong></label>
                                @if ($rawatJalan->riwayatPemeriksaan && $rawatJalan->riwayatPemeriksaan->ambil_obat == true)
                                    <span class="badge badge-success">Sudah Diambil</span>
                                @else
                                    <span class="badge badge-warning">Belum Diambil</span>
                                @endif
                            </div>
                            {{-- @dd($rawatJalan->riwayatPemeriksaan->id) --}}
                            @if (
                                $rawatJalan->pembayaran->status === "lunas" &&
                                    $rawatJalan->riwayatPemeriksaan &&
                                    $rawatJalan->riwayatPemeriksaan->ambil_obat != true)
                                <div class="form-group">
                                    <form
                                        action="{{ route("resep-obat.update-status-pengambilan", $rawatJalan->riwayatPemeriksaan->id) }}"
                                        method="post">
                                        @csrf
                                        @method("PUT")
                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Yakin mengubah status pengambilan obat menjadi Sudah Diambil?')">
                                            <i class="fas fa-check mr-3"></i> Tandai Sudah Diambil
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h5><strong>Detail Obat</strong></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalKeseluruhan = 0; @endphp
                                @foreach ($rawatJalan->resepObat as $resep)
                                    @php $subtotal = $resep->obat->harga * $resep->jumlah; @endphp
                                    @php $totalKeseluruhan += $subtotal; @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $resep->obat->nama_obat }}</td>
                                        <td>{{ $resep->obat->jenis_obat }}</td>
                                        <td>Rp {{ number_format($resep->obat->harga, 0, ",", ".") }}</td>
                                        <td>{{ $resep->jumlah }}</td>
                                        <td>Rp {{ number_format($subtotal, 0, ",", ".") }}</td>
                                        <td>{{ $resep->keterangan ?? "-" }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-primary">
                                    <th colspan="5" class="text-right">Total Keseluruhan:</th>
                                    <th>Rp {{ number_format($totalKeseluruhan, 0, ",", ".") }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
