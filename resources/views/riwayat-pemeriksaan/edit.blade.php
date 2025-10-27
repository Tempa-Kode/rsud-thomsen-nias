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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="rx-table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="35%">Obat</th>
                                        <th width="15%">Jumlah</th>
                                        <th width="35%">Keterangan</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="rx-container">
                                    @php $idx = 0; @endphp
                                    @forelse($resep as $r)
                                        <tr class="rx-item">
                                            <td class="text-center align-middle">{{ $idx + 1 }}</td>
                                            <td>
                                                <select class="form-control select2" id="obat-{{ $idx }}"
                                                    name="obat[]" style="width: 100%">
                                                    <option value="" hidden>Pilih Obat</option>
                                                    @foreach ($obat as $o)
                                                        <option value="{{ $o->id }}"
                                                            {{ $o->id == $r->obat_id ? "selected" : "" }}>
                                                            {{ $o->nama_obat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="jumlah-{{ $idx }}"
                                                    name="jumlah[]" value="{{ $r->jumlah }}" min="1">
                                            </td>
                                            <td>
                                                <textarea class="form-control" id="ket-{{ $idx }}" name="keterangan[]" rows="2">{{ $r->keterangan }}</textarea>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm btn-danger rx-delete"
                                                    title="Hapus item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @php $idx++; @endphp
                                    @empty
                                        <tr class="rx-item">
                                            <td class="text-center align-middle">1</td>
                                            <td>
                                                <select class="form-control select2" id="obat-0" name="obat[]"
                                                    style="width: 100%">
                                                    <option value="" hidden>Pilih Obat</option>
                                                    @foreach ($obat as $o)
                                                        <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="jumlah-0" name="jumlah[]"
                                                    value="" min="1">
                                            </td>
                                            <td>
                                                <textarea class="form-control" id="ket-0" name="keterangan[]" rows="2"></textarea>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm btn-danger rx-delete"
                                                    title="Hapus item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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

            // Fungsi untuk update nomor urut
            function updateRowNumbers() {
                const items = container.querySelectorAll('.rx-item');
                items.forEach((item, index) => {
                    const numberCell = item.querySelector('td:first-child');
                    if (numberCell) {
                        numberCell.textContent = index + 1;
                    }
                });
            }

            // init select2 yang belum ter-init
            if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                $(container).find('select.select2').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2({
                            width: '100%',
                            dropdownParent: $(this).parent()
                        });
                    }
                });
            }

            addBtn.addEventListener('click', function() {
                const count = container.querySelectorAll('.rx-item').length;
                const wrap = document.createElement('tbody');
                wrap.innerHTML = `
        <tr class="rx-item">
          <td class="text-center align-middle">1</td>
          <td>
            <select class="form-control select2" id="obat-${count}" name="obat[]" style="width: 100%">
              <option value="" hidden>Pilih Obat</option>
              @foreach ($obat as $o)
                <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
              @endforeach
            </select>
          </td>
          <td>
            <input type="number" class="form-control" id="jumlah-${count}" name="jumlah[]" value="" min="1">
          </td>
          <td>
            <textarea class="form-control" id="ket-${count}" name="keterangan[]" rows="2"></textarea>
          </td>
          <td class="text-center align-middle">
            <button type="button" class="btn btn-sm btn-danger rx-delete" title="Hapus item">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>`;

                const item = wrap.firstElementChild;

                // Bersihkan artefak select2 kalau ada
                item.querySelectorAll('.select2-container').forEach(el => el.remove());

                container.appendChild(item);

                // Update nomor urut
                updateRowNumbers();

                if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                    $(item).find('select.select2').select2({
                        width: '100%',
                        dropdownParent: $(item).find('select.select2').parent()
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
                            width: '100%',
                            dropdownParent: $(item).find('select.select2').parent()
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

                // Update nomor urut setelah hapus
                updateRowNumbers();
            });
        });
    </script>
@endpush
