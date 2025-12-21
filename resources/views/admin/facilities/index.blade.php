@extends('layouts.admin')

@section('title', 'Fasilitas Sekolah')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Fasilitas Sekolah</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Fasilitas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Fasilitas</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Fasilitas
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Gambar</th>
                            <th>Nama Fasilitas</th>
                            <th>Deskripsi</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($facilities as $facility)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($facility->image)
                                    <img src="{{ asset('storage/' . $facility->image) }}" alt="Image" class="img-thumbnail" width="50">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $facility->name }}</td>
                            <td>{{ Str::limit($facility->description, 100) }}</td>
                            <td>
                                <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data fasilitas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
