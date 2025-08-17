@extends('template')
@section('title', 'Pendaftaran Rawat Jalan')
@section('header', 'Pendaftaran Rawat Jalan')

@section('body')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Form Pendaftaran {{ request('bpjs') == true ? 'Pasien BPJS' : 'Non BPJS' }}</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('rawat-jalan.daftar') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <input type="hidden" name="bpjs" value="{{ request('bpjs') }}">
                        <input type="hidden" name="pasien_id" value="{{ Auth::user()->pasien->id }}">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_kunjungan" value="{{ date('Y-m-d') }}" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Poli</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="poli_id">
                                    <option value="" hidden="">Pilih Poli</option>
                                    @foreach($poli as $p)
                                        <option value="{{ $p->id }}" {{ old('poli_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_poli }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dokter (Optional)</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="dokter_id">
                                    <option value="" hidden="">Pilih Dokter</option>
                                    @foreach($dokter as $d)
                                        <option value="{{ $d->id }}" {{ old('dokter_id') == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi Keluhan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="deskripsi_keluhan" id="deskripsi_keluhan" cols="30" rows="10">{{ old('deskripsi_keluhan') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
