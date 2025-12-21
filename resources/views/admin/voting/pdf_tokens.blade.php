<!DOCTYPE html>
<html>
<head>
	<title>Daftar Token - {{ $event->title }}</title>
	<style>
		body { font-family: sans-serif; font-size: 12px; }
		table { width: 100%; border-collapse: collapse; margin-top: 20px; }
		th, td { border: 1px solid #000; padding: 5px; text-align: left; }
		th { background-color: #f2f2f2; }
		.header { text-align: center; margin-bottom: 20px; }
        .header h2, .header h3 { margin: 5px 0; }
        .badge-success { color: green; font-weight: bold; }
        .badge-secondary { color: red; font-weight: bold; }
	</style>
</head>
<body>
    @php
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
    @endphp

	<div class="header">
        <h3>{{ $settings['school_name'] ?? 'MyPortal Sekolah' }}</h3>
		<h2>Laporan Token E-Voting: {{ $event->title }}</h2>
		<p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
	</div>

	<table>
		<thead>
			<tr>
				<th style="width: 5%;">No</th>
				<th style="width: 15%;">Token</th>
				<th style="width: 30%;">Nama Siswa / Pemilik</th>
				<th style="width: 15%;">Kelas / Tipe</th>
				<th style="width: 20%;">Status</th>
                <th style="width: 15%;">Paraf</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tokens as $index => $token)
			<tr>
				<td style="text-align: center;">{{ $index + 1 }}</td>
				<td style="font-family: monospace; font-size: 14px; font-weight: bold;">{{ $token->token }}</td>
				<td>{{ $token->name ?? '-' }}</td>
				<td>
                    @if($token->class_name)
                        {{ $token->class_name }}
                    @else
                        {{ ucfirst($token->type) }}
                    @endif
                </td>
				<td>
                    @if($token->is_used)
                        <span class="badge-success">Sudah Memilih</span>
                    @else
                        <span class="badge-secondary">Belum</span>
                    @endif
                </td>
                <td></td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
