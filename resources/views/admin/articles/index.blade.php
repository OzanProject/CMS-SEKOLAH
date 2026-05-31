@extends('layouts.admin')

@section('header', 'Manajemen Artikel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Daftar Artikel & Berita</h3>
                <div class="d-flex align-items-center">
                    <form action="{{ route('admin.articles.index') }}" method="GET" class="mr-2 mb-0 d-flex align-items-center">
                        <select name="per_page" class="form-control form-control-sm mr-2" onchange="this.form.submit()" style="width: 70px;">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Cari Judul..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Tulis Artikel</span>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- Hidden Bulk Delete Form -->
            <form id="bulk-delete-form" action="{{ route('admin.articles.bulk_destroy') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="ids" id="bulk-ids">
            </form>

            <div class="card-body table-responsive p-0">
                <!-- Bulk Actions Toolbar -->
                <div class="px-3 py-2 bg-light border-bottom" id="bulk-actions" style="display: none;">
                    <button type="button" onclick="submitBulkDelete()" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash mr-1"></i> Hapus Terpilih (<span id="selected-count">0</span>)
                    </button>
                </div>

                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="check-all">
                                    <label for="check-all" class="custom-control-label"></label>
                                </div>
                            </th>
                            <th width="5%">No</th>
                            <th width="10%">Gambar</th>
                            <th>Judul & Info</th>
                            <th width="15%">Kategori</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input check-item" type="checkbox" value="{{ $article->id }}" id="check_{{ $article->id }}">
                                    <label for="check_{{ $article->id }}" class="custom-control-label"></label>
                                </div>
                            </td>
                            <td>{{ $loop->iteration + $articles->firstItem() - 1 }}</td>
                            <td>
                                @if($article->image)
                                    <img src="{{ asset('storage/'.$article->image) }}" alt="Thumb" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex justify-content-center align-items-center text-muted border rounded" style="width: 60px; height: 60px;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold text-wrap" style="max-width: 400px;">
                                    <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="text-dark">
                                        {{ $article->title }}
                                        @if($article->is_featured)
                                            <i class="fas fa-star text-warning ml-1" title="Featured / Headline"></i>
                                        @endif
                                        <i class="fas fa-external-link-alt text-xs text-muted ml-1"></i>
                                    </a>
                                </div>
                                <div class="text-muted small mt-1">
                                    <i class="far fa-clock mr-1"></i> {{ $article->created_at->format('d M Y H:i') }}
                                    <span class="mx-2">|</span>
                                    <i class="far fa-eye mr-1"></i> {{ number_format($article->views) }} Dilihat
                                </div>
                            </td>
                            <td>
                                @if($article->categoryRel)
                                    <span class="badge badge-info">{{ $article->categoryRel->name }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ $article->category ?? 'Umum' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($article->status === 'published')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle mr-1"></i> Published
                                    </span>
                                @elseif($article->status === 'draft')
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-edit mr-1"></i> Draft
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-archive mr-1"></i> Archived
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-info btn-sm mr-1" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm mr-1" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-newspaper fa-3x mb-3 text-gray-300"></i>
                                <p class="mb-0">Belum ada artikel yang ditulis.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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

                    window.submitBulkDelete = function() {
                        if (!confirm('Yakin ingin menghapus artikel yang dipilih?')) return;
                        
                        const selectedIds = Array.from(document.querySelectorAll('.check-item:checked')).map(cb => cb.value);
                        if (selectedIds.length === 0) return;

                        // Create hidden inputs for the form
                        const form = document.getElementById('bulk-delete-form');
                        // Remove existing hidden inputs to avoid duplication check
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
                <!-- Wait, I cannot wrap the table in a form if the rows contain forms.
                The rows contain specific delete forms.
                Standard workaround: 
                1. Make the bulk delete button external (already is).
                2. Use JS to gather IDs.
                3. Individual delete buttons simply submit their specific form.
                
                I will revert this tool call if I can, but I can't. I will execute a corrected version.
                Correct Logic:
                The UI needs checkboxes.
                The "Hapus Masal" button should be outside.
                JS will collect IDs and populate a hidden form.
                -->
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $articles->links() }}
                </div>
                <div class="text-muted small pt-2">
                    Menampilkan {{ $articles->firstItem() ?? 0 }} sampai {{ $articles->lastItem() ?? 0 }} dari {{ $articles->total() }} artikel
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
