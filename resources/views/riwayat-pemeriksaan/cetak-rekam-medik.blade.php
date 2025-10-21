<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medik - {{ $pasien?->nama ?? 'Pasien' }}</title>
    <style>
        @media print {
            @page {
                margin: 1cm;
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background-color: white;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }
        .logo {
            width: 80px;
            height: 80px;
        }
        .header-text {
            font-weight: bold;
            font-size: 14px;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
            color: #2c5f2d;
        }

        .patient-info {
            margin-bottom: 30px;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
            align-items: flex-start;
        }

        .info-label {
            width: 150px;
            font-weight: normal;
            color: #555;
        }

        .info-colon {
            width: 20px;
            text-align: center;
        }

        .info-value {
            flex: 1;
            font-weight: normal;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin: 25px 0 15px 0;
            color: #2c5f2d;
        }

        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .riwayat-table th,
        .riwayat-table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .riwayat-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .riwayat-table td:first-child {
            text-align: center;
            width: 40px;
        }

        .riwayat-table td:nth-child(2) {
            width: 100px;
            text-align: center;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
            padding: 20px;
        }

        .logo-placeholder {
            width: 80px;
            height: 80px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
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

    <div class="title">RIWAYAT REKAM MEDIK</div>

    @php
        $pasien = $riwayat->first()?->rawatJalan?->pasien;
        $firstRawatJalan = $riwayat->first()?->rawatJalan;
    @endphp

    <div class="patient-info">
        <table>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $pasien?->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td>:</td>
                <td>{{ $pasien?->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat Lahir / Tgl Lahir</td>
                <td>:</td>
                <td>
                    {{ $pasien?->tempat_lahir ?? '-' }}
                    {{ $pasien?->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>
                    @if($pasien?->jenis_kelamin == 'L')
                        Laki-laki
                    @elseif($pasien?->jenis_kelamin == 'P')
                        Perempuan
                    @else
                        {{ $pasien?->jenis_kelamin ?? '-' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $pasien?->alamat ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="section-title">Riwayat Pemeriksaan</div>

    @if($riwayat && $riwayat->count() > 0)
        <table class="riwayat-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Rekam Medik</th>
                    <th>Tanggal</th>
                    <th>Penyakit</th>
                    <th>Diagnosa</th>
                    <th>Nama Dokter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayat as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->rawatJalan->nomor_rekam_medik ?? '-' }}</td>
                    <td>
                        {{ $item->rawatJalan->tanggal_kunjungan ? \Carbon\Carbon::parse($item->rawatJalan->tanggal_kunjungan)->format('d-m-Y') : '-' }}
                    </td>
                    <td>{{ $item->penyakit ?? '-' }}</td>
                    <td>{{ $item->diagnosa ?? '-' }}</td>
                    <td>{{ $item->rawatJalan->dokter->nama ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Tidak ada riwayat pemeriksaan yang ditemukan.
        </div>
    @endif

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // };
    </script>
</body>
</html>
