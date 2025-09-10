@extends("template")
@section("title", "Detail Pemeriksaan")
@section("header", "Detail Pemeriksaan")

@section("body")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIK</label>
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->pasien->nik }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->pasien->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Poli</label>
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->poli->nama_poli }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Dokter</label>
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->dokter->nama ?? "-" }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Kunjungan</label>
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->tanggal_kunjungan }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Nomor Antrian</label>
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->nomor_antrian }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>BPJS</label>
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->bpjs ? "Ya" : "Tidak" }}"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label>Biaya Pemeriksaan</label>
                        <input class="form-control" value="{{ number_format($pemeriksaan->biaya_pemeriksaan, 0, ",", ".") }}"
                            readonly>
                    </div>
                    @if (Auth::user()->role == 'pasien' && $pemeriksaan->rawatJalan->pembayaran->status == 'belum_lunas')
                        <div class="alert alert-warning">
                            Hasil pemeriksaan dan resep obat akan ditampilkan setelah melakukan pembayaran di bagian kasir.
                        </div>
                    @else
                        <div class="form-group">
                            <label>Penyakit</label>
                            <input class="form-control" value="{{ $pemeriksaan->penyakit }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <textarea class="form-control" rows="4" readonly>{{ $pemeriksaan->diagnosa }}</textarea>
                        </div>
                        <hr>
                        <h5>Resep Obat</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($resep as $r)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $r->obat->nama_obat ?? "-" }}</td>
                                            <td>{{ $r->jumlah }}</td>
                                            <td>{{ $r->keterangan ?? "-" }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada resep</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif


                    <a href="{{ route("riwayat-pemeriksaan.index") }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
