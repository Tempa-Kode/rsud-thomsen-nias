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
                        @if (Auth::user()->role == 'kasir')
                            <a href="" class="btn btn-primary">Tambah Pembayaran</a>
                        @endif
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection
