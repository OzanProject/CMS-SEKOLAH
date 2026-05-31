@extends('layouts.admin')

@section('header', 'Tulis Artikel Baru')

@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Left Column: Main Content -->
                <div class="col-md-9">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Konten Artikel</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Judul Artikel <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Masukkan judul artikel..." required>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Isi Konten <span class="text-danger">*</span></label>
                                <textarea name="content" class="form-control" id="content-editor" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="text-danger small mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Settings -->
                <div class="col-md-3">
                     <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="published" selected>Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Rilis (Opsional)</label>
                                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
                                <small class="text-muted">Kosongkan jika ingin diterbitkan sekarang.</small>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label for="is_featured" class="custom-control-label">Jadikan Headline / Featured</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control select2" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Gambar Utama</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                                <small class="text-muted">Max: 2MB. JPG/PNG.</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm">
                                <i class="fas fa-save mr-1"></i> Terbitkan
                            </button>
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-block mt-2">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#content-editor').summernote({
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        uploadImage(files[i], $(this));
                    }
                }
            }
        });
        
        bsCustomFileInput.init();

        // Custom Upload Function
        function uploadImage(file, editor) {
            var data = new FormData();
            data.append("upload", file);
            data.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('admin.upload') }}",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(response) {
                    if (response.uploaded) {
                        editor.summernote('insertImage', response.url);
                    } else {
                        alert('Gambar gagal diupload.');
                    }
                },
                error: function(data) {
                    console.log(data);
                    alert('Gagal mengupload gambar. Simpan dulu atau cek koneksi.');
                }
            });
        }
    });
</script>
@endpush
