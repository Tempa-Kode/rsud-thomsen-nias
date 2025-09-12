@extends("template")
@section("title", "Data Obat")
@section("header", "Data Obat")

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
                <div class="card-header d-flex justify-content-between align-items-center">
                    @can("create", App\Models\Obat::class)
                        <div class="pt-3 pl-3">
                            <a href="{{ route("obat.create") }}" class="btn btn-primary">Tambah Data</a>
                        </div>
                    @endcan
                    <div class="pt-3 pl-3">
                        <a href="{{ route("obat.report.download") }}" class="btn btn-success" target="_blank">
                            <i class="fas fa-download mr-2"></i>Unduh Data
                        </a>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis Obat</th>
                                    <th>Merk Obat</th>
                                    <th>Stok Obat</th>
                                    <th>Harga Obat</th>
                                    @can("aksi", App\Models\Obat::class)
                                        <th>Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_obat }}</td>
                                        <td>{{ $item->jenis_obat }}</td>
                                        <td>{{ $item->merk_obat }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>Rp. {{ $item->getHargaFormattedAttribute() }}</td>
                                        @can("aksi", App\Models\Obat::class)
                                            <td>
                                                <a href="{{ route("obat.edit", $item->id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route("obat.destroy", $item->id) }}" class="d-inline"
                                                    method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah anda ingin menghapus data ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        @endcan
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
