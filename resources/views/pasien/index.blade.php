@extends('template')
@section('title', 'Data Pasien')
@section('header', 'Data Pasien')

@section('body')
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="pt-3 pl-3">
                    <a href="{{ route('pasien.create') }}" class="btn btn-primary">Tambah Data</a>
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
                            @foreach($pasien as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->pasien->nama ?? "-" }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td><div class="badge badge-success text-capitalize">{{ $item->role }}</div></td>
                                    <td>
                                        <a href="{{ route('pasien.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('pasien.show', $item->id) }}" class="btn btn-secondary">Detail</a>
                                        <form action="{{ route('pasien.destroy', $item->id) }}" class="d-inline" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?')">Hapus</button>
                                        </form>
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
