@extends("template")
@section("title", "Riwayat Pemeriksaan")
@section("header", "Riwayat Pemeriksaan")

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
                <div class="d-flex justify-content-between align-items-center p-3">
                    <div class="d-flex">
                        <form action="" class="d-inline" method="get">
                            <input type="text" hidden name="bpjs" value="1">
                            <button type="submit" class="btn btn-sm btn-success">Pasien BPJS</button>
                        </form>
                        <form action="" method="get">
                            <input type="text" hidden name="bpjs" value="0">
                            <button type="submit" class="btn btn-sm btn-outline-success ml-2">Pasien Non BPJS</button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Rekam Medik</th>
                                    <th>NIK</th>
                                    <th>Nama Pasien</th>
                                    @if (request("bpjs") == "1")
                                        <th>No BPJS</th>
                                    @endif
                                    <th>Poli Tujuan</th>
                                    <th>Dokter</th>
                                    <th>Penyakit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->rawatJalan->nomor_rekam_medik ?? "-" }}</td>
                                        <td>{{ $item->rawatJalan->pasien->nik }}</td>
                                        <td>
                                            <a href="{{ route('rekam-medik.cetak', $item->rawatJalan->pasien->id) }}">{{ $item->rawatJalan->pasien->nama }}</a>
                                        </td>
                                        @if (request("bpjs") == "1")
                                            <td>{{ $item->rawatJalan->pasien->no_bpjs }}</td>
                                        @endif
                                        <td>{{ $item->rawatJalan->poli->nama_poli }}</td>
                                        <td>{{ $item->rawatJalan->dokter->nama ?? "-" }}</td>
                                        <td>{{ $item->penyakit ?? "-" }}</td>
                                        <td>
                                            <a href="{{ route("riwayat-pemeriksaan.show", $item->id) }}"
                                                class="btn btn-secondary mr-1">Detail</a>
                                            @if (Auth::user()->can('aksi', $item))
                                                <a href="{{ route("riwayat-pemeriksaan.edit", $item->id) }}"
                                                    class="btn btn-primary">Edit</a>
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
