@extends('layouts.admin')

@section('header', 'Manajemen Iklan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Iklan & Banner</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.advertisements.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Iklan
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Posisi</th>
                            <th>Preview / Kode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advertisements as $ad)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ad->title }}</td>
                            <td><span class="badge badge-info">{{ $ad->position }}</span></td>
                            <td>
                                @if($ad->type == 'image')
                                    <img src="{{ asset('storage/'.$ad->value) }}" alt="Ad Image" style="height: 50px;">
                                @else
                                    <span class="badge badge-secondary">Script / Code</span>
                                @endif
                            </td>
                            <td>
                                @if($ad->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.advertisements.edit', $ad->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.advertisements.destroy', $ad->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus iklan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada iklan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
             <div class="card-footer clearfix">
                {{ $advertisements->links() }}
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
