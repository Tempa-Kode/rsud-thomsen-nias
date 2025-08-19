@extends("template")
@section("title", "Resep Obat")
@section("header", "Resep Obat")

@section("body")
    <div class="row">
        <div class="col-12">
            @if (session("success"))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    <strong>Berhasil!</strong> {{ session("success") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Resep Obat</h4>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>NIK</th>
                                    <th>Nama Pasien</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Jumlah Obat</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('d/m/Y') }}</td>
                                        <td>{{ $item->pasien->nik }}</td>
                                        <td>{{ $item->pasien->nama }}</td>
                                        <td>{{ $item->poli->nama_poli }}</td>
                                        <td>{{ $item->dokter->nama ?? '-' }}</td>
                                        <td>{{ $item->resepObat->count() }} jenis obat</td>
                                        <td>Rp {{ number_format($item->resepObat->sum(function($resep) { return $resep->obat->harga * $resep->jumlah; }), 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('resep-obat.show', $item->id) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data resep obat</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection
