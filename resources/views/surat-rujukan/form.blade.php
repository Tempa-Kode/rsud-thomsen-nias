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
                                <select class="form-control select2" name="tujuan" id="tujuan">
                                </select>
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

@push('script')
    <script>
        // Pastikan DOM sudah dimuat sepenuhnya
        document.addEventListener("DOMContentLoaded", function() {

            const selectTujuan = document.getElementById('tujuan');
            const inputAlamat = document.getElementById('alamat_tujuan');

            // Simpan data RS dalam variabel agar mudah diakses
            let dataRumahSakit = [];

            // 1. Fungsi untuk mengambil data dari API (via server Laravel kita)
            async function fetchRumahSakit() {
                try {
                    // Panggil route yang sudah kita buat di Laravel
                    const response = await fetch("{{ url('/api/get-rumah-sakit') }}");

                    if (!response.ok) {
                        throw new Error('Gagal mengambil data Faskes');
                    }

                    const result = await response.json();

                    // Simpan data ke variabel
                    dataRumahSakit = result.data || [];

                    // 2. Panggil fungsi untuk mengisi dropdown
                    populateDropdown();

                } catch (error) {
                    console.error(error);
                    // Tampilkan error di dropdown
                    selectTujuan.innerHTML = '<option value="">Gagal memuat data</option>';
                }
            }

            // 2. Fungsi untuk mengisi dropdown
            function populateDropdown() {
                // Kosongkan opsi 'RS 1, RS 2' yang lama
                selectTujuan.innerHTML = '';

                // Tambahkan opsi default
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = '-- Pilih Tujuan Rujukan --';
                selectTujuan.appendChild(defaultOption);

                // Isi dropdown dengan data dari API
                dataRumahSakit.forEach(rs => {
                    const option = document.createElement('option');
                    option.value = rs.nama; // Gunakan 'nama' sebagai value
                    option.textContent = rs.nama; // Teks yang ditampilkan

                    // SIMPAN ALAMAT di data attribute
                    // Ini adalah kunci untuk mengambil alamat nanti
                    option.setAttribute('data-alamat', rs.alamat);

                    selectTujuan.appendChild(option);
                });
            }

            // 3. Tambahkan event listener untuk 'change' pada dropdown
            $('#tujuan').on('select2:select', function(e) {
                // 'select2:select' adalah event khusus dari select2 saat memilih

                // Ambil data dari elemen <option> yang dipilih
                const selectedOptionElement = e.params.data.element;

                if (selectedOptionElement) {
                    // Ambil data-alamat yang kita simpan
                    // Kita pakai .attr() karena kita set via setAttribute
                    const alamat = $(selectedOptionElement).attr('data-alamat');

                    // Masukkan ke input
                    inputAlamat.value = alamat || '';
                } else {
                    inputAlamat.value = '';
                }
            });

            $('#tujuan').on('select2:unselect', function(e) {
                inputAlamat.value = '';
            });

            // Panggil fungsi utama saat halaman dimuat
            fetchRumahSakit();

        });
    </script>
@endpush
