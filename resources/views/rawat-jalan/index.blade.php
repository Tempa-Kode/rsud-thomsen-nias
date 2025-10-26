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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <div class="d-flex w-75">
                        <form action="" class="d-inline" method="get">
                            <input type="text" hidden name="bpjs" value="1">
                            <button type="submit" class="btn btn-success">Pasien BPJS</button>
                        </form>
                        <form action="" method="get">
                            <input type="text" hidden name="bpjs" value="0">
                            <button type="submit" class="btn btn-outline-success ml-2">Pasien Non BPJS</button>
                        </form>
                    </div>
                    @can('downloadReport', App\Models\RawatJalan::class)
                        <div class="d-flex">
                            <form action="{{ route('rawat-jalan.download-report') }}" method="get" class="d-flex align-items-end">
                                <div class="form-group">
                                    <label>Periode Awal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control datepicker" name="periode_awal">
                                    </div>
                                </div>
                                <div class="form-group ml-3">
                                    <label>Periode Akhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control datepicker" name="periode_akhir">
                                    </div>
                                </div>
                                <div class="form-group ml-3">
                                    <label>Poli</label>
                                    <select name="poli_id" id="poli_id" class="form-control">
                                        <option value="">-- Pilih Poli --</option>
                                        @forelse($poli as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_poli }}</option>
                                        @empty
                                            <option value="">Tidak ada poli tersedia</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group ml-3">
                                    <button type="submit" class="btn btn-outline-success d-inline">Download</button>
                                </div>
                            </form>
                        </div>
                    @endcan
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
                                    <td>
                                        <a href="{{ route('rekam-medik.cetak', $item->pasien->id) }}">{{ $item->pasien->nama }}</a>
                                    </td>
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
                                        @if ($item->status === 'validasi')
                                            @can('validasiPendaftaran', $item)
                                                <form action="{{ route('rawat-jalan.validasi-pendaftaran', $item->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-primary">Teruskan Ke Pendaftaran</button>
                                                </form>
                                            @endcan
                                        @elseif($item->status === 'menunggu' && Auth::user()->role === 'dokter')
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

@push('script')
    <script src="{{ asset('node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>
@endpush
