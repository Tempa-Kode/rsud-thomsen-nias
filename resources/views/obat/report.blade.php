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

        .header {
            /* border: 3px solid black; */
            padding: 15px;
            margin-bottom: 20px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        .header-text {
            text-align: center;
            flex: 1;
            margin: 0 20px;
        }

        .header-text h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            color: black;
        }

        .header-text p {
            font-size: 14px;
            margin: 5px 0;
            color: black;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        th {
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
    <div class="header">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="text-align: center; border: none; vertical-align: middle;">
                    <h1 style="margin: 0; font-size: 22px; font-weight: bold;">RS UMUM Daerah dr. M. THOMSEN NIAS</h1>
                    <p style="margin: 5px 0; font-size: 13px;">
                        Jl. Dr. Cipto Mangunkusumo No.15, Kelurahan Pasar, Kec. Gunungsitoli, Kota Gunungsitoli, Sumatera Utara
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Garis pemisah -->
    <div style="border-top: 3px solid black; margin: 10px 0;"></div>

    <!-- Judul Laporan -->
    <div class="title-section">
        <h2>LAPORAN OBAT</h2>
    </div>

    <!-- Tabel Data Obat -->
    <table>
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
