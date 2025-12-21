@extends('layouts.admin')

@section('header', 'Kelola Layanan Digital')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Link Layanan</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.links.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Link
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Link</th>
                            <th>URL</th>
                            <th>Target</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($links as $link)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $link->title }}</td>
                                <td><a href="{{ $link->url }}" target="_blank">{{ Str::limit($link->url, 50) }}</a></td>
                                <td>
                                    <span class="badge badge-{{ $link->target == '_blank' ? 'info' : 'secondary' }}">
                                        {{ $link->target }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.links.edit', $link->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.links.destroy', $link->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus link ini?')">
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
                                <td colspan="5" class="text-center">Belum ada data link layanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
