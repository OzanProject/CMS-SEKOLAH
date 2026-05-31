@extends('layouts.admin')

@section('header', 'Data Siswa')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Database Siswa</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-import">
                <i class="fas fa-file-excel"></i> Import Excel
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
                <div class="col-md-3">
                    <select name="classroom_id" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($classrooms as $class)
                            <option value="{{ $class->id }}" {{ request('classroom_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama / NISN..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Hidden Bulk Delete Form -->
        <form id="bulk-delete-form" action="{{ route('admin.students.bulk_destroy') }}" method="POST" style="display: none;">
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
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>L/P</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input check-item" type="checkbox" value="{{ $student->id }}" id="check_{{ $student->id }}">
                            <label for="check_{{ $student->id }}" class="custom-control-label"></label>
                        </div>
                    </td>
                    <td>{{ $students->firstItem() + $index }}</td>
                    <td>{{ $student->nisn }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->classroom->name ?? '-' }}</td>
                    <td>
                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Hapus data siswa ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
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
            {{ $students->withQueryString()->links() }}
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Import Data Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Kelas</label>
                        <select name="classroom_id" id="import_classroom_id" class="form-control" required>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Download Template</label><br>
                        <a href="{{ route('admin.students.template') }}" id="btn-download-template" class="btn btn-sm btn-info" target="_blank">
                            <i class="fas fa-file-excel"></i> Download Template Excel
                        </a>
                        <small class="form-text text-muted">Download template sesuai kelas yang dipilih di atas.</small>
                    </div>

                    <div class="form-group">
                        <label>File Excel (.xlsx)</label>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" required accept=".xlsx, .xls">
                            <label class="custom-file-label">Pilih File</label>
                        </div>
                        <small class="text-muted">Format Kolom: No, NISN, Nama Lengkap, L/P</small>
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
        // Bulk Delete Logic
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
        }

        window.submitBulkDelete = function() {
            if (!confirm('Yakin ingin menghapus siswa yang dipilih?')) return;
            
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

        // Existing Import Logic
        const selectClass = document.getElementById('import_classroom_id');
        const btnDownload = document.getElementById('btn-download-template');
        const baseUrl = "{{ route('admin.students.template') }}";

        function updateLink() {
            const classId = selectClass.value;
            btnDownload.href = baseUrl + '?classroom_id=' + classId;
        }

        // Init and Listener
        if(selectClass && btnDownload) {
             updateLink();
             selectClass.addEventListener('change', updateLink);
        }
    });
</script>
@endsection
