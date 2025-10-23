<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Rawat Jalan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: none;
        }
        .header-table td {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }
        .header-text {
            font-weight: bold;
            font-size: 14px;
        }

        .title-section {
            /* border: 2px solid black; */
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .title-section h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-decoration: underline;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-data th,
        .table-data td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        .table-data th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-column {
            width: 40px;
            text-align: center;
        }

        .name-column {
            width: 120px;
        }

        .type-column {
            width: 100px;
        }

        .brand-column {
            width: 100px;
        }

        .usage-column {
            width: 150px;
        }

        .stock-column {
            width: 60px;
            text-align: center;
        }

        .price-column {
            width: 100px;
            text-align: right;
        }

        .satuan-column {
            width: 80px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header dengan Logo -->
    <table class="header-table">
        <tr>
            <td style="width: 20%;">
                <img src="{{ public_path('assets/img/logo/logo-nisbar.png') }}" width="80" alt="Logo Nias Barat">
            </td>
            <td style="width: 60%;" class="header-text">
                <div>PEMERINTAH KABUPATEN NIAS BARAT</div>
                <div>RUMAH SAKIT PRATAMA</div>
                {{-- <div>UPTD PUSKESMAS HILISALAWA'AHE</div> --}}
                <div style="font-size: 10px;">Jalan Budi Utomo - Lahomi Kode Pos 22863</div>
                <div style="font-size: 10px;">E-mail : rspratamaniasbarat@gmail.com</div>
            </td>
            <td style="width: 20%;">
                <img src="{{ public_path('assets/img/logo/kemenkes.png') }}" width="90" alt="Logo Kemenkes">
            </td>
        </tr>
    </table>

    <!-- Garis pemisah -->
    <div style="border-top: 3px solid black; margin: 10px 0;"></div>

    <!-- Judul Laporan -->
    <div class="title-section">
        <h2>LAPORAN RAWAT JALAN</h2>
    </div>

    <p>Periode : {{ $periode }}</p>
    <p>Poli : {{ $poli }}</p>

    <!-- Tabel Data Obat -->
    <table class="table-data">
        <thead>
            <tr>
                <th class="no-column">No</th>
                <th class="name-column">NIk</th>
                <th class="type-column">Pasien</th>
                <th class="brand-column">Poli</th>
                <th class="usage-column">Status</th>
                <th class="stock-column">Tanggal</th>
                <th class="price-column">Penyakit</th>
                <th class="satuan-column">Diagnosa</th>
                <th class="satuan-column">Biaya Pemeriksaan</th>
                <th class="satuan-column">Dokter</th>
                <th class="satuan-column">Grand Total</th>
            </tr>
        </thead>
        <tbody>
        @forelse($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->pasien->nik ?? '-' }}</td>
                <td>{{ $item->pasien->nama ?? '-' }}</td>
                <td>{{ $item->poli->nama_poli ?? '-' }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                <td>{{ $item->tanggal_kunjungan }}</td>
                <td>{{ $item->riwayatPemeriksaan->penyakit ?? '-' }}</td>
                <td>{{ $item->riwayatPemeriksaan->diagnosa ?? '-' }}</td>
                <td>Rp {{ number_format($item->riwayatPemeriksaan->biaya_pemeriksaan ?? 0, 0, ",", ".") }}</td>
                <td class="text-center">{{ $item->dokter->nama ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($item->pembayaran->grand_total ?? 0, 0, ",", ".") }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="text-center" style="padding: 20px; font-style: italic; color: #666;">
                    Tidak ada data rawat jalan yang tersedia
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Footer dengan informasi tanggal cetak -->
    <div style="margin-top: 30px; text-align: right; font-size: 11px;">
        <p>Dicetak pada: {{ date("d F Y H:i:s") }}</p>
        <p>Total Data: {{ count($data) }} data rawat jalan</p>
    </div>
</body>

</html>
