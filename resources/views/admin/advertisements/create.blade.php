@extends('layouts.admin')

@section('header', 'Tambah Iklan Baru')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Iklan</h3>
            </div>
            <form action="{{ route('admin.advertisements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Judul Iklan</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Banner PPDB" required>
                    </div>

                    <div class="form-group">
                        <label>Posisi</label>
                        <select name="position" class="form-control">
                            <option value="header_top">Header Top (Atas Menu)</option>
                            <option value="header_logo_side">Samping Logo (Banner Sekolah)</option>
                            <option value="home_top">Home Top (Bawah Banner)</option>
                             <option value="sidebar_right">Sidebar Kanan</option>
                            <option value="article_bottom">Bawah Artikel</option>
                        </select>
                         <small class="text-muted">Pilih lokasi dimana iklan akan ditampilkan.</small>
                    </div>

                    <div class="form-group">
                        <label>Tipe Iklan</label>
                        <select name="type" class="form-control" id="typeSelect">
                            <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Gambar (Banner)</option>
                            <option value="code" {{ old('type') == 'code' ? 'selected' : '' }}>Google AdSense / Script HTML</option>
                        </select>
                    </div>

                    <div id="imageInputGroup">
                        <div class="form-group">
                            <label>Upload Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                    <label class="custom-file-label">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>URL Tujuan (Jika diklik)</label>
                            <input type="url" name="url" class="form-control" placeholder="https://...">
                        </div>
                    </div>

                    <div id="scriptInputGroup" style="display: none;">
                        <div class="form-group">
                            <label>Kode Google AdSense / HTML</label>
                            <textarea name="value_script" class="form-control font-mono text-sm" rows="6" placeholder="<script async src=...></script> (Paste kode AdSense Anda disini)"></textarea>
                            <small class="text-muted">Pastikan kode yang dimasukkan valid. Kode akan dieksekusi langsung di halaman publik.</small>
                        </div>
                    </div>

                     <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" checked>
                        <label class="form-check-label" for="isActive">Aktifkan Iklan</label>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Iklan</button>
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

        // Trigger change on load to handle old input or default state
        $('#typeSelect').trigger('change');
    });
</script>
@endpush
@endsection
