@extends("template")
@section("title", "Form Surat Rujukan")
@section("header", "Form Surat Rujukan")

@section("body")
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Kembali</a>
            <div class="card">
                <div class="card-header">
                    <h4>Form Surat Rujukan</h4>
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
                <form action="{{ route('surat-rujukan.simpan') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <input type="hidden" name="pasien_id" value="{{ $pemeriksaan->rawatJalan->pasien_id }}">
                        <input type="hidden" name="dokter_id" value="{{ $pemeriksaan->rawatJalan->dokter_id }}">
                        <input type="hidden" name="riwayat_pemeriksaan_id" value="{{ $pemeriksaan->id }}">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Rekam Medik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $pemeriksaan->rawatJalan->nomor_rekam_medik }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pasien</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $pemeriksaan->rawatJalan->pasien->nama }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi Keluhan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="deskripsi_keluhan" id="deskripsi_keluhan" cols="30" rows="10" readonly>{{ $pemeriksaan->rawatJalan->deskripsi_keluhan }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Penyakit</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="penyakit" id="penyakit" cols="30" rows="10" readonly>{{ $pemeriksaan->penyakit }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Diagnosa</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="diagnosa" id="diagnosa" cols="30" rows="10" readonly>{{ $pemeriksaan->diagnosa }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tujuan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tujuan" id="tujuan" value="{{ old('tujuan') }}" required placeholder="Direktur RS . . . .">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat Tujuan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="alamat_tujuan" id="alamat_tujuan" value="{{ old('alamat_tujuan') }}" required placeholder="Cth : Gunungsitoli">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Buat Rujukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
