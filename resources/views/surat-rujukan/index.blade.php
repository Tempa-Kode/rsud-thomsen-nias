@extends("template")
@section("title", "Surat Rujukan")
@section("header", "Surat Rujukan")

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
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Pasien</th>
                                    <th>Nomor Surat</th>
                                    <th>Tgl Surat</th>
                                    <th>Tujuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if (isset($item->no_surat))
                                                <span class="badge badge-success">Sudah Terbit</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->riwayatPemeriksaan->rawatJalan->pasien->nama }}</td>
                                        <td>{{ $item->no_surat ?? '-' }}</td>
                                        <td>{{ $item->tgl_surat ?? '-' }}</td>
                                        <td>{{ $item->tujuan }}</td>
                                        <td>
                                            @if (isset($item->no_surat))
                                                <a href="{{ route('surat-rujukan.cetak', $item->id)}}" class="btn btn-success" target="_blank">Cetak</a>    
                                            @else
                                                <a href="{{ route('riwayat-pemeriksaan.show', $item->riwayat_pemeriksaan_id) }}" class="btn btn-secondary" target="_blank">Detail</a>
                                                @if (Auth::user()->role == 'pimpinan')
                                                    <a href="{{ route('surat-rujukan.terbit', $item->id)}}" class="btn btn-primary ml-2">Terbitkan</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
