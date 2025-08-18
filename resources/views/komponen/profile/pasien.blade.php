<form action="{{ route('profile.updateDataPasien') }}" method="post">
    @csrf
    @method('POST')
    <div class="card-header">
        <h4>Edit Profile Pasien</h4>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="nik">NIK</label>
                <input type="number" class="form-control @error('nik') is-invalid @enderror" required="" name="nik" id="nik" value="{{ old('nik', $relasiData->nik ?? '') }}" placeholder="Belum diisi">
                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror"  required="" name="nama" id="nama" value="{{ old('nama', $relasiData->nama ?? '') }}" placeholder="Belum diisi">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-7 col-12">
                <label for="no_bpjs">No BPJS</label>
                <input type="number" class="form-control @error('no_bpjs') is-invalid @enderror" name="no_bpjs" id="no_bpjs" value="{{ old('no_bpjs', $relasiData->no_bpjs ?? '') }}" placeholder="Belum diisi">
                @error('no_bpjs')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-5 col-12">
                <label class="d-block">Jenis Kelamin</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineradio1" value="L" name="jenis_kelamin" {{ old('jenis_kelamin', $relasiData->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineradio1">Laki-Laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineradio2" value="P" name="jenis_kelamin" {{ old('jenis_kelamin', $relasiData->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineradio2">Perempuan</label>
                </div>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" required="" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $relasiData->tempat_lahir ?? '') }}" placeholder="Belum diisi">
                @error('tempat_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"  required="" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $relasiData->tanggal_lahir ?? '') }}" placeholder="Belum diisi">
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="tinggi_badan">Tinggi Badan</label>
                <div class="input-group mb-2">
                    <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" placeholder="Belum diisi" name="tinggi_badan" value="{{ old('tinggi_badan', $relasiData->tinggi_badan ?? '') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                    </div>
                </div>
                @error('tinggi_badan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="berat_badan">Berat Badan</label>
                <div class="input-group mb-2">
                    <input type="number" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" placeholder="Belum diisi" name="berat_badan" value="{{ old('berat_badan', $relasiData->berat_badan ?? '') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">Kg</div>
                    </div>
                </div>
                @error('berat_badan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
                <label for="no_hp">No Hp</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">+62</div>
                    </div>
                    <input type="text" class="form-control" id="no_hp" placeholder="Belum diisi" name="no_hp" value="{{ old('no_hp', $relasiData->no_hp ?? '') }}" required>
                </div>
                @error('no_hp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" required="" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $relasiData->pekerjaan ?? '') }}" placeholder="Belum diisi">
                @error('pekerjaan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="agama">Agama</label>
                <div class="input-group mb-2">
                    <select class="custom-select @error('pekerjaan') is-invalid @enderror" name="agama" id="agama" required>
                        <option value="" hidden>Pilih</option>
                        <option value="Islam" {{ old('agama', $relasiData->agama ?? '-') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen Protestan" {{ old('agama', $relasiData->agama ?? '-') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                        <option value="Katolik" {{ old('agama', $relasiData->agama ?? '-') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $relasiData->agama ?? '-') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama', $relasiData->agama ?? '-') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama', $relasiData->agama ?? '-') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>
                @error('agama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
                <label>Alamat</label>
                <textarea class="form-control summernote-simple @error('alamat') is-invalid @enderror" rows="30" name="alamat" id="alamat" required>
                    {{ old('alamat', $relasiData->alamat ?? '-') }}
                </textarea>
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
