@extends("template")
@section("title", "Pembayaran")
@section("header", "Pembayaran")

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
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h4>Pembayaran</h4>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Poli</th>
                                    <th>No BPJS</th>
                                    <th>Nama Pasien</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    @if (Auth::user()->role == 'kasir')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->rawatJalan->tanggal_kunjungan }}</td>
                                        <td>{{ $item->rawatJalan->poli->nama_poli }}</td>
                                        <td>{{ $item->rawatJalan->pasien->no_bpjs ?? 'Non BPJS' }}</td>
                                        <td>{{ $item->rawatJalan->pasien->nama }}</td>
                                        <td>Rp. {{ number_format($item->grand_total, 0, ",", ".") }}</td>
                                        <td><span class="badge badge-{{ $item->status == 'Lunas' ? 'success' : 'warning' }}">{{ $item->status == 'lunas' ? 'Lunas' : 'Belum Lunas' }}</span></td>
                                        @if (Auth::user()->role == 'kasir')
                                            <td>
                                                @if ($item->status == 'belum_lunas')
                                                    <button type="button" class="btn btn-sm btn-success pembayaran" data-id="{{ $item->id }}">Pembayaran</button>
                                                @else
                                                    <span class="text-success">-</span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("script")
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $(".pembayaran").click(function(){
                let id = $(this).data("id");
                Swal.fire({
                    title: 'Konfirmasi Pembayaran',
                    text: "Apakah pembayaran ini sudah diterima?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Sudah!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `pembayaran/bayar/${id}`,
                            type: "PUT",
                            data: {
                                _method: "PUT",
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status === 'success') {
                                    Swal.fire(
                                        'Berhasil!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan pada server.',
                                    'error'
                                );
                            }
                        })
                    }
                })
            });
        });

    </script>
@endpush
