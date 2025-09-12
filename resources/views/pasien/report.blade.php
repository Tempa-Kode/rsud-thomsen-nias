<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Pasien</title>
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
            text-align: center;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            width: 60px;
            height: 60px;
            border: 1px solid black;
            border-radius: 50%;
            display: inline-block;
            background-color: #dc3545;
            position: relative;
        }

        .logo-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 8px;
            text-align: center;
            font-weight: bold;
        }

        .medical-logo {
            width: 60px;
            height: 60px;
            border: 2px solid green;
            border-radius: 10px;
            display: inline-block;
            background-color: white;
            position: relative;
        }

        .medical-cross {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
        }

        .medical-cross::before,
        .medical-cross::after {
            content: '';
            position: absolute;
            background-color: green;
        }

        .medical-cross::before {
            width: 30px;
            height: 8px;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .medical-cross::after {
            width: 8px;
            height: 30px;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }

        .header-text {
            text-align: center;
            flex: 1;
            margin: 0 20px;
        }

        .header-text h1 {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            color: black;
        }

        .header-text p {
            font-size: 13px;
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
            font-size: 11px;
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
            width: 30px;
            text-align: center;
        }

        .nik-column {
            width: 100px;
        }

        .nama-column {
            width: 80px;
        }

        .jenis-column {
            width: 60px;
        }

        .tempat-column {
            width: 70px;
        }

        .tanggal-column {
            width: 80px;
        }

        .tinggi-column {
            width: 50px;
            text-align: center;
        }

        .berat-column {
            width: 50px;
            text-align: center;
        }

        .alamat-column {
            width: 120px;
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
        @php
            $title = request("bpjs") == "1" ? "LAPORAN PASIEN BPJS" : "LAPORAN PASIEN NON BPJS";
        @endphp
        <h2>{{ $title }}</h2>
    </div>

    <!-- Tabel Data Pasien -->
    <table>
        <thead>
            <tr>
                <th class="no-column">No</th>
                <th class="nik-column">NIK</th>
                <th class="nama-column">Nama Pasien</th>
                <th class="jenis-column">Jenis Kelamin</th>
                <th class="tempat-column">Tempat Lahir</th>
                <th class="tanggal-column">Tanggal Lahir</th>
                <th class="tinggi-column">Tinggi Badan</th>
                <th class="berat-column">Berat Badan</th>
                <th class="alamat-column">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pasien as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->nik ?? "-" }}</td>
                    <td>{{ $item->nama ?? "-" }}</td>
                    <td class="text-center">{{ $item->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan" }}</td>
                    <td>{{ $item->tempat_lahir ?? "-" }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format("d M Y") }}
                    </td>
                    <td class="text-center">{{ $item->tinggi_badan ?? "-" }} cm</td>
                    <td class="text-center">{{ $item->berat_badan ?? "-" }} kg</td>
                    <td>{{ $item->alamat ?? "-" }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px; font-style: italic; color: #666;">
                        Tidak ada data pasien yang tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer dengan informasi tanggal cetak -->
    <div style="margin-top: 30px; text-align: right; font-size: 11px;">
        <p>Dicetak pada: {{ date("d F Y H:i:s") }}</p>
        <p>Total Data: {{ count($pasien) }} pasien</p>
        @if (request("bpjs") == "1")
            <p>Status: Pasien BPJS</p>
        @else
            <p>Status: Pasien Non-BPJS</p>
        @endif
    </div>
</body>

</html>
