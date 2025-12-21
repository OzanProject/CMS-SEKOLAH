@extends('layouts.admin')

@section('header', 'Data Pendaftar PPDB')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pendaftar Masuk</h3>
        <div class="card-tools">
            <a href="{{ route('admin.ppdb.exportPdf') }}" class="btn btn-tool text-danger" title="Export PDF" target="_blank">
                <i class="fas fa-file-pdf"></i> Export Laporan PDF
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>No. Daftar</th>
                    <th>Nama & NISN</th>
                    <th>Asal Sekolah</th>
                    <th>Status</th>
                    <th>Berkas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrants as $reg)
                <tr>
                    <td class="font-weight-bold">
                        {{ $reg->nomor_pendaftaran }}
                    </td>
                    <td>
                        <strong>{{ $reg->nama_lengkap }}</strong><br>
                        <small class="text-muted">{{ $reg->nisn }}</small>
                    </td>
                    <td>
                        {{ $reg->asal_sekolah }}
                    </td>
                    <td>
                        <span class="badge {{ $reg->status === 'diterima' ? 'badge-success' : ($reg->status === 'ditolak' ? 'badge-danger' : 'badge-warning') }}">
                            {{ ucfirst($reg->status) }}
                        </span>
                    </td>
                    <td>
                         @if($reg->file_kk) <a href="{{ asset('storage/'.$reg->file_kk) }}" target="_blank" class="text-info"><i class="fas fa-file-alt"></i> KK</a> @endif
                         @if($reg->file_akta) <a href="{{ asset('storage/'.$reg->file_akta) }}" target="_blank" class="text-info ml-2"><i class="fas fa-file-alt"></i> Akta</a> @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.ppdb.show', $reg->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" onclick="confirmStatus('{{ $reg->id }}', 'diterima')" title="Terima">
                            <i class="fas fa-check"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmStatus('{{ $reg->id }}', 'ditolak')" title="Tolak">
                            <i class="fas fa-times"></i>
                        </button>
                        <form action="{{ route('admin.ppdb.destroy', $reg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data pendaftar ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-warning" title="Hapus Data">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $registrants->links() }}
    </div>
</div>
@endsection

@push('scripts')
<!-- Hidden Generic Form -->
<form id="statusForm" method="POST" style="display: none;">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" id="inputStatus">
    <input type="hidden" name="catatan" id="inputCatatan">
</form>

<script>
    function confirmStatus(id, status) {
        let url = "{{ route('admin.ppdb.updateStatus', ':id') }}";
        url = url.replace(':id', id);

        let title = status === 'diterima' ? 'Terima Siswa?' : 'Tolak Siswa?';
        let text = status === 'diterima' ? 'Berikan catatan untuk siswa (opsional)' : 'Wajib berikan alasan penolakan!';
        let placeholder = status === 'diterima' ? 'Selamat! Anda diterima...' : 'Maaf, nilai anda kurang...';

        Swal.fire({
            title: title,
            input: 'textarea',
            inputLabel: text,
            inputPlaceholder: placeholder,
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            preConfirm: (note) => {
                if (status === 'ditolak' && !note) {
                    Swal.showValidationMessage('Alasan penolakan wajib diisi!')
                }
                return note;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('statusForm');
                form.action = url;
                document.getElementById('inputStatus').value = status;
                document.getElementById('inputCatatan').value = result.value;
                form.submit();
            }
        });
    }
</script>
@endpush
