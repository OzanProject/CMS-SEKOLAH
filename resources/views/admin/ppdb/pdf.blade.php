<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Pendaftar PPDB</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
        }
        .header img {
            width: 80px;
            position: absolute;
            left: 0;
            top: 0;
        }
        .header h2, .header h3, .header p {
            margin: 0;
        }
        .header h2 {
            font-size: 16pt;
            text-transform: uppercase;
        }
        .header h3 {
            font-size: 14pt;
        }
        .header p {
            font-size: 10pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .status-diterima { color: green; font-weight: bold; }
        .status-ditolak { color: red; font-weight: bold; }
        .status-menunggu { color: orange; font-weight: bold; }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
            <!-- Note: DomPDF needs absolute path or base64. Using public_path helper is best -->
            <img src="{{ public_path('storage/'.$school_settings['school_logo']) }}" alt="Logo">
        @endif
        <h2>PEMERINTAH KABUPATEN {{ $school_settings['school_district'] ?? '[KABUPATEN]' }}</h2>
        <h3>DINAS PENDIDIKAN DAN KEBUDAYAAN</h3>
        <h2>{{ $school_settings['school_name'] ?? 'SEKOLAH MENENGAH PERTAMA' }}</h2>
        <p>{{ $school_settings['school_address'] ?? 'Alamat Sekolah' }}</p>
        <p>Email: {{ $school_settings['school_email'] ?? '-' }} | Telp: {{ $school_settings['school_phone'] ?? '-' }}</p>
    </div>

    <h3 style="text-align: center; margin-bottom: 20px;">LAPORAN DATA PENDAFTAR PPDB TAHUN {{ date('Y') }}</h3>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">NISN / NIK</th>
                <th width="15%">Nama Lengkap</th>
                <th width="3%">L/P</th>
                <th width="12%">TTL</th>
                <th width="20%">Alamat</th>
                <th width="15%">Orang Tua (Ayah/Ibu)</th>
                <th width="12%">No HP</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrants as $index => $reg)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>
                    {{ $reg->nisn }}<br>
                    <small>{{ $reg->nik }}</small>
                </td>
                <td>{{ $reg->nama_lengkap }}</td>
                <td style="text-align: center;">{{ $reg->jenis_kelamin }}</td>
                <td>
                    {{ $reg->tempat_lahir }}<br>
                    {{ $reg->tanggal_lahir->format('d/m/Y') }}
                </td>
                <td style="font-size: 9pt;">
                    {{ $reg->alamat }}<br>
                    RT {{ $reg->rt }}/RW {{ $reg->rw }}, {{ $reg->desa }}<br>
                    Kec. {{ $reg->kecamatan }}
                </td>
                <td style="font-size: 9pt;">
                    Ayah: {{ $reg->nama_ayah }}<br>
                    Ibu: {{ $reg->nama_ibu }}
                </td>
                <td>
                    {{ $reg->no_hp }}<br>
                    <small>Ortu: {{ $reg->no_hp_wali ?? '-' }}</small>
                </td>
                <td style="text-align: center;">
                    <span class="status-{{ $reg->status }}">{{ ucfirst($reg->status) }}</span>
                    @if($reg->catatan)
                        <br><small style="font-style: italic;">"{{ $reg->catatan }}"</small>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
        <br><br><br>
        <p><strong>{{ $school_settings['school_principal'] ?? 'Kepala Sekolah' }}</strong><br>
        NIP. {{ $school_settings['school_principal_nip'] ?? '-' }}</p>
    </div>
</body>
</html>
