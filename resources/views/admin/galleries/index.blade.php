@extends('layouts.admin')

@section('header', 'Kelola Galeri Kegiatan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Foto Kegiatan</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Upload Foto
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($galleries as $gallery)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/'.$gallery->image) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-truncate w-100">{{ $gallery->title }}</h5>
                                    <p class="card-text small text-muted">{{ Str::limit($gallery->description, 50) }}</p>
                                </div>
                                <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-warning btn-sm btn-block mr-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="w-100 ml-1" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-block">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Belum ada foto kegiatan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
