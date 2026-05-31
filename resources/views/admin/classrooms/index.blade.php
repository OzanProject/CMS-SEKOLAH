@extends('layouts.admin')

@section('header', 'Data Kelas')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Kelas Baru</h3>
            </div>
            <form action="{{ route('admin.classrooms.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: 7A, 8B" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Kelas</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Daftar Kelas</h3>
                <div class="d-flex align-items-center">
                    <form action="{{ route('admin.classrooms.index') }}" method="GET" class="mb-0 d-flex align-items-center">
                        <select name="per_page" class="form-control form-control-sm mr-2" onchange="this.form.submit()" style="width: 70px;">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Cari..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Hidden Bulk Delete Form -->
            <form id="bulk-delete-form" action="{{ route('admin.classrooms.bulk_destroy') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="ids" id="bulk-ids">
            </form>
            <div class="px-3 py-2 bg-light border-bottom" id="bulk-actions" style="display: none;">
                <button type="button" onclick="submitBulkDelete()" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash mr-1"></i> Hapus Terpilih (<span id="selected-count">0</span>)
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="1%">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="check-all">
                                    <label for="check-all" class="custom-control-label"></label>
                                </div>
                            </th>
                            <th style="width: 10px">No</th>
                            <th>Nama Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classrooms as $index => $class)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input check-item" type="checkbox" value="{{ $class->id }}" id="check_{{ $class->id }}">
                                    <label for="check_{{ $class->id }}" class="custom-control-label"></label>
                                </div>
                            </td>
                            <td>{{ $loop->iteration + $classrooms->firstItem() - 1 }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->students_count }} Siswa</td>
                            <td>
                                <form action="{{ route('admin.classrooms.destroy', $class->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini? Siswa di dalamnya ikut terhapus!');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data kelas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $classrooms->links() }}
                </div>
                <div class="text-muted small pt-2">
                    Menampilkan {{ $classrooms->firstItem() ?? 0 }} sampai {{ $classrooms->lastItem() ?? 0 }} dari {{ $classrooms->total() }} data
                </div>
            </div>
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
            if (!confirm('Yakin ingin menghapus data yang dipilih?')) return;
            
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
