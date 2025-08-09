@extends('template')

@section('title', 'Detail Kasir')
@section('header', 'Detail Kasir')

@section('body')
<div class="section">
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-white"><i class="fas fa-id-card mr-2"></i> {{ $kasir->username }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama</div>
                            <div class="col-sm-8">{{ $kasir->username }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Email</div>
                            <div class="col-sm-8">{{ $kasir->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Role</div>
                            <div class="col-sm-8">{{ $kasir->role }}</div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama Lengkap</div>
                            <div class="col-sm-8">{{ $kasir->kasir->nama ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Nama Jenis Kelamin</div>
                            <div class="col-sm-8">
                                {{ $kasir->kasir && $kasir->kasir->jenis_kelamin == 'L' ? 'Laki-Laki' : ($kasir->kasir && $kasir->kasir->jenis_kelamin == 'P' ? 'Perempuan' : "Data belum di isi") }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Tempat Lahir</div>
                            <div class="col-sm-8">{{ $kasir->kasir->tempat_lahir ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Tanggal Lahir</div>
                            <div class="col-sm-8">{{ $kasir->kasir->tanggal_lahir ?? "Data belum di isi" }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Alamat</div>
                            <div class="col-sm-8">{{ $kasir->kasir->alamat ?? "Data belum di isi" }}</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('kasir.index') }}" class="btn btn-secondary mt-4"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
