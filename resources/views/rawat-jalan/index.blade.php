@extends('template')
@section('title', 'Rawat Jalan')
@section('header', 'Rawat Jalan')

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
                    @can('create', App\Models\RawatJalan::class)
                    <div class="pt-3 pl-3">
                        <a href="{{ route('rawat-jalan.pilih-pendaftaran') }}" class="btn btn-primary">Daftar Rawat Jalan</a>
                    </div>
                    @endcan
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>No. Antrian</th>
                                    <th>Nama Pasien</th>
                                    @if(request('bpjs') == '1') <th>No BPJS</th> @endif
                                    <th>Tanggal Kunjungan</th>
                                    <th>Umur</th>
                                    <th>Poli Tujuan</th>
                                    <th>Dokter</th>
                                    <th>Status</th>
                                    @if(Auth::user()->role != 'pasien' && Auth::user()->role != 'kasir' && Auth::user()->role != 'pimpinan')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($rawatJalan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pasien->nik }}</td>
                                    <td>{{ $item->nomor_antrian }}</td>
                                    <td>{{ $item->pasien->nama }}</td>
                                    @if(request('bpjs') == '1') <td>{{ $item->pasien->no_bpjs }}</td> @endif
                                    <td>{{ $item->tanggal_kunjungan }}</td>
                                    <td>
                                        @php
                                            echo \Carbon\Carbon::parse($item->pasien->tanggal_lahir)->age . ' tahun';
                                        @endphp
                                    </td>
                                    <td>{{ $item->poli->nama_poli }}</td>
                                    <td>{{ $item->dokter->nama ?? '-' }}</td>
                                    <td>
                                        @if($item->status === 'menunggu')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($item->status === 'dalam_perawatan')
                                            <span class="badge badge-info">Dalam Perawatan</span>
                                        @elseif($item->status === 'selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    @if(Auth::user()->role != 'pasien' && Auth::user()->role != 'kasir' && Auth::user()->role != 'pimpinan')
                                    <td>
                                        @if ($item->status === 'menunggu')
                                            <a href="{{ route('riwayat-pemeriksaan.periksa', $item->id) }}" class="btn btn-success">Periksa</a>
                                        @else
                                            <span class="text-muted">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                    @endif
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
