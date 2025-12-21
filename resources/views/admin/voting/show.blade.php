@extends('layouts.admin')

@section('header', 'Kelola Event: ' . $event->title)

@section('content')
<div class="row">
    
    <!-- Candidates Section -->
    <div class="col-lg-5">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users"></i> Kandidat</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.voting.candidates.store', ['event' => $event->id]) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <h5>Tambah Kandidat</h5>
                    <div class="row">
                        <div class="col-8">
                            <input type="text" name="name" class="form-control mb-2" placeholder="Nama Kandidat" required>
                        </div>
                        <div class="col-4">
                            <input type="number" name="nomor_urut" class="form-control mb-2" placeholder="No. Urut" required>
                        </div>
                    </div>
                    <div class="custom-file mb-2">
                         <input type="file" name="photo" class="custom-file-input">
                         <label class="custom-file-label">Foto Kandidat</label>
                    </div>
                    <textarea name="visi" class="form-control mb-2" placeholder="Visi" rows="2"></textarea>
                    <textarea name="misi" class="form-control mb-2" placeholder="Misi" rows="2"></textarea>
                    <button type="submit" class="btn btn-primary btn-block">Tambah Kandidat</button>
                </form>

                <hr>

                <div class="list-group list-group-flush">
                    @foreach($event->candidates as $candidate)
                    <div class="list-group-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            @if($candidate->photo)
                                <img src="{{ asset('storage/'.$candidate->photo) }}" class="img-circle elevation-2 mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="btn btn-secondary btn-circle mr-3" style="width: 50px; height: 50px; border-radius: 50%; line-height: 35px; text-align: center; font-size: 20px;">
                                    {{ $candidate->nomor_urut }}
                                </div>
                            @endif
                            <div>
                                <h5 class="mb-0">{{ $candidate->name }}</h5>
                                <small class="text-muted">No. Urut: {{ $candidate->nomor_urut }}</small>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="btn btn-sm btn-info" title="Lihat"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kandidat ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Tokens Section -->
    <div class="col-lg-7">
        <div class="card card-warning card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fas fa-key"></i> DPT & Token Pemilih</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.voting.tokens.export', $event->id) }}" class="btn btn-sm btn-info mr-2" target="_blank">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    @if($event->tokens()->count() > 0)
                    <form action="{{ route('admin.voting.tokens.reset', ['event' => $event->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus SEMUA token? Data tidak bisa dikembalikan!');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Reset</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <!-- Stats -->
                <div class="row text-center mb-3">
                    <div class="col-4">
                        <h3>{{ $event->tokens()->count() }}</h3>
                        <span class="text-muted">Total DPT</span>
                    </div>
                    <div class="col-4">
                        <h3 class="text-success">{{ $event->tokens()->where('is_used', true)->count() }}</h3>
                        <span class="text-muted">Sudah Memilih</span>
                    </div>
                    <div class="col-4">
                        <h3 class="text-danger">{{ $event->tokens()->where('is_used', false)->count() }}</h3>
                        <span class="text-muted">Belum Memilih</span>
                    </div>
                </div>
                
                <!-- Detailed Breakdown & Filter -->
                <div class="row text-center mb-4 border-top pt-3">
                   <div class="col-3">
                        <a href="{{ route('admin.voting.show', $event->id) }}" class="text-decoration-none text-dark">
                            <h5 class="font-weight-bold">{{ $event->tokens()->count() }}</h5>
                            <span class="badge badge-light">Semua</span>
                        </a>
                   </div>
                   <div class="col-3">
                        <a href="{{ route('admin.voting.show', ['voting' => $event->id, 'type' => 'siswa']) }}" class="text-decoration-none text-dark">
                            <h5 class="text-info font-weight-bold">{{ $event->tokens()->where('type', 'siswa')->count() }}</h5>
                            <span class="badge badge-info">Siswa</span>
                        </a>
                   </div>
                   <div class="col-3">
                        <a href="{{ route('admin.voting.show', ['voting' => $event->id, 'type' => 'guru']) }}" class="text-decoration-none text-dark">
                             <h5 class="text-warning font-weight-bold">{{ $event->tokens()->where('type', 'guru')->count() }}</h5>
                             <span class="badge badge-warning">Guru</span>
                        </a>
                   </div>
                   <div class="col-3">
                        <a href="{{ route('admin.voting.show', ['voting' => $event->id, 'type' => 'panitia']) }}" class="text-decoration-none text-dark">
                            <h5 class="text-secondary font-weight-bold">{{ $event->tokens()->where('type', 'panitia')->count() }}</h5>
                            <span class="badge badge-secondary">Panitia</span>
                        </a>
                   </div>
                </div>

                <!-- Generate Form -->
                <form action="{{ route('admin.voting.tokens.generate', ['event' => $event->id]) }}" method="POST" class="mb-4 bg-light p-3 rounded border">
                    @csrf
                    <label>Generate Token Baru (Tambah DPT)</label>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="small text-muted">Opsi 1: Input Jumlah (Manual)</label>
                                <input type="number" name="count" class="form-control" placeholder="Contoh: 10">
                            </div>
                        </div>
                        <div class="col-md-2 text-center py-4 text-muted">
                            <small>ATAU</small>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="small text-muted">Opsi 2: Ambil dari Data Master</label>
                                <select name="classroom_id" class="form-control">
                                    <option value="">-- Pilih Sumber Data --</option>
                                    <option value="committee_all" class="font-weight-bold text-success">DATA MASTER PANITIA (Semua Panitia)</option>
                                    <option value="teacher_all" class="font-weight-bold text-primary">DATA MASTER GURU (Semua Guru)</option>
                                    <optgroup label="DATA MASTER SISWA (Per Kelas)">
                                        @foreach($classrooms as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }} ({{ $class->students_count }})</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                         <label class="small text-muted">Tipe Pemilih</label>
                         <div class="d-flex">
                             <div class="custom-control custom-radio mr-3">
                                <input class="custom-control-input" type="radio" id="typeSiswa" name="type" value="siswa" checked>
                                <label for="typeSiswa" class="custom-control-label">Siswa</label>
                             </div>
                             <div class="custom-control custom-radio mr-3">
                                <input class="custom-control-input" type="radio" id="typeGuru" name="type" value="guru">
                                <label for="typeGuru" class="custom-control-label">Guru</label>
                             </div>
                             <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="typePanitia" name="type" value="panitia">
                                <label for="typePanitia" class="custom-control-label">Panitia</label>
                             </div>
                         </div>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block font-weight-bold">Generate Token</button>
                </form>

                <!-- Token Table -->
                <label>Daftar Token</label>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Token</th>
                                <th>Nama Siswa / Pemilik</th>
                                <th>Kelas / Tipe</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tokens as $index => $token)
                            <tr>
                                <td>{{ $tokens->firstItem() + $index }}</td>
                                <td class="font-weight-bold font-monospace text-primary" style="font-family: monospace; font-size: 1.1em;">
                                    {{ $token->token }}
                                </td>
                                <td>{{ $token->name ?? '-' }}</td>
                                <td>
                                    @if($token->class_name)
                                        <span class="badge badge-info">{{ $token->class_name }}</span>
                                    @else
                                        {{ ucfirst($token->type) }}
                                    @endif
                                </td>
                                <td>
                                    @if($token->is_used)
                                        <span class="badge badge-success">Sudah Memilih</span>
                                        <small class="d-block text-muted">{{ $token->used_at ? $token->used_at->format('H:i') : '' }}</small>
                                    @else
                                        <span class="badge badge-secondary">Belum</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada token digenerate.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $tokens->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
