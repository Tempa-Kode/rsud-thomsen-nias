@extends("template")
@section("title", "Pemeriksaan")
@section("header", "Pemeriksaan")

@section("body")
    <div class="row">
        <div class="col-12">
            @if (session("success"))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    <strong>Berhasil!</strong> {{ session("success") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="antrian" class="col-sm-3 col-form-label">No Antrian</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="antrian" value="{{ $data->nomor_antrian }}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="nik" value="{{ $data->pasien->nik }}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" value="{{ $data->pasien->nama }}"
                                readonly>
                        </div>
                    </div>
                    @if ($data->bpjs == true)
                        <div class="form-group row">
                            <label for="bpjs" class="col-sm-3 col-form-label">BPJS</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="bpjs"
                                    value="{{ $data->pasien->no_bpjs }}" readonly>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="dokter" class="col-sm-3 col-form-label">Dokter</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="dokter"
                                value="{{ $data->dokter->nama ?? "-" }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dokter" class="col-sm-3 col-form-label">Keluhan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="deskripsi_keluhan" id="deskripsi_keluhan" cols="30" rows="10" readonly>
                                {{ $data->deskripsi_keluhan ?? "-" }}
                            </textarea>
                        </div>
                    </div>
                    <hr>
                    <form action="{{ route('riwayat-pemeriksaan.simpanPeriksa', $data->id) }}" method="post">
                        @csrf
                        @method("POST")
                        <input type="hidden" name="rawat_jalan_id" value="{{ $data->id }}">
                        <div class="form-group row">
                            <label for="penyakit" class="col-sm-3 col-form-label">Penyakit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penyakit" name="penyakit"
                                    value="{{ old("penyakit") }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diagnosa" class="col-sm-3 col-form-label">Diagnosa</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="diagnosa" id="diagnosa" cols="30" rows="10" name="diagnosa">
                                    {{ old("diagnosa") }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="biaya_pemeriksaan" class="col-sm-3 col-form-label">Biaya Pemeriksaan</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="biaya_pemeriksaan" name="biaya_pemeriksaan"
                                    value="{{ old("biaya_pemeriksaan") }}">
                            </div>
                        </div>
                        <hr>
                        <h5>Resep Obat</h5>
                        <div id="prescription-container">
                            <div class="prescription-item">
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger delete-prescription"
                                        title="Hapus item">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <label for="obat-0" class="col-sm-3 col-form-label">Obat</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="obat[]" id="obat-0">
                                            <option value="" hidden>Pilih Obat</option>
                                            @foreach ($obat as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ in_array($item->id, old("obat", [])) ? "selected" : "" }}>
                                                    {{ $item->nama_obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah-0" class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="jumlah-0" name="jumlah[]"
                                            value="{{ old("jumlah.0") }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan-0" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="keterangan[]" id="keterangan-0" cols="30" rows="10">{{ trim(old("keterangan.0")) }}</textarea>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>

                        <!-- Template (clean) untuk item resep baru -->
                        <template id="prescription-item-template">
                            <div class="prescription-item">
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger delete-prescription"
                                        title="Hapus item">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <label for="obat-0" class="col-sm-3 col-form-label">Obat</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="obat[]" id="obat-0">
                                            <option value="" hidden>Pilih Obat</option>
                                            @foreach ($obat as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah-0" class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="jumlah-0" name="jumlah[]"
                                            value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan-0" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="keterangan[]" id="keterangan-0" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </template>

                        <div class="form-group">
                            <button type="button" id="add-prescription" class="btn btn-info mb-3">
                                <i class="fas fa-plus"></i> Tambah Resep Obat
                            </button>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100">Simpan Pemeriksaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("script")
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.getElementById('add-prescription');
            const container = document.getElementById('prescription-container');
            const tpl = document.getElementById('prescription-item-template');

            // Hitung item awal (sudah ada index 0)
            let count = container.querySelectorAll('.prescription-item').length;

            // Inisialisasi select2 pada item pertama bila belum
            if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                $(container).find('select.select2').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2({
                            width: '100%'
                        });
                    }
                });
            }

            addButton.addEventListener('click', function() {
                if (!tpl) return;

                // Buat node baru dari template yang bersih (tanpa artefak select2)
                const wrapper = document.createElement('div');
                wrapper.innerHTML = tpl.innerHTML.trim();
                const item = wrapper.firstElementChild; // .prescription-item

                // Bersihkan artefak select2 kalau ada (jaga-jaga)
                item.querySelectorAll('.select2-container').forEach(el => el.remove());

                const selects = item.querySelectorAll('select');
                const inputs = item.querySelectorAll('input');
                const textareas = item.querySelectorAll('textarea');

                // Update id/for dan kosongkan nilai
                selects.forEach(select => {
                    const oldId = select.id || `obat-${count}`;
                    const newId = oldId.replace(/\d+$/, count);
                    // hapus jejak select2 bila ada di template
                    select.classList.remove('select2-hidden-accessible');
                    select.removeAttribute('data-select2-id');
                    select.querySelectorAll('option').forEach(opt => opt.removeAttribute(
                        'data-select2-id'));

                    select.id = newId;
                    select.value = '';

                    const label = item.querySelector(`label[for="${oldId}"]`);
                    if (label) label.setAttribute('for', newId);
                });

                inputs.forEach(input => {
                    const oldId = input.id || `jumlah-${count}`;
                    const newId = oldId.replace(/\d+$/, count);
                    input.id = newId;
                    input.value = '';

                    const label = item.querySelector(`label[for="${oldId}"]`);
                    if (label) label.setAttribute('for', newId);
                });

                textareas.forEach(textarea => {
                    const oldId = textarea.id || `keterangan-${count}`;
                    const newId = oldId.replace(/\d+$/, count);
                    textarea.id = newId;
                    textarea.value = '';

                    const label = item.querySelector(`label[for="${oldId}"]`);
                    if (label) label.setAttribute('for', newId);
                });

                container.appendChild(item);

                // Inisialisasi Select2 hanya pada item baru
                if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                    $(item).find('select.select2').select2({
                        width: '100%'
                    });
                }

                count++;
            });

            // Delegasi: hapus item resep
            container.addEventListener('click', function(e) {
                const btn = e.target.closest('.delete-prescription');
                if (!btn) return;

                const item = btn.closest('.prescription-item');
                if (!item) return;

                const items = container.querySelectorAll('.prescription-item');
                // Jika hanya satu item, reset field saja
                if (items.length <= 1) {
                    // Destroy select2 sebelum reset
                    if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                        $(item).find('select.select2').each(function() {
                            if ($(this).hasClass('select2-hidden-accessible')) {
                                $(this).select2('destroy');
                            }
                        });
                    }
                    // Reset nilai
                    item.querySelectorAll('select').forEach(s => {
                        s.value = '';
                    });
                    item.querySelectorAll('input').forEach(i => {
                        i.value = '';
                    });
                    item.querySelectorAll('textarea').forEach(t => {
                        t.value = '';
                    });
                    // Re-init select2 setelah reset
                    if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                        $(item).find('select.select2').select2({
                            width: '100%'
                        });
                    }
                    return;
                }

                // Destroy select2 lalu hapus item
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
