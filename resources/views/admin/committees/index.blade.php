@extends('layouts.admin')

@section('header', 'Data Panitia')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Database Panitia</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-import">
                <i class="fas fa-file-excel"></i> Import Excel
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                <i class="fas fa-plus"></i> Tambah Panitia
            </button>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <select name="per_page" class="form-control" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 Tampil</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 Tampil</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Tampil</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Tampil</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama / Jabatan..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Hidden Bulk Delete Form -->
        <form id="bulk-delete-form" action="{{ route('admin.committees.bulk_destroy') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="ids" id="bulk-ids">
        </form>

        <!-- Bulk Actions Toolbar -->
        <div class="px-3 py-2 bg-light border-bottom mb-2" id="bulk-actions" style="display: none;">
            <button type="button" onclick="submitBulkDelete()" class="btn btn-danger btn-sm">
                <i class="fas fa-trash mr-1"></i> Hapus Terpilih (<span id="selected-count">0</span>)
            </button>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="1%">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="check-all">
                            <label for="check-all" class="custom-control-label"></label>
                        </div>
                    </th>
                    <th style="width: 10px">No</th>
                    <th>Nama Lengkap</th>
                    <th>L/P</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($committees as $index => $committee)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input check-item" type="checkbox" value="{{ $committee->id }}" id="check_{{ $committee->id }}">
                            <label for="check_{{ $committee->id }}" class="custom-control-label"></label>
                        </div>
                    </td>
                    <td>{{ $committees->firstItem() + $index }}</td>
                    <td>{{ $committee->name }}</td>
                    <td>{{ $committee->gender }}</td>
                    <td>{{ $committee->position ?? '-' }}</td>
                    <td>
                        <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-edit-{{ $committee->id }}"><i class="fas fa-edit"></i></button>
                        <form action="{{ route('admin.committees.destroy', $committee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data panitia ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modal-edit-{{ $committee->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.committees.update', $committee->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Panitia</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="name" class="form-control" value="{{ $committee->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select name="gender" class="form-control" required>
                                                    <option value="L" {{ $committee->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="P" {{ $committee->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan (Opsional)</label>
                                                <input type="text" name="position" class="form-control" value="{{ $committee->position }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-3">
            {{ $committees->withQueryString()->links() }}
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.committees.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Panitia</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="gender" class="form-control" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jabatan (Opsional)</label>
                        <input type="text" name="position" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.committees.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Import Data Panitia</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Download Template</label><br>
                        <a href="{{ route('admin.committees.template') }}" class="btn btn-sm btn-info" target="_blank">
                            <i class="fas fa-file-excel"></i> Download Template Excel
                        </a>
                    </div>

                    <div class="form-group">
                        <label>File Excel (.xlsx)</label>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" required accept=".xlsx, .xls">
                            <label class="custom-file-label">Pilih File</label>
                        </div>
                        <small class="text-muted">Format Kolom: No, Nama Lengkap, L/P, Jabatan</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('check-all');
        const checkItems = document.querySelectorAll('.check-item');
        const bulkActions = document.getElementById('bulk-actions');
        const selectedCount = document.getElementById('selected-count');

        function updateBulkState() {
            const checkedCount = document.querySelectorAll('.check-item:checked').length;
            selectedCount.innerText = checkedCount;
            if (checkedCount > 0) {
                bulkActions.style.display = 'block';
            } else {
                bulkActions.style.display = 'none';
            }
        }

        if(checkAll) {
            checkAll.addEventListener('change', function() {
                checkItems.forEach(item => item.checked = this.checked);
                updateBulkState();
            });
        }

        checkItems.forEach(item => {
            item.addEventListener('change', function() {
                updateBulkState();
                if (!this.checked) {
                    checkAll.checked = false;
                } else {
                    const allChecked = document.querySelectorAll('.check-item:checked').length === checkItems.length;
                    checkAll.checked = allChecked;
                }
            });
        });

        window.submitBulkDelete = function() {
            if (!confirm('Yakin ingin menghapus panitia yang dipilih?')) return;
            
            const selectedIds = Array.from(document.querySelectorAll('.check-item:checked')).map(cb => cb.value);
            if (selectedIds.length === 0) return;

            const form = document.getElementById('bulk-delete-form');
            const existingInputs = form.querySelectorAll('input[name="ids[]"]');
            existingInputs.forEach(input => input.remove());

            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            form.submit();
        }
    });
</script>
@endsection
