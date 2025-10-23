<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Obat</title>
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
        <h2>LAPORAN OBAT</h2>
    </div>

    <!-- Tabel Data Obat -->
    <table class="table-data">
        <thead>
            <tr>
                <th class="no-column">No</th>
                <th class="name-column">Nama Obat</th>
                <th class="type-column">Jenis Obat</th>
                <th class="brand-column">Merek</th>
                <th class="usage-column">Aturan Pakai</th>
                <th class="stock-column">Stok</th>
                <th class="price-column">Harga</th>
                <th class="satuan-column">Satuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($obat as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_obat }}</td>
                    <td>{{ $item->jenis_obat }}</td>
                    <td>{{ $item->merk_obat }}</td>
                    <td>{{ $item->aturan_pakai }}</td>
                    <td class="text-center">{{ $item->stok }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga, 0, ",", ".") }}</td>
                    <td class="text-center">{{ $item->satuan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px; font-style: italic; color: #666;">
                        Tidak ada data obat yang tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer dengan informasi tanggal cetak -->
    <div style="margin-top: 30px; text-align: right; font-size: 11px;">
        <p>Dicetak pada: {{ date("d F Y H:i:s") }}</p>
        <p>Total Data: {{ count($obat) }} obat</p>
    </div>
</body>

</html>
