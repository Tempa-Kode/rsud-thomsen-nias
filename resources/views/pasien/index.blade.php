@extends("template")
@section("title", "Data Pasien")
@section("header", "Data Pasien")

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
                    @can("create", App\Models\Pasien::class)
                        <div class="pt-3 pl-3">
                            <a href="{{ route("pasien.create") }}" class="btn btn-primary">Tambah Data</a>
                        </div>
                    @endcan
                    <div class="pt-3 pl3">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-download mr-2"></i> Unduh Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{ route("download.pasien.pdf", ["bpjs" => 1]) }}"><i
                                        class="fas fa-download mr-2"></i> Pasien BPJS</a>
                                <a class="dropdown-item" href="{{ route("download.pasien.pdf", ["bpjs" => 0]) }}"><i
                                        class="fas fa-download mr-2"></i> Pasien Non BPJS</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->pasien->nama ?? "-" }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <div class="badge badge-success text-capitalize">{{ $item->role }}</div>
                                        </td>
                                        <td>
                                            @can("update", $item->pasien)
                                                <a href="{{ route("pasien.edit", $item->id) }}" class="btn btn-warning">Edit</a>
                                            @endcan
                                            <a href="{{ route("pasien.show", $item->id) }}"
                                                class="btn btn-secondary">Detail</a>
                                            @can("delete", $item->pasien)
                                                <form action="{{ route("pasien.destroy", $item->id) }}" class="d-inline"
                                                    method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah anda ingin menghapus data ini?')">Hapus</button>
                                                </form>
                                            @endcan
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
