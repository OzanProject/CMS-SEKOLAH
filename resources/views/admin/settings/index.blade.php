@extends('layouts.admin')

@section('header', 'Pengaturan Sekolah')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Identitas Sekolah</h3>
            </div>
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" name="school_name" class="form-control" value="{{ $settings['school_name'] ?? '' }}" required>
                    </div>
                    
                     <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="school_address" class="form-control" value="{{ $settings['school_address'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Kabupaten / Kota</label>
                        <input type="text" name="school_district" class="form-control" value="{{ $settings['school_district'] ?? '' }}" placeholder="Contoh: BOGOR">
                        <small class="text-muted">Ditulis kapital, tanpa 'KABUPATEN' (akan otomatis ditambahkan di kop surat)</small>
                    </div>

                    <div class="form-group">
                        <label>Nama Kepala Sekolah</label>
                        <input type="text" name="school_principal" class="form-control" value="{{ $settings['school_principal'] ?? '' }}" placeholder="Nama beserta gelar">
                    </div>

                    <div class="form-group">
                        <label>NIP Kepala Sekolah</label>
                        <input type="text" name="school_principal_nip" class="form-control" value="{{ $settings['school_principal_nip'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="school_phone" class="form-control" value="{{ $settings['school_phone'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="school_email" class="form-control" value="{{ $settings['school_email'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Logo Sekolah</label>
                        @if(isset($settings['school_logo']))
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$settings['school_logo']) }}" alt="Logo" style="height: 80px;">
                            </div>
                        @endif
                        <div class="custom-file">
                             <input type="file" name="school_logo" class="custom-file-input">
                             <label class="custom-file-label">Upload Logo Baru</label>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
         <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Media Sosial</h3>
            </div>
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Instagram URL</label>
                        <input type="url" name="instagram_url" class="form-control" value="{{ $settings['instagram_url'] ?? '' }}" placeholder="https://instagram.com/...">
                    </div>
                    <div class="form-group">
                        <label>Facebook URL</label>
                        <input type="url" name="facebook_url" class="form-control" value="{{ $settings['facebook_url'] ?? '' }}" placeholder="https://facebook.com/...">
                    </div>
                    
                    <div class="form-group">
                        <label>Twitter / X URL</label>
                        <input type="url" name="twitter_url" class="form-control" value="{{ $settings['twitter_url'] ?? '' }}" placeholder="https://twitter.com/...">
                    </div>

                    <div class="form-group">
                        <label>YouTube Channel URL</label>
                        <input type="url" name="youtube_url" class="form-control" value="{{ $settings['youtube_url'] ?? '' }}" placeholder="https://youtube.com/...">
                    </div>
                    
                    <div class="form-group">
                        <label>Google Maps Embed URL (src)</label>
                        <textarea name="google_maps_url" class="form-control" rows="3" placeholder="Paste link dari src iframe Google Maps...">{{ $settings['google_maps_url'] ?? '' }}</textarea>
                        <small class="text-muted">Ambil dari Google Maps -> Share -> Embed a map -> Copy HTML -> Ambil isi atribut src="..." nya saja.</small>
                    </div>
                </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan Sosmed & Peta</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 mt-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Halaman Statis (AdSense)</h3>
            </div>
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                         <label>Tentang Kami (Page Content)</label>
                        <textarea id="page_about" name="page_about" class="form-control">{{ $settings['page_about'] ?? '' }}</textarea>
                    </div>
                    
                    <div class="form-group">
                         <label>Kebijakan Privasi (Page Content)</label>
                        <textarea id="page_privacy" name="page_privacy" class="form-control">{{ $settings['page_privacy'] ?? '' }}</textarea>
                        <small class="text-muted">Gunakan template standar privasi jika bingung.</small>
                    </div>

                    <div class="form-group">
                         <label>Disclaimer (Page Content)</label>
                        <textarea id="page_disclaimer" name="page_disclaimer" class="form-control">{{ $settings['page_disclaimer'] ?? '' }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Simpan Halaman</button>
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
        $('#page_about, #page_privacy, #page_disclaimer').summernote({
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
