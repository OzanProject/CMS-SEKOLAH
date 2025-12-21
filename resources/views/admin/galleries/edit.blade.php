@extends('layouts.admin')

@section('header', 'Edit Foto Kegiatan')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Foto</h3>
            </div>
            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Judul Kegiatan</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Contoh: Upacara Bendera" value="{{ old('title', $gallery->title) }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Foto Saat Ini</label>
                        <br>
                        <img src="{{ asset('storage/'.$gallery->image) }}" alt="Current Image" class="img-thumbnail mb-2" style="max-height: 200px">
                    </div>
                    <div class="form-group">
                        <label for="image">Ganti Foto (Opsional)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image" accept="image/*">
                                <label class="custom-file-label" for="image">Pilih file baru</label>
                            </div>
                        </div>
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                        @error('image')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
$(document).ready(function () {
  bsCustomFileInput.init()
})
</script>
@endsection
