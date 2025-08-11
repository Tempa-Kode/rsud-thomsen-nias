<form action="{{ route('profile.updateDataPimpinan') }}" method="post">
    @csrf
    @method('POST')
    <div class="card-header">
        <h4>Edit Profile Pimpinan</h4>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card-body">
        <div class="row">
            <div class="form-group col-12">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" required="" name="nama" id="nama" value="{{ old('nama', $relasiData->nama ?? '') }}" placeholder="Belum diisi">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
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
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" required="" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $relasiData->tanggal_lahir ?? '') }}" placeholder="Belum diisi">
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
                <label>Alamat</label>
                <textarea class="form-control summernote-simple @error('alamat') is-invalid @enderror" rows="5" name="alamat" id="alamat">{{ old('alamat', $relasiData->alamat ?? '') }}</textarea>
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
