@extends('layouts.admin')

@section('header', 'Profil Sekolah')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Profil Sekolah</h3>
            </div>
            <form action="{{ route('admin.school_profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="school_profile_image" class="col-sm-2 col-form-label">Foto Profil (Homepage)</label>
                        <div class="col-sm-10">
                            @if(isset($settings['school_profile_image']))
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$settings['school_profile_image']) }}" alt="Profile Image" style="height: 200px; object-fit: cover;" class="rounded shadow">
                                </div>
                            @endif
                            <div class="custom-file">
                                <input type="file" name="school_profile_image" class="custom-file-input" id="school_profile_image">
                                <label class="custom-file-label" for="school_profile_image">Upload Foto Baru (Gedung/Kegiatan)</label>
                            </div>
                            <small class="text-muted">Foto ini akan muncul di bagian "Tentang Kami" pada halaman depan.</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="school_description" class="col-sm-2 col-form-label">Deskripsi Sekolah</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="school_description" name="school_description" rows="4" placeholder="Jelaskan secara singkat tentang sekolah...">{{ $settings['school_description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="school_vision" class="col-sm-2 col-form-label">Visi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="school_vision" name="school_vision" rows="3" placeholder="Visi sekolah...">{{ $settings['school_vision'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="school_mission" class="col-sm-2 col-form-label">Misi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="school_mission" name="school_mission" rows="6" placeholder="Misi sekolah...">{{ $settings['school_mission'] ?? '' }}</textarea>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#school_description, #school_vision, #school_mission').summernote({
            height: 300,
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
@endsection
