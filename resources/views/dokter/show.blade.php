@extends('template')

@section('title', 'Detail Dokter')
@section('header', 'Detail Dokter')

@section('body')
<div class="section">
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-white"><i class="fas fa-id-card mr-2"></i> {{ $dokter->username }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama</div>
                            <div class="col-sm-8">{{ $dokter->username }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Email</div>
                            <div class="col-sm-8">{{ $dokter->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Role</div>
                            <div class="col-sm-8">{{ $dokter->role }}</div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama Lengkap</div>
                            <div class="col-sm-8">{{ $dokter->dokter->nama ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama Jenis Kelamin</div>
                            <div class="col-sm-8">
                                {{ $dokter->dokter && $dokter->dokter->jenis_kelamin == 'L' ? 'Laki-Laki' : ($dokter->dokter && $dokter->dokter->jenis_kelamin == 'P' ? 'Perempuan' : "Data belum di isi") }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Tempat Lahir</div>
                            <div class="col-sm-8">{{ $dokter->dokter->tempat_lahir ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Tanggal Lahir</div>
                            <div class="col-sm-8">{{ $dokter->dokter->tanggal_lahir ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Alamat</div>
                            <div class="col-sm-8">{{ $dokter->dokter->alamat ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Jam Kerja</div>
                            <div class="col-sm-8">
                                {{ $dokter->dokter->jam_mulai_kerja ? \Carbon\Carbon::parse($dokter->dokter->jam_mulai_kerja)->format('H:i') : "Data belum di isi" }} -
                                {{ $dokter->dokter->jam_selesai_kerja ? \Carbon\Carbon::parse($dokter->dokter->jam_selesai_kerja)->format('H:i') : "Data belum di isi" }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Hari Kerja</div>
                            <div class="col-sm-8">{{ $dokter->dokter->hari_kerja ?? "Data belum di isi" }}</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('dokter.index') }}" class="btn btn-secondary mt-4"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
