@extends("template")
@section("title", "Edit Pemeriksaan")
@section("header", "Edit Pemeriksaan")

@section("body")
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route("riwayat-pemeriksaan.update", $pemeriksaan->id) }}">
                        @csrf
                        @method("PUT")

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->pasien->nik }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Pasien</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $pemeriksaan->rawatJalan->pasien->nama }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Penyakit</label>
                            <div class="col-sm-9">
                                <input type="text" name="penyakit" class="form-control"
                                    value="{{ old("penyakit", $pemeriksaan->penyakit) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Diagnosa</label>
                            <div class="col-sm-9">
                                <textarea name="diagnosa" class="form-control" rows="4">{{ old("diagnosa", $pemeriksaan->diagnosa) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Biaya Pemeriksaan</label>
                            <div class="col-sm-9">
                                <input type="number" step="0.01" name="biaya_pemeriksaan" class="form-control"
                                    value="{{ old("biaya_pemeriksaan", $pemeriksaan->biaya_pemeriksaan) }}">
                            </div>
                        </div>

                        <hr>
                        <h5>Resep Obat</h5>
                        <div id="rx-container">
                            @php $idx = 0; @endphp
                            @forelse($resep as $r)
                                <div class="rx-item">
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger rx-delete"><i
                                                class="fas fa-trash"></i> Hapus</button>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="obat-{{ $idx }}">Obat</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" id="obat-{{ $idx }}"
                                                name="obat[]">
                                                <option value="" hidden>Pilih Obat</option>
                                                @foreach ($obat as $o)
                                                    <option value="{{ $o->id }}"
                                                        {{ $o->id == $r->obat_id ? "selected" : "" }}>{{ $o->nama_obat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"
                                            for="jumlah-{{ $idx }}">Jumlah</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="jumlah-{{ $idx }}"
                                                name="jumlah[]" value="{{ $r->jumlah }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"
                                            for="ket-{{ $idx }}">Keterangan</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="ket-{{ $idx }}" name="keterangan[]" rows="3">{{ $r->keterangan }}</textarea>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                @php $idx++; @endphp
                            @empty
                                <div class="rx-item">
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger rx-delete"><i
                                                class="fas fa-trash"></i> Hapus</button>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="obat-0">Obat</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" id="obat-0" name="obat[]">
                                                <option value="" hidden>Pilih Obat</option>
                                                @foreach ($obat as $o)
                                                    <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="jumlah-0">Jumlah</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="jumlah-0" name="jumlah[]"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="ket-0">Keterangan</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="ket-0" name="keterangan[]" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endforelse
                        </div>

                        <div class="form-group">
                            <button type="button" id="rx-add" class="btn btn-info mb-3"><i class="fas fa-plus"></i>
                                Tambah Resep Obat</button>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route("riwayat-pemeriksaan.index") }}" class="btn btn-secondary ml-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("script")
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('rx-container');
            const addBtn = document.getElementById('rx-add');

            // init select2 yang belum ter-init
            if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                $(container).find('select.select2').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2({
                            width: '100%'
                        });
                    }
                });
            }

            addBtn.addEventListener('click', function() {
                const count = container.querySelectorAll('.rx-item').length;
                const wrap = document.createElement('div');
                wrap.innerHTML = `
        <div class="rx-item">
          <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-sm btn-danger rx-delete"><i class="fas fa-trash"></i> Hapus</button>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="obat-${count}">Obat</label>
            <div class="col-sm-9">
              <select class="form-control select2" id="obat-${count}" name="obat[]">
                <option value="" hidden>Pilih Obat</option>
                @foreach ($obat as $o)
                  <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="jumlah-${count}">Jumlah</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="jumlah-${count}" name="jumlah[]" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="ket-${count}">Keterangan</label>
            <div class="col-sm-9">
              <textarea class="form-control" id="ket-${count}" name="keterangan[]" rows="3"></textarea>
            </div>
          </div>
          <hr>
        </div>`;

                const item = wrap.firstElementChild;
                container.appendChild(item);

                if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                    $(item).find('select.select2').select2({
                        width: '100%'
                    });
                }
            });

            container.addEventListener('click', function(e) {
                const btn = e.target.closest('.rx-delete');
                if (!btn) return;
                const item = btn.closest('.rx-item');
                const items = container.querySelectorAll('.rx-item');

                if (items.length <= 1) {
                    if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                        $(item).find('select.select2').each(function() {
                            if ($(this).hasClass('select2-hidden-accessible')) {
                                $(this).select2('destroy');
                            }
                        });
                    }
                    item.querySelectorAll('select').forEach(s => s.value = '');
                    item.querySelectorAll('input').forEach(i => i.value = '');
                    item.querySelectorAll('textarea').forEach(t => t.value = '');
                    if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                        $(item).find('select.select2').select2({
                            width: '100%'
                        });
                    }
                    return;
                }

                if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                    $(item).find('select.select2').each(function() {
                        if ($(this).hasClass('select2-hidden-accessible')) {
                            $(this).select2('destroy');
                        }
                    });
                }
                item.remove();
            });
        });
    </script>
@endpush
