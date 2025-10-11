<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Rujukan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
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
                <div>DINAS KESEHATAN</div>
                <div>UPTD PUSKESMAS HILISALAWA'AHE</div>
                <div style="font-size: 10px;">Desa maluo Kecamatan Hilisalawa'ahe Kabupaten Nias Selatan Kode Pos 22864</div>
                <div style="font-size: 10px;">E-mail : hilisalawaahe@gmail.com</div>
            </td>
            <td style="width: 20%;">
                <img src="{{ public_path('assets/img/logo/kemenkes.png') }}" width="90" alt="Logo Kemenkes">
            </td>
        </tr>
    </table>

    <!-- Garis pemisah -->
    <div style="border-top: 3px solid black; margin: 10px 0;"></div>

    <!-- Informasi Surat -->
    <div style="text-align: right; margin-bottom: 20px;">
        <p>Onolimbu,
            @if($suratRujukan->tgl_surat)
                {{ \Carbon\Carbon::parse($suratRujukan->tgl_surat)->locale('id')->translatedFormat('d F Y') }}
            @else
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
            @endif
        </p>
    </div>

    <table style="margin-bottom: 20px; width: 100%; border: none;">
        <tr>
            <td style="width: 70%;">
                <table>
                    <tr>
                        <td>No</td>
                        <td>:</td>
                        <td>{{ $suratRujukan->no_surat }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Hal</td>
                        <td>:</td>
                        <td>Rujukan</td>
                    </tr>
                </table>
            </td>
            <td style="width: 30%; line-height: 18px;">
                <div>Kepada Yth,</div>
                <div>{{ $suratRujukan->tujuan }}</div>
                <div>di</div>
                <div style="margin-left: 25px">{{ $suratRujukan->alamat_tujuan }}</div>
            </td>
        </tr>
    </table>

    <!-- Data Pasien -->
    <div style="margin-left: 50px; margin-right: 50px;">
        <p>Bersama ini kami rujuk pasien dengan identitas :</p>

        <table style="width: 100%; border: none; margin-top: 10px;">
            <tr>
                <td style="width: 20%; padding: 3px; border: none;">Nama</td>
                <td style="width: 5%; padding: 3px; border: none;">:</td>
                <td style="padding: 3px; border: none; font-weight: bold; text-transform: uppercase;">
                    {{ $suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->nama ?? 'NAMA PASIEN' }}
                </td>
            </tr>
            <tr>
                <td style="padding: 3px; border: none;">Umur</td>
                <td style="padding: 3px; border: none;">:</td>
                <td style="padding: 3px; border: none;">
                    @if(isset($suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->tanggal_lahir))
                        {{ \Carbon\Carbon::parse($suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->tanggal_lahir)->age }} - Tahun
                    @else
                        - Tahun
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding: 3px; border: none;">Jenis Kelamin</td>
                <td style="padding: 3px; border: none;">:</td>
                <td style="padding: 3px; border: none;">{{ $suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td style="padding: 3px; border: none;">Agama</td>
                <td style="padding: 3px; border: none;">:</td>
                <td style="padding: 3px; border: none;">{{ $suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->agama }}</td>
            </tr>
            <tr>
                <td style="padding: 3px; border: none;">Pekerjaan</td>
                <td style="padding: 3px; border: none;">:</td>
                <td style="padding: 3px; border: none;">{{ $suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->pekerjaan }}</td>
            </tr>
            <tr>
                <td style="padding: 3px; border: none; vertical-align: top;">Alamat</td>
                <td style="padding: 3px; border: none; vertical-align: top;">:</td>
                <td style="padding: 3px; border: none;">
                    <div>{{ $suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->alamat }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Keluhan dan Pemeriksaan -->
    <div style="margin-left: 50px; margin-right: 50px;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 20%; padding: 3px; border: none; vertical-align: top;">Keluhan</td>
                <td style="width: 5%; padding: 3px; border: none; vertical-align: top;">:</td>
                <td style="padding: 3px; border: none;">
                    <div>{{ $suratRujukan->riwayatPemeriksaan->penyakit }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-left: 50px; margin-right: 50px;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 20%; padding: 3px; border: none;">Diagnosa</td>
                <td style="width: 5%; padding: 3px; border: none;">:</td>
                <td style="padding: 3px; border: none;">{{ $suratRujukan->riwayatPemeriksaan->diagnosa ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-left: 50px; margin-right: 50px;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 20%; padding: 3px; border: none;">Penyakit</td>
                <td style="width: 5%; padding: 3px; border: none;">:</td>
                <td style="padding: 3px; border: none;">{{ $suratRujukan->riwayatPemeriksaan->penyakit ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-bottom: 30px; margin-left: 50px; margin-right: 50px;">
        <p>Mohon konsultasi dan tindakan selanjutnya.</p>
        <p>Demikian surat kami ini, atas kerjasamanya yang baik kami ucapkan terimakasih.</p>
    </div>

    <!-- Tanda Tangan -->
    <div style="margin-top: 50px; margin-left:400px">
        <div style="margin-bottom: 70px;">Direktur RS Pratama Nias Barat</div>
        <div style="font-weight: bold; text-decoration: underline;">
            {{ 'dr. WIRASTO GULO. S.Ked' }}
        </div>
        <div>Penata xxxxxxxx</div>
        <div>NIP. xxxxxxxxx</div>
    </div>
</body>
</html>
