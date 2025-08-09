@extends('template')
@section('title', 'Edit Obat')
@section('header', 'Edit Obat')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Obat</h4>
                </div>
                @if($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                            @error('nama_obat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_obat">Jenis Obat</label>
                            <input type="text" class="form-control @error('jenis_obat') is-invalid @enderror" id="jenis_obat" name="jenis_obat" value="{{ old('jenis_obat', $obat->jenis_obat) }}" required>
                            @error('jenis_obat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="merk_obat">Merk Obat</label>
                            <input type="text" class="form-control @error('merk_obat') is-invalid @enderror" id="merk_obat" name="merk_obat" value="{{ old('merk_obat', $obat->merk_obat) }}" required>
                            @error('merk_obat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="aturan_pakai">Aturan Pakai</label>
                            <textarea class="form-control @error('aturan_pakai') is-invalid @enderror" id="aturan_pakai" name="aturan_pakai" rows="50">{{ old('aturan_pakai', $obat->aturan_pakai) }}</textarea>
                            @error('aturan_pakai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok Obat</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $obat->stok) }}" required>
                            @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Obat</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $obat->harga) }}" required>
                            @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan Obat</label>
                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan', $obat->satuan) }}" required>
                            @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
