<form action="{{ route('profile.updateDataDokter') }}" method="post">
    @csrf
    @method('POST')
    <div class="card-header">
        <h4>Edit Profile Dokter</h4>
    </div>
    @if(session('error'))
        <div class="alert alert-danger mx-3">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success mx-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="nip">NIP</label>
                <input type="text" class="form-control @error('nip') is-invalid @enderror" required="" name="nip" id="nip" value="{{ old('nip', $relasiData->nip ?? '') }}" placeholder="Belum diisi">
                @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6 col-12">
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
                <label for="poli_id">Poli</label>
                <select class="form-control @error('poli_id') is-invalid @enderror" name="poli_id" id="poli_id" required>
                    <option value="" disabled selected>Pilih Poli</option>
                    @foreach($poli as $item)
                        <option value="{{ $item->id }}" {{ old('poli_id', $relasiData->poli_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_poli }}
                        </option>
                    @endforeach
                </select>
                @error('poli_id')
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
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="jam_mulai_kerja">Jam Mulai Kerja</label>
                <input type="time" class="form-control @error('jam_mulai_kerja') is-invalid @enderror" required="" name="jam_mulai_kerja" id="jam_mulai_kerja" value="{{ old('jam_mulai_kerja', $relasiData->jam_mulai_kerja ?? '') }}" placeholder="Belum diisi" step="60">
                @error('jam_mulai_kerja')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="jam_selesai_kerja">Jam Selesai Kerja</label>
                <input type="time" class="form-control @error('jam_selesai_kerja') is-invalid @enderror" required="" name="jam_selesai_kerja" id="jam_selesai_kerja" value="{{ old('jam_selesai_kerja', $relasiData->jam_selesai_kerja ?? '') }}" placeholder="Belum diisi" step="60">
                @error('jam_selesai_kerja')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
                <label>Hari Kerja</label>
                <textarea class="form-control summernote-simple @error('hari_kerja') is-invalid @enderror" rows="5" name="hari_kerja" id="hari_kerja">{{ old('hari_kerja', $relasiData->hari_kerja ?? '-') }}</textarea>
                @error('hari_kerja')
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
