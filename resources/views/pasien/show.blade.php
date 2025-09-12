@extends('template')

@section('title', 'Detail Pasien')
@section('header', 'Detail Pasien')

@section('body')
<div class="section">
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-white"><i class="fas fa-id-card mr-2"></i> {{ $pasien->username }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama</div>
                            <div class="col-sm-8">{{ $pasien->username }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Email</div>
                            <div class="col-sm-8">{{ $pasien->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Role</div>
                            <div class="col-sm-8">{{ $pasien->role }}</div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama Lengkap</div>
                            <div class="col-sm-8">{{ $pasien->pasien->nama ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">No Bpjs</div>
                            <div class="col-sm-8">{{ $pasien->pasien->no_bpjs ?? "Bukan Peserta BPJS" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama Jenis Kelamin</div>
                            <div class="col-sm-8">
                                {{ $pasien->pasien && $pasien->pasien->jenis_kelamin == 'L' ? 'Laki-Laki' : ($pasien->pasien && $pasien->pasien->jenis_kelamin == 'P' ? 'Perempuan' : "Data belum di isi") }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Tempat Lahir</div>
                            <div class="col-sm-8">{{ $pasien->pasien->tempat_lahir ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Tanggal Lahir</div>
                            <div class="col-sm-8">{{ $pasien->pasien->tanggal_lahir ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Alamat</div>
                            <div class="col-sm-8">{{ $pasien->pasien->alamat ?? "Data belum di isi" }}</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('pasien.index') }}" class="btn btn-secondary mt-4"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
