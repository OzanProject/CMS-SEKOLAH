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
                            <textarea class="form-control" name="school_description" rows="4" placeholder="Jelaskan secara singkat tentang sekolah...">{{ $settings['school_description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="school_vision" class="col-sm-2 col-form-label">Visi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="school_vision" rows="3" placeholder="Visi sekolah...">{{ $settings['school_vision'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="school_mission" class="col-sm-2 col-form-label">Misi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="school_mission" rows="6" placeholder="Misi sekolah (pisahkan dengan koma)...">{{ $settings['school_mission'] ?? '' }}</textarea>
                            <small class="text-muted">Pisahkan setiap poin misi dengan tanda koma (,).</small>
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

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('school_description');
        CKEDITOR.replace('school_vision');
        CKEDITOR.replace('school_mission');
    });
</script>
@endpush
@endsection
