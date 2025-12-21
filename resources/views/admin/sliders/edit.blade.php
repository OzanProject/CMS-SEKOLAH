@extends('layouts.admin')

@section('title', 'Edit Slider')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Slider</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Slider</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Slider</h3>
            </div>
            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Gambar Slider</label>
                        @if($slider->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Current Image" class="img-thumbnail" width="200">
                            </div>
                        @endif
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image">
                                <label class="custom-file-label" for="image">Ganti file (opsional)</label>
                            </div>
                        </div>
                        <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Max: 2MB.</small>
                        @error('image')
                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Judul (Opsional)</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $slider->title) }}">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $slider->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="button_text">Teks Tombol (Opsional)</label>
                                <input type="text" name="button_text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" value="{{ old('button_text', $slider->button_text) }}">
                                @error('button_text')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="button_url">Link URL (Opsional)</label>
                                <input type="text" name="button_url" class="form-control @error('button_url') is-invalid @enderror" id="button_url" value="{{ old('button_url', $slider->button_url) }}">
                                @error('button_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $slider->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Aktifkan Slider</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-default float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
