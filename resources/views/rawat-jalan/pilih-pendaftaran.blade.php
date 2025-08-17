@extends('template')
@section('title', 'Pilih Pendaftaran Rawat Jalan')
@section('header', 'Pendaftaran Rawat Jalan')

@section('body')
    <div class="row">
        <div class="col-12">
            @if ($errors->has('error'))
                <div class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('rawat-jalan.halaman-pendaftaran', ['bpjs' => true]) }}" class="text-decoration-none">
            <div class="card card-success">
                <div class="card-header">
                    <h4>Pasien BPJS</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('rawat-jalan.halaman-pendaftaran', ['bpjs' => true]) }}" class="btn btn-success">Daftar</a>
                </div>
            </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('rawat-jalan.halaman-pendaftaran', ['bpjs' => false]) }}" class="text-decoration-none">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Pasien Non BPJS</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('rawat-jalan.halaman-pendaftaran', ['bpjs' => false]) }}" class="btn btn-primary">Daftar</a>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
