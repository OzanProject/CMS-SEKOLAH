@extends('layouts.admin')

@section('header', 'Edit Iklan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Iklan</h3>
            </div>
            <form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Judul Iklan</label>
                        <input type="text" name="title" class="form-control" value="{{ $advertisement->title }}" required>
                    </div>

                    <div class="form-group">
                        <label>Posisi</label>
                        <select name="position" class="form-control">
                            <option value="header_top" {{ $advertisement->position == 'header_top' ? 'selected' : '' }}>Header Top (Atas Menu)</option>
                            <option value="header_logo_side" {{ $advertisement->position == 'header_logo_side' ? 'selected' : '' }}>Samping Logo (Banner Sekolah)</option>
                            <option value="home_top" {{ $advertisement->position == 'home_top' ? 'selected' : '' }}>Home Top (Bawah Banner)</option>
                             <option value="sidebar_right" {{ $advertisement->position == 'sidebar_right' ? 'selected' : '' }}>Sidebar Kanan</option>
                            <option value="article_bottom" {{ $advertisement->position == 'article_bottom' ? 'selected' : '' }}>Bawah Artikel</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tipe Iklan</label>
                        <select name="type" class="form-control" id="typeSelect">
                            <option value="image" {{ $advertisement->type == 'image' ? 'selected' : '' }}>Gambar (Banner)</option>
                            <option value="code" {{ $advertisement->type == 'code' || $advertisement->type == 'script' ? 'selected' : '' }}>Google AdSense / Script HTML</option>
                        </select>
                    </div>

                    <div id="imageInputGroup" style="{{ $advertisement->type == 'image' ? '' : 'display: none;' }}">
                         @if($advertisement->type == 'image' && $advertisement->value)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$advertisement->value) }}" alt="Current Image" style="height: 100px;">
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Upload Gambar (Biarkan kosong jika tidak ingin mengganti)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                    <label class="custom-file-label">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>URL Tujuan</label>
                            <input type="url" name="url" class="form-control" value="{{ $advertisement->url }}">
                        </div>
                    </div>

                    <div id="scriptInputGroup" style="{{ $advertisement->type != 'image' ? '' : 'display: none;' }}">
                        <div class="form-group">
                            <label>Kode Google AdSense / HTML</label>
                            <textarea name="value_script" class="form-control font-mono text-sm" rows="6">{{ $advertisement->type != 'image' ? $advertisement->value : '' }}</textarea>
                             <small class="text-muted">Paste kode AdSense atau script iklan lainnya disini.</small>
                        </div>
                    </div>

                     <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" {{ $advertisement->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Aktifkan Iklan</label>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Iklan</button>
                    <a href="{{ route('admin.advertisements.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();

        $('#typeSelect').change(function() {
            if ($(this).val() == 'image') {
                $('#imageInputGroup').show();
                $('#scriptInputGroup').hide();
            } else {
                $('#imageInputGroup').hide();
                $('#scriptInputGroup').show();
            }
        });
        
        // Initial state set by server-side blade logic, but triggering change ensures consistency if browser caches values
        // or if using old() inputs in case of validation error on update (though update validates differently usually)
    });
</script>
@endpush
@endsection
