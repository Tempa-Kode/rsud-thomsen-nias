<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran</title>
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
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 15px;
        }

        .patient-info {
            margin: 20px 0;
        }

        .info-row {
            display: flex;
            margin-bottom: 4px;
        }

        .info-label {
            width: 180px;
            display: inline-block;
        }

        .info-separator {
            width: 20px;
            text-align: center;
        }

        .info-value {
            flex: 1;
        }

        .medicine-section {
            margin: 20px 0;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .medicine-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .medicine-table th,
        .medicine-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .medicine-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .medicine-table .center {
            text-align: center;
        }

        .medicine-table .right {
            text-align: right;
        }

        .subtotal-row {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .status-section {
            margin-top: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .footer-info {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
            padding-top: 5px;
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

    <div style="border-top: 3px solid black; margin: 10px 0;"></div>

    <div class="patient-info">
        <div class="info-row">
            <span class="info-label">Tanggal Kunjungan</span>
            <span class="info-separator">:</span>
            <span
                class="info-value">{{ \Carbon\Carbon::parse($pembayaran->rawatJalan->tanggal_kunjungan)->format("d-m-Y") }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Nama Pasien</span>
            <span class="info-separator">:</span>
            <span class="info-value">{{ $pembayaran->rawatJalan->pasien->nama }}</span>
        </div>
        @if ($pembayaran->rawatJalan->pasien->nik)
            <div class="info-row">
                <span class="info-label">NIK</span>
                <span class="info-separator">:</span>
                <span class="info-value">{{ $pembayaran->rawatJalan->pasien->nik }}</span>
            </div>
        @endif
        @if ($pembayaran->rawatJalan->pasien->no_bpjs)
            <div class="info-row">
                <span class="info-label">No. BPJS</span>
                <span class="info-separator">:</span>
                <span class="info-value">{{ $pembayaran->rawatJalan->pasien->no_bpjs }}</span>
            </div>
        @endif
        <div class="info-row">
            <span class="info-label">Jenis Kelamin</span>
            <span class="info-separator">:</span>
            <span
                class="info-value">{{ $pembayaran->rawatJalan->pasien->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan" }}</span>
        </div>
        @if ($pembayaran->rawatJalan->pasien->tanggal_lahir)
            <div class="info-row">
                <span class="info-label">Tanggal Lahir / Umur</span>
                <span class="info-separator">:</span>
                <span
                    class="info-value">{{ \Carbon\Carbon::parse($pembayaran->rawatJalan->pasien->tanggal_lahir)->format("d-m-Y") }}
                    / {{ \Carbon\Carbon::parse($pembayaran->rawatJalan->pasien->tanggal_lahir)->age }} Tahun</span>
            </div>
        @endif
        @if ($pembayaran->rawatJalan->pasien->alamat)
            <div class="info-row">
                <span class="info-label">Alamat</span>
                <span class="info-separator">:</span>
                <span class="info-value">{{ $pembayaran->rawatJalan->pasien->alamat }}</span>
            </div>
        @endif
        <div class="info-row">
            <span class="info-label">Poli</span>
            <span class="info-separator">:</span>
            <span class="info-value">{{ $pembayaran->rawatJalan->poli->nama_poli }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Dokter</span>
            <span class="info-separator">:</span>
            <span class="info-value">{{ $pembayaran->rawatJalan->dokter->nama }}</span>
        </div>
        @if ($pembayaran->rawatJalan->riwayatPemeriksaan)
            <div class="info-row">
                <span class="info-label">Diagnosa</span>
                <span class="info-separator">:</span>
                <span class="info-value">{{ $pembayaran->rawatJalan->riwayatPemeriksaan->diagnosa ?? "-" }}</span>
            </div>
        @endif
    </div>

    @if ($pembayaran->rawatJalan->resepObat->count() > 0)
        <div class="medicine-section">
            <div class="section-title">Rincian Obat</div>

            <table class="medicine-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Obat</th>
                        <th width="15%">Jenis</th>
                        <th width="20%">Aturan Pakai</th>
                        <th width="10%">Harga</th>
                        <th width="8%">Qty</th>
                        <th width="17%">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalObat = 0;
                    @endphp
                    @foreach ($pembayaran->rawatJalan->resepObat as $index => $resep)
                        @php
                            $hargaObat = $resep->obat->harga ?? 0;
                            $jumlah = $resep->jumlah ?? 1;
                            $subtotal = $hargaObat * $jumlah;
                            $totalObat += $subtotal;
                        @endphp
                        <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td>{{ $resep->obat->nama_obat ?? "-" }}</td>
                            <td>{{ $resep->obat->jenis_obat ?? "-" }}</td>
                            <td>{{ $resep->aturan_pakai ?? "-" }}</td>
                            <td class="right">{{ number_format($hargaObat, 0, ",", ".") }}</td>
                            <td class="center">{{ $jumlah }}</td>
                            <td class="right">{{ number_format($subtotal, 0, ",", ".") }}</td>
                        </tr>
                    @endforeach
                    <tr class="subtotal-row">
                        <td colspan="6" class="right"><strong>Total Obat</strong></td>
                        <td class="right"><strong>{{ number_format($totalObat, 0, ",", ".") }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    <div class="status-section">
        <div style="margin-bottom: 10px;">Status Pasien:
            {{ $pembayaran->rawatJalan->pasien->no_bpjs ? "BPJS" : "Non BPJS" }}</div>
        <div style="margin-bottom: 10px;">Status Pembayaran: {{ ucfirst(str_replace("_", " ", $pembayaran->status)) }}
        </div>
        <div style="font-size: 16px; border-top: 2px solid #000; padding-top: 10px; margin-top: 15px;">
            <strong>GRAND TOTAL: Rp {{ number_format($pembayaran->grand_total, 0, ",", ".") }}</strong>
        </div>
    </div>

    <div class="footer-info">
        <div>
            <div><strong>Tanggal Cetak:</strong></div>
            <div>{{ \Carbon\Carbon::now()->format("d-m-Y H:i:s") }}</div>
        </div>
    </div>
</body>

</html>
